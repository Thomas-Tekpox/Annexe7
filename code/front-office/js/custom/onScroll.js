const htmlTag = document.querySelector('html');
const bodyTag = document.querySelector('body');
const myNav = document.querySelector('nav');
const myElem = document.querySelector('nav li a');

let scrolled = () => {
    let dec = scrollY / (bodyTag.scrollHeight - innerHeight);
    return Math.floor(dec*100);
}

addEventListener('scroll', () => {
    myNav.style.setProperty('background', scrolled()> 3 ? "var(--bs-sb-blue-energy)" : "rgba(0,0,0,0)");
    myNav.style.setProperty('box-shadow', scrolled()> 3 ? "rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px" : "none");
});