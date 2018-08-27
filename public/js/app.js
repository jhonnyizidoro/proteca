/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(7);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

window.navbar = __webpack_require__(2);
window.notification = __webpack_require__(3);
window.form = __webpack_require__(4);
window.quickview = __webpack_require__(5);
window.modal = __webpack_require__(6);

window.tinymceConfig = {
    selector: '.wysiwyg',
    language: 'pt_BR',
    plugins: 'image imagetools advlist code media link colorpicker paste table textcolor',
    mobile: { theme: 'mobile' },
    images_upload_url: "/api/noticias/imagem",
    images_upload_base_path: "/storage",
    height: "300",
    entity_encoding: "raw"
};

document.addEventListener('DOMContentLoaded', function () {
    navbar.activateNavbarLink();
    navbar.activateNavbarResponsiveness();
});

/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "activateNavbarLink", function() { return activateNavbarLink; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "activateNavbarResponsiveness", function() { return activateNavbarResponsiveness; });
var activateNavbarLink = function activateNavbarLink() {
    var navbarLinks = document.querySelectorAll('.navbar-item');
    var currentURL = document.URL.split('?');
    navbarLinks.forEach(function (link) {
        if (link.href == currentURL[0]) {
            link.classList.add('is-active');
        }
    });
};

var activateNavbarResponsiveness = function activateNavbarResponsiveness() {
    var burger = document.querySelector('.burger');
    var menu = document.querySelector('.navbar-menu');
    if (burger) {
        burger.addEventListener('click', function () {
            menu.classList.toggle('is-active');
            burger.classList.toggle('is-active');
        });
    }
};



/***/ }),
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initNotification", function() { return initNotification; });
var initNotification = function initNotification() {
    var notifications = document.querySelectorAll('.notification');
    notifications.forEach(function (notification) {
        notification.children[0].addEventListener('click', function () {
            notification.style.display = 'none';
        });
    });
};



/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initFileField", function() { return initFileField; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCharCounter", function() { return initCharCounter; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "changeImageSrcWhenInputChanges", function() { return changeImageSrcWhenInputChanges; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initMaskedDateForm", function() { return initMaskedDateForm; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initMaskedTimeForm", function() { return initMaskedTimeForm; });
var initFileField = function initFileField(inputSelector, labelSelector) {
    var input = document.querySelector(inputSelector);
    var label = document.querySelector(labelSelector);
    input.addEventListener('change', function () {
        label.innerHTML = input.files[0].name;
    });
};

var changeImageSrcWhenInputChanges = function changeImageSrcWhenInputChanges(inputSelector, imgSelector) {
    var input = document.querySelector(inputSelector);
    var image = document.querySelector(imgSelector);
    input.addEventListener('change', function () {
        if (input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onloadend = function (data) {
                image.src = data.target.result;
            };
        }
    });
};

var initCharCounter = function initCharCounter(inputSelector, charCounterSelector) {
    var input = document.querySelector(inputSelector);
    var counter = document.querySelector(charCounterSelector);
    var maxLength = counter.innerHTML;
    counter.innerHTML = maxLength - input.value.length;
    input.addEventListener('keyup', function () {
        if (counter.innerHTML = maxLength - input.value.length >= 0) {
            input.classList.remove('is-invalid');
            counter.classList.remove('text-danger');
            counter.innerHTML = maxLength - input.value.length;
        } else {
            input.classList.add('is-invalid');
            counter.classList.add('text-danger');
            counter.innerHTML = 0;
        }
    });
};

var initMaskedDateForm = function initMaskedDateForm(inputSelector) {
    var input = document.querySelector(inputSelector);
    var isNumericRegex = /^[0-9]+$/;
    var dateRegex = {
        ddmm: /^\d{2}$/,
        yyyy: /^\d{2}\/\d{2}$/
    };
    input.addEventListener('keypress', function (e) {
        if (input.value.length > 9 || !e.key.match(isNumericRegex)) {
            e.preventDefault();
        } else if (input.value.match(dateRegex.ddmm) || input.value.match(dateRegex.yyyy)) {
            input.value = input.value + '/';
        }
    });
};

var initMaskedTimeForm = function initMaskedTimeForm(inputSelector) {
    var input = document.querySelector(inputSelector);
    var isNumericRegex = /^[0-9]+$/;
    var timeRegex = /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$/;
    input.addEventListener('keypress', function (e) {
        if (input.value.length >= 5 || !e.key.match(isNumericRegex)) {
            e.preventDefault();
        }
        if (input.value.length == 2) {
            input.value = input.value + ':';
        }
    });
    input.addEventListener('keyup', function (e) {
        if (input.value.length == 5) {
            if (timeRegex.test(input.value)) {
                input.classList.remove('is-invalid');
            } else {
                input.classList.add('is-invalid');
            }
        }
    });
};



/***/ }),
/* 5 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initQuickview", function() { return initQuickview; });
//Todo botão para abrir uma quickview tem um atributo 'data-target' => esse atributo é o ID da quickview
var initQuickview = function initQuickview(quickviewTriggerSelector) {
    var quickviewTriggers = document.querySelectorAll(quickviewTriggerSelector);
    var quickviews = document.querySelectorAll('.quickview');
    quickviewTriggers.forEach(function (trigger) {
        var quickview = document.getElementById(trigger.dataset.target);
        var closeButton = quickview.querySelector('.delete');
        trigger.addEventListener('click', function () {
            quickviews.forEach(function (el) {
                if (el != quickview) {
                    el.classList.remove('is-active');
                }
            });
            quickview.classList.toggle('is-active');
        });
        closeButton.addEventListener('click', function () {
            quickview.classList.remove('is-active');
        });
    });
};



/***/ }),
/* 6 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initModal", function() { return initModal; });
var initModal = function initModal(modalSelector, openModalButtonSelector, closeModalButtonSelector) {
    var modal = document.querySelector(modalSelector);
    var openModalButton = document.querySelector(openModalButtonSelector);
    var closeModalButton = document.querySelector(closeModalButtonSelector);
    openModalButton.addEventListener('click', function () {
        modal.classList.add('is-active');
    });
    closeModalButton.addEventListener('click', function () {
        modal.classList.remove('is-active');
    });
};



/***/ }),
/* 7 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);