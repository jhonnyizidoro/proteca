document.addEventListener('DOMContentLoaded', ()=> {
    const burger = document.querySelector('.burger');
    const menu = document.querySelector('.navbar-menu');
    const navbarLinks = document.querySelectorAll('.navbar-item');
    if (burger) {
        burger.addEventListener('click', ()=> {
            menu.classList.toggle('is-active');
            burger.classList.toggle('is-active');
        });
    }
    navbarLinks.forEach(link => {
        if (link.href == document.URL){
            link.classList.add('is-active');
        }
    });
});

window.myFunctions = require('./myFunctions');