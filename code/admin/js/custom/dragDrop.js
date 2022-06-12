const draggable_list = document.getElementById('draggable-list');
const reset = document.getElementById('reset');
const addButton = document.getElementById('add-brique');
const listSelectable = document.querySelectorAll('#page_briques option');

const BriquesTest = [
    'bandeauBleu',
    'bandeauInfo',
    'bandeauRemise',
    'description',
    'contact',
    'ImgCaroussel',
    'CardProCaroussel',
];

const listItems = [];

let dragStartIndex;

createList();

function createList() {
    [...BriquesTest].forEach((brique, index) => {
        const listItem = document.createElement('li');

        listItem.setAttribute('data-index', index);

        listItem.innerHTML = `
            <span class="number">${index + 1}</span>
            <div class="draggable" draggable="true">
                <p class="brique-name">${brique}</p>
                <i class="fas fa-grip-lines"></i>
            </div>
        `;

        listItems.push(listItem);

        draggable_list.appendChild(listItem);
    });

    addEventListener();
}

addButton.addEventListener('click', () => {
    listSelectable.forEach(item => {
        if(item.selected == true) {
            const listItem = document.createElement('li');

            if(listItems.length < 1) {
                listItem.setAttribute('data-index', 0);
            }
            else {
                listItem.setAttribute('data-index', Number(listItems[listItems.length - 1].getAttribute('data-index')) + 1);
            }

            let number = Number(listItem.getAttribute('data-index'))+1;

            listItem.innerHTML = `
            <span class="number">${number}</span>
            <div class="draggable" draggable="true">
                <p class="brique-name">${item.textContent}</p>
                <i class="fas fa-grip-lines"></i>
            </div>
            `;

            listItems.push(listItem);
            draggable_list.appendChild(listItem);
            addEventListener();
        }
    });
})

function dblClick() {
    const removeIndex = this.getAttribute('data-index');
    listItems.splice(removeIndex, 1);
    this.remove();
    listItems.forEach(item => {
        if (item.getAttribute('data-index') > removeIndex) {
            item.setAttribute('data-index', Number(item.getAttribute('data-index')-1));
            let span = item.querySelector('.number');
            let number = Number(item.getAttribute('data-index'))+1;
            span.innerHTML = number;
        }
    });
}

function dragStart() {
    // console.log('Event: ', 'dragstart');
    dragStartIndex = +this.closest('li').getAttribute('data-index');
    // console.log('dragStartIndex: ', dragStartIndex);
}

function dragEnter() {
    // console.log('Event: ', 'dragenter');
    this.classList.add('over');
}

function dragLeave() {
    // console.log('Event: ', 'dragleave');
    this.classList.remove('over');
}

function dragOver(e) {
    // console.log('Event: ', 'dragover');
    e.preventDefault();
}

function dragDrop() {
    // console.log('Event: ', 'drop');
    const dragEndIndex = +this.getAttribute('data-index');
    // console.log('DragEndIndex: ', dragEndIndex);
    swapItems(dragStartIndex, dragEndIndex);

    this.classList.remove('over');
}

function swapItems(fromIndex, toIndex) {
    const itemOne = listItems[fromIndex].querySelector('.draggable');
    const itemTwo = listItems[toIndex].querySelector('.draggable');

    listItems[fromIndex].appendChild(itemTwo);
    listItems[toIndex].appendChild(itemOne);
}

function addEventListener() {
    const draggables = document.querySelectorAll('.draggable');
    const dragListItems = document.querySelectorAll('.draggable-list li');

    draggables.forEach(draggable => {
        draggable.addEventListener('dragstart', dragStart);
    })

    dragListItems.forEach(item => {
        item.addEventListener('dragover', dragOver);
        item.addEventListener('drop', dragDrop);
        item.addEventListener('dragenter', dragEnter);
        item.addEventListener('dragleave', dragLeave);
        item.addEventListener('dblclick', dblClick);
    })
}