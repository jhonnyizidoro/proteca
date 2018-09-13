const activateNavbarLink = ()=> {
    const navbarLinks = document.querySelectorAll('.navbar-item');
    const currentURL = document.URL.split('?');
    navbarLinks.forEach(link => {
        if (link.href == currentURL[0]){
            link.classList.add('is-active');
        }
    });
}

const activateNavbarResponsiveness = ()=> {
    const burger = document.querySelector('.burger');
    const menu = document.querySelector('.navbar-menu');
    if (burger) {
        burger.addEventListener('click', ()=> {
            menu.classList.toggle('is-active');
            burger.classList.toggle('is-active');
        });
    }
}

const scrollToNavbar = ()=> {
    const navbar = document.querySelector('.navbar');
    setTimeout(function() {
        window.scroll({
            top: navbar.offsetTop,
            behavior: "smooth"
          });
    },1000)
}

export {activateNavbarLink, activateNavbarResponsiveness, scrollToNavbar};