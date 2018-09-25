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
module.exports = __webpack_require__(10);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

window.navbar = __webpack_require__(2);
window.notification = __webpack_require__(3);
window.form = __webpack_require__(4);
window.quickview = __webpack_require__(5);
window.modal = __webpack_require__(6);
window.steps = __webpack_require__(7);
window.confirmation = __webpack_require__(8);
window.card = __webpack_require__(9);

window.tinymceConfig = {
    selector: '.wysiwyg',
    language: 'pt_BR',
    plugins: 'image imagetools advlist code media link colorpicker paste table textcolor fullscreen',
    mobile: { theme: 'mobile' },
    images_upload_url: "/api/biblioteca/imagem",
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
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "scrollToNavbar", function() { return scrollToNavbar; });
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

var scrollToNavbar = function scrollToNavbar() {
    var navbar = document.querySelector('.navbar');
    setTimeout(function () {
        window.scroll({
            top: navbar.offsetTop,
            behavior: "smooth"
        });
    }, 1000);
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
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initSteps", function() { return initSteps; });
var initSteps = function initSteps(stepsSelector) {
    var stepsTitle = document.querySelectorAll(stepsSelector + ' .step-item');
    var stepsContent = document.querySelectorAll(stepsSelector + ' .step-content');
    var nextButton = document.querySelector(stepsSelector + ' .next-step');
    var previousButton = document.querySelector(stepsSelector + ' .previous-step');
    var maxSteps = stepsTitle.length - 1;
    var activeStep = 0;

    /**
     * Um do título ('.step-item') deve ter a classe 'is-active', esse trecho de código adiciona
     * a classe 'is-active' no conteúdo do step referente ao título ativo.
     * Exemplo: se o step 2 está com a classe 'is.active', o segunto step também terá essa classe
     * esse código também adiciona a classe 'is-completed' nos títulos enquanto não encontrar no título ativo
     */
    var found = false;
    stepsTitle.forEach(function (stepTitle) {
        if (stepTitle.classList.contains('is-active') && !found) {
            found = true;
        } else if (!found) {
            stepTitle.classList.add('is-completed');
            activeStep++;
        }
    });
    if (!found) {
        activeStep = 0;
        stepsTitle[activeStep].classList.add('is-active');
        stepsTitle.forEach(function (stepTitle) {
            stepTitle.classList.remove('is-completed');
        });
    }
    stepsContent[activeStep].classList.add('is-active');

    //Adiciona a classe is-disabled nos botões caso esteja no primeiro ou no último step
    if (activeStep == maxSteps) {
        nextButton.classList.add('is-disabled');
    } else if (activeStep == 0) {
        previousButton.classList.add('is-disabled');
    }

    //Evento botão next
    nextButton.addEventListener('click', function () {
        previousButton.classList.remove('is-disabled');
        if (activeStep < maxSteps) {
            stepsTitle[activeStep].classList.remove('is-active');
            stepsContent[activeStep].classList.remove('is-active');
            stepsTitle[activeStep].classList.add('is-completed');
            activeStep++;
            stepsTitle[activeStep].classList.add('is-active');
            stepsContent[activeStep].classList.add('is-active');
        }
        if (activeStep == maxSteps) {
            nextButton.classList.add('is-disabled');
        }
    });

    //Evento botão previous
    previousButton.addEventListener('click', function () {
        nextButton.classList.remove('is-disabled');
        if (activeStep > 0) {
            stepsTitle[activeStep].classList.remove('is-active');
            stepsContent[activeStep].classList.remove('is-active');
            stepsTitle[activeStep].classList.remove('is-completed');
            activeStep--;
            stepsTitle[activeStep].classList.add('is-active');
            stepsContent[activeStep].classList.add('is-active');
        }
        if (activeStep == 0) {
            previousButton.classList.add('is-disabled');
        }
    });
};



/***/ }),
/* 8 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initConfirmation", function() { return initConfirmation; });
var initConfirmation = function initConfirmation(confirmationSelector, triggersSelector) {

    var triggers = document.querySelectorAll(triggersSelector);
    var confirmationWindow = document.querySelector(confirmationSelector);
    var trueButton = document.querySelector(confirmationSelector + ' .true');
    var falseButton = document.querySelector(confirmationSelector + ' .false');
    var closeButton = document.querySelector(confirmationSelector + ' .confirmation-close');
    var clickEvent = void 0;

    closeButton.addEventListener('click', function () {
        confirmationWindow.classList.remove('is-active');
    });
    falseButton.addEventListener('click', function () {
        confirmationWindow.classList.remove('is-active');
    });

    triggers.forEach(function (trigger) {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            confirmationWindow.classList.add('is-active');
            clickEvent = e;
        });
    });

    trueButton.addEventListener('click', function () {
        confirmationWindow.classList.remove('is-active');
        try {
            window.location.replace(clickEvent.target.href);
        } catch (error) {
            location.reload();
        }
    });
};



/***/ }),
/* 9 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "resizeToFit", function() { return resizeToFit; });
var resizeToFit = function resizeToFit(titleSelector) {
	var titles = document.querySelectorAll(titleSelector);
	titles.forEach(function (title) {
		if (title.innerHTML.length > 15 && window.innerWidth > 768) {
			title.style.fontSize = '1rem';
		}
	});
};



/***/ }),
/* 10 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);