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
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/addform.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/addform.js":
/*!************************!*\
  !*** ./src/addform.js ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _requestToServer = __webpack_require__(/*! ./functions/requestToServer */ "./src/functions/requestToServer.js");

var _requestToServer2 = _interopRequireDefault(_requestToServer);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function addForm() {
    var form = document.getElementById('add__form');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var data = {
            name: form.name.value,
            email: form.email.value,
            task: form.task.value,
            status: 'false',
            admincreate: 'false'
        };
        // Отправка формы на сервер 
        var request = (0, _requestToServer2.default)('/add/addtask', data, 'POST');
        request.then(function (ms) {
            console.log(ms);
            DomMessage(ms, null, 'alert-primary');
            e.target.reset();
        }, function (ms) {
            console.log(ms);
            DomMessage('Ошибка при передачи данных на сервер!', ms, 'alert-danger');
        });
    });

    var DomMessage = function DomMessage(title) {
        var description = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : undefined;
        var className = arguments[2];

        var block_message = document.querySelector('.add-message');

        block_message.classList.add(className);
        block_message.classList.add('o-1');

        block_message.querySelector('.add-message__title').innerHTML = title;
        if (description !== undefined) block_message.querySelector('.add-message__description').innerHTML = description;

        setTimeout(function () {
            block_message.classList.remove('o-1');
        }, 10000);
    };
}

addForm();

/***/ }),

/***/ "./src/functions/requestToServer.js":
/*!******************************************!*\
  !*** ./src/functions/requestToServer.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

function requestToServer(url, data) {
    var method = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "POST";
    var json = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;

    var promise = new Promise(function (resolve, reject) {
        var xhr = new XMLHttpRequest();
        xhr.open(method, url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('server 200');
                resolve(xhr.responseText);
            } else {
                if (xhr.readyState === 4) reject('\u0417\u0430\u043F\u0440\u043E\u0441 \u0437\u0430\u0432\u0435\u0440\u0448\u0451\u043D \u0441 \u043A\u043E\u0434\u043E\u043C \u043E\u0442\u0432\u0435\u0442\u0430: ' + xhr.status);
            }
        };
        console.log('--:', 'send: ', data);
        var s = "";
        if (!json) {
            for (var key in data) {
                s += key + '=' + data[key] + '&';
            }
            s = s.slice(0, -1);
        } else {
            s += 'data=' + JSON.stringify(data);
        }
        xhr.send(s);
    });
    return promise;
}

exports.default = requestToServer;

/***/ })

/******/ });
//# sourceMappingURL=addform.js.map