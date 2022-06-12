/*!
   Copyright 2015-2020 SpryMedia Ltd.

 This source file is free software, available under the following license:
   MIT license - http://datatables.net/license/mit

 This source file is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.

 For details please refer to: http://www.datatables.net
 RowReorder 1.2.8
 2015-2020 SpryMedia Ltd - datatables.net/license
*/
(function (d) {
  "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function (m) {
    return d(m, window, document)
  }) : "object" === typeof exports ? module.exports = function (m, h) {
    m || (m = window);
    h && h.fn.dataTable || (h = require("datatables.net")(m, h).$);
    return d(h, m, m.document)
  } : d(jQuery, window, document)
})(function (d, m, h, A) {
  var q = d.fn.dataTable,
    p = function (a, b) {
      if (!q.versionCheck || !q.versionCheck("1.10.8")) throw "DataTables RowReorder requires DataTables 1.10.8 or newer";
      this.c = d.extend(!0, {}, q.defaults.rowReorder,
        p.defaults, b);
      this.s = {
        bodyTop: null,
        dt: new q.Api(a),
        getDataFn: q.ext.oApi._fnGetObjectDataFn(this.c.dataSrc),
        middles: null,
        scroll: {},
        scrollInterval: null,
        setDataFn: q.ext.oApi._fnSetObjectDataFn(this.c.dataSrc),
        start: {
          top: 0,
          left: 0,
          offsetTop: 0,
          offsetLeft: 0,
          nodes: []
        },
        windowHeight: 0,
        documentOuterHeight: 0,
        domCloneOuterHeight: 0
      };
      this.dom = {
        clone: null,
        dtScroll: d("div.dataTables_scrollBody", this.s.dt.table().container())
      };
      a = this.s.dt.settings()[0];
      if (b = a.rowreorder) return b;
      this.dom.dtScroll.length || (this.dom.dtScroll =
        d(this.s.dt.table().container(), "tbody"));
      a.rowreorder = this;
      this._constructor()
    };
  d.extend(p.prototype, {
    _constructor: function () {
      var a = this,
        b = this.s.dt,
        c = d(b.table().node());
      "static" === c.css("position") && c.css("position", "relative");
      d(b.table().container()).on("mousedown.rowReorder touchstart.rowReorder", this.c.selector, function (e) {
        if (a.c.enable) {
          if (d(e.target).is(a.c.excludedChildren)) return !0;
          var f = d(this).closest("tr"),
            g = b.row(f);
          if (g.any()) return a._emitEvent("pre-row-reorder", {
              node: g.node(),
              index: g.index()
            }),
            a._mouseDown(e, f), !1
        }
      });
      b.on("destroy.rowReorder", function () {
        d(b.table().container()).off(".rowReorder");
        b.off(".rowReorder")
      })
    },
    _cachePositions: function () {
      var a = this.s.dt,
        b = d(a.table().node()).find("thead").outerHeight(),
        c = d.unique(a.rows({
          page: "current"
        }).nodes().toArray());
      c = d.map(c, function (e, f) {
        f = d(e).position().top - b;
        return (f + f + d(e).outerHeight()) / 2
      });
      this.s.middles = c;
      this.s.bodyTop = d(a.table().body()).offset().top;
      this.s.windowHeight = d(m).height();
      this.s.documentOuterHeight = d(h).outerHeight()
    },
    _clone: function (a) {
      var b = d(this.s.dt.table().node().cloneNode(!1)).addClass("dt-rowReorder-float").append("<tbody/>").append(a.clone(!1)),
        c = a.outerWidth(),
        e = a.outerHeight(),
        f = a.children().map(function () {
          return d(this).width()
        });
      b.width(c).height(e).find("tr").children().each(function (g) {
        this.style.width = f[g] + "px"
      });
      b.appendTo("body");
      this.dom.clone = b;
      this.s.domCloneOuterHeight = b.outerHeight()
    },
    _clonePosition: function (a) {
      var b = this.s.start,
        c = this._eventToPage(a, "Y") - b.top;
      a = this._eventToPage(a, "X") -
        b.left;
      var e = this.c.snapX;
      c += b.offsetTop;
      b = !0 === e ? b.offsetLeft : "number" === typeof e ? b.offsetLeft + e : a + b.offsetLeft;
      0 > c ? c = 0 : c + this.s.domCloneOuterHeight > this.s.documentOuterHeight && (c = this.s.documentOuterHeight - this.s.domCloneOuterHeight);
      this.dom.clone.css({
        top: c,
        left: b
      })
    },
    _emitEvent: function (a, b) {
      this.s.dt.iterator("table", function (c, e) {
        d(c.nTable).triggerHandler(a + ".dt", b)
      })
    },
    _eventToPage: function (a, b) {
      return -1 !== a.type.indexOf("touch") ? a.originalEvent.touches[0]["page" + b] : a["page" + b]
    },
    _mouseDown: function (a,
      b) {
      var c = this,
        e = this.s.dt,
        f = this.s.start,
        g = b.offset();
      f.top = this._eventToPage(a, "Y");
      f.left = this._eventToPage(a, "X");
      f.offsetTop = g.top;
      f.offsetLeft = g.left;
      f.nodes = d.unique(e.rows({
        page: "current"
      }).nodes().toArray());
      this._cachePositions();
      this._clone(b);
      this._clonePosition(a);
      this.dom.target = b;
      b.addClass("dt-rowReorder-moving");
      d(h).on("mouseup.rowReorder touchend.rowReorder", function (k) {
        c._mouseUp(k)
      }).on("mousemove.rowReorder touchmove.rowReorder", function (k) {
        c._mouseMove(k)
      });
      d(m).width() === d(h).width() &&
        d(h.body).addClass("dt-rowReorder-noOverflow");
      a = this.dom.dtScroll;
      this.s.scroll = {
        windowHeight: d(m).height(),
        windowWidth: d(m).width(),
        dtTop: a.length ? a.offset().top : null,
        dtLeft: a.length ? a.offset().left : null,
        dtHeight: a.length ? a.outerHeight() : null,
        dtWidth: a.length ? a.outerWidth() : null
      }
    },
    _mouseMove: function (a) {
      this._clonePosition(a);
      for (var b = this._eventToPage(a, "Y") - this.s.bodyTop, c = this.s.middles, e = null, f = this.s.dt, g = 0, k = c.length; g < k; g++)
        if (b < c[g]) {
          e = g;
          break
        } null === e && (e = c.length);
      if (null === this.s.lastInsert ||
        this.s.lastInsert !== e) b = d.unique(f.rows({
        page: "current"
      }).nodes().toArray()), e > this.s.lastInsert ? this.dom.target.insertAfter(b[e - 1]) : this.dom.target.insertBefore(b[e]), this._cachePositions(), this.s.lastInsert = e;
      this._shiftScroll(a)
    },
    _mouseUp: function (a) {
      var b = this,
        c = this.s.dt,
        e, f = this.c.dataSrc;
      this.dom.clone.remove();
      this.dom.clone = null;
      this.dom.target.removeClass("dt-rowReorder-moving");
      d(h).off(".rowReorder");
      d(h.body).removeClass("dt-rowReorder-noOverflow");
      clearInterval(this.s.scrollInterval);
      this.s.scrollInterval = null;
      var g = this.s.start.nodes,
        k = d.unique(c.rows({
          page: "current"
        }).nodes().toArray()),
        n = {},
        r = [],
        t = [],
        u = this.s.getDataFn,
        B = this.s.setDataFn;
      var l = 0;
      for (e = g.length; l < e; l++)
        if (g[l] !== k[l]) {
          var w = c.row(k[l]).id(),
            C = c.row(k[l]).data(),
            x = c.row(g[l]).data();
          w && (n[w] = u(x));
          r.push({
            node: k[l],
            oldData: u(C),
            newData: u(x),
            newPosition: l,
            oldPosition: d.inArray(k[l], g)
          });
          t.push(k[l])
        } var y = [r, {
        dataSrc: f,
        nodes: t,
        values: n,
        triggerRow: c.row(this.dom.target),
        originalEvent: a
      }];
      this._emitEvent("row-reorder",
        y);
      var z = function () {
        if (b.c.update) {
          l = 0;
          for (e = r.length; l < e; l++) {
            var D = c.row(r[l].node).data();
            B(D, r[l].newData);
            c.columns().every(function () {
              this.dataSrc() === f && c.cell(r[l].node, this.index()).invalidate("data")
            })
          }
          b._emitEvent("row-reordered", y);
          c.draw(!1)
        }
      };
      this.c.editor ? (this.c.enable = !1, this.c.editor.edit(t, !1, d.extend({
        submit: "changed"
      }, this.c.formOptions)).multiSet(f, n).one("preSubmitCancelled.rowReorder", function () {
        b.c.enable = !0;
        b.c.editor.off(".rowReorder");
        c.draw(!1)
      }).one("submitUnsuccessful.rowReorder",
        function () {
          c.draw(!1)
        }).one("submitSuccess.rowReorder", function () {
        z()
      }).one("submitComplete", function () {
        b.c.enable = !0;
        b.c.editor.off(".rowReorder")
      }).submit()) : z()
    },
    _shiftScroll: function (a) {
      var b = this,
        c = this.s.scroll,
        e = !1,
        f = a.pageY - h.body.scrollTop,
        g, k;
      f < d(m).scrollTop() + 65 ? g = -5 : f > c.windowHeight + d(m).scrollTop() - 65 && (g = 5);
      null !== c.dtTop && a.pageY < c.dtTop + 65 ? k = -5 : null !== c.dtTop && a.pageY > c.dtTop + c.dtHeight - 65 && (k = 5);
      g || k ? (c.windowVert = g, c.dtVert = k, e = !0) : this.s.scrollInterval && (clearInterval(this.s.scrollInterval),
        this.s.scrollInterval = null);
      !this.s.scrollInterval && e && (this.s.scrollInterval = setInterval(function () {
        if (c.windowVert) {
          var n = d(h).scrollTop();
          d(h).scrollTop(n + c.windowVert);
          n !== d(h).scrollTop() && (n = parseFloat(b.dom.clone.css("top")), b.dom.clone.css("top", n + c.windowVert))
        }
        c.dtVert && (n = b.dom.dtScroll[0], c.dtVert && (n.scrollTop += c.dtVert))
      }, 20))
    }
  });
  p.defaults = {
    dataSrc: 0,
    editor: null,
    enable: !0,
    formOptions: {},
    selector: "td:first-child",
    snapX: !1,
    update: !0,
    excludedChildren: "a"
  };
  var v = d.fn.dataTable.Api;
  v.register("rowReorder()",
    function () {
      return this
    });
  v.register("rowReorder.enable()", function (a) {
    a === A && (a = !0);
    return this.iterator("table", function (b) {
      b.rowreorder && (b.rowreorder.c.enable = a)
    })
  });
  v.register("rowReorder.disable()", function () {
    return this.iterator("table", function (a) {
      a.rowreorder && (a.rowreorder.c.enable = !1)
    })
  });
  p.version = "1.2.8";
  d.fn.dataTable.RowReorder = p;
  d.fn.DataTable.RowReorder = p;
  d(h).on("init.dt.dtr", function (a, b, c) {
    "dt" === a.namespace && (a = b.oInit.rowReorder, c = q.defaults.rowReorder, a || c) && (c = d.extend({}, a,
      c), !1 !== a && new p(b, c))
  });
  return p
});