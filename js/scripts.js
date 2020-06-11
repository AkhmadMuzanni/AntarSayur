// var cw = $('.img-product').width();
// $('.img-product').css({ 'height': cw + 'px' });
let mainNavLinks = document.querySelectorAll("nav ul li a");
let mainSections = document.querySelectorAll("main section");

let lastId;
let cur = [];

mainNavLinks.forEach(link => {
    link.addEventListener("click", event => {
        event.preventDefault();
        let target = document.querySelector(event.target.hash);
        target.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    });
});

window.addEventListener("scroll", event => {
    let fromTop = window.scrollY;

    mainNavLinks.forEach(link => {
        let section = document.getElementById(link.hash.substr(1));

        if (
            section.offsetTop <= fromTop &&
            section.offsetTop + section.offsetHeight > fromTop
        ) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
});

// window.addEventListener("scroll", () => {
//     _.throttle(doThatStuff, 100);
// });