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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "../src/assets/js/pages/crud/forms/widgets/form-repeater.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "../src/assets/js/pages/crud/forms/widgets/form-repeater.js":
/*!******************************************************************!*\
  !*** ../src/assets/js/pages/crud/forms/widgets/form-repeater.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

      eval("// Class definition\r\nvar KTFormRepeater = function() {\r\n\r\n    // Private functions\r\n    var demo1 = function() {\r\n        $('#kt_repeater_1').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n  $('#kt_repeater_18').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n  $('#kt_repeater_28').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n  $('#kt_repeater_38').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n  $('#kt_repeater_48').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n$('#kt_repeater_59').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n$('#kt_repeater_99').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n$('.kt_repeater_69').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n$('#kt_repeater_79').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n$('#kt_repeater_49').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n   $('#kt_repeater_11').repeater({\r\n            initEmpty: true,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function () {\r\n                $(this).slideDown();\r\n            },\r\n\r\n            hide: function (deleteElement) {                \r\n                $(this).slideUp(deleteElement);                 \r\n            }   \r\n        });\r\n    }\r\n\r\n    var demo2 = function() {\r\n        $('#kt_repeater_2').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function() {\r\n                $(this).slideDown();                               \r\n            },\r\n\r\n            hide: function(deleteElement) {                 \r\n                if(confirm('Are you sure you want to delete this element?')) {\r\n                    $(this).slideUp(deleteElement);\r\n                }                                \r\n            }      \r\n        });\r\n    }\r\n\r\n\r\n    var demo3 = function() {\r\n        $('#kt_repeater_3').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function() {\r\n                $(this).slideDown();                               \r\n            },\r\n\r\n            hide: function(deleteElement) {                 \r\n                if(confirm('Are you sure you want to delete this element?')) {\r\n                    $(this).slideUp(deleteElement);\r\n                }                                  \r\n            }      \r\n        });\r\n    }\r\n\r\n    var demo4 = function() {\r\n        $('#kt_repeater_4').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function() {\r\n                $(this).slideDown();                               \r\n            },\r\n\r\n            hide: function(deleteElement) {              \r\n                $(this).slideUp(deleteElement);                                               \r\n            }      \r\n        });\r\n    }\r\n\r\n    var demo5 = function() {\r\n        $('#kt_repeater_5').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function() {\r\n                $(this).slideDown();                               \r\n            },\r\n\r\n            hide: function(deleteElement) {              \r\n                $(this).slideUp(deleteElement);                                               \r\n            }      \r\n        });\r\n    }\r\n\r\n    var demo6 = function() {\r\n        $('#kt_repeater_6').repeater({\r\n            initEmpty: false,\r\n           \r\n            defaultValues: {\r\n                'text-input': 'foo'\r\n            },\r\n             \r\n            show: function() {\r\n                $(this).slideDown();                               \r\n            },\r\n\r\n            hide: function(deleteElement) {                  \r\n                $(this).slideUp(deleteElement);                                                \r\n            }      \r\n        });\r\n    }\r\n    return {\r\n        // public functions\r\n        init: function() {\r\n            demo1();\r\n            demo2();\r\n            demo3();\r\n            demo4();\r\n            demo5();\r\n            demo6();\r\n        }\r\n    };\r\n}();\r\n\r\njQuery(document).ready(function() {\r\n    KTFormRepeater.init();\r\n});\r\n\r\n    \n\n");

/***/ })

/******/ });