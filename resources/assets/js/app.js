window.navbar = require('./scripts/navbar');
window.notification = require('./scripts/notification');
window.form = require('./scripts/form');
window.quickview = require('./scripts/quickview');
window.modal = require('./scripts/modal');

window.tinymceConfig = {
    selector: '.wysiwyg',
    language: 'pt_BR',
    plugins: 'image imagetools advlist code media link colorpicker paste table textcolor',
    mobile: { theme: 'mobile' },
    images_upload_url: "/api/noticias/imagem",
    images_upload_base_path: "/storage",
    height : "300",
    entity_encoding : "raw",
};

document.addEventListener('DOMContentLoaded', ()=> {
    navbar.activateNavbarLink();
    navbar.activateNavbarResponsiveness();    
});