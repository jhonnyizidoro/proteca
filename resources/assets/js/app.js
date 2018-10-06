window.navbar = require('./scripts/navbar');
window.notification = require('./scripts/notification');
window.form = require('./scripts/form');
window.quickview = require('./scripts/quickview');
window.modal = require('./scripts/modal');
window.steps = require('./scripts/steps');
window.confirmation = require('./scripts/confirmation');
window.card = require('./scripts/card');
window.myscripts = require('./myScripts');

window.tinymceConfig = {
    selector: '.wysiwyg',
    language: 'pt_BR',
	plugins: 'image imagetools advlist code media link colorpicker paste table textcolor fullscreen paste preview',
    mobile: { theme: 'mobile' },
    images_upload_url: "/api/biblioteca/imagem",
    height : "300",
	entity_encoding : "raw",
	relative_urls : false,
	convert_urls : true,
};

document.addEventListener('DOMContentLoaded', ()=> {
    navbar.activateNavbarLink();
    navbar.activateNavbarResponsiveness();
});