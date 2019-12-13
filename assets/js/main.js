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
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/main.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

function requestToServer(url, data) {
    var method = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "POST";

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
        for (var key in data) {
            s += key + '=' + data[key] + '&';
        }
        s = s.slice(0, -1);
        xhr.send(s);
    });
    return promise;
}

exports.default = requestToServer;

/***/ }),

/***/ "./src/main.js":
/*!*********************!*\
  !*** ./src/main.js ***!
  \*********************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _index = __webpack_require__(/*! ./index */ "./src/index.js");

var _index2 = _interopRequireDefault(_index);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

main();

function main() {
    var filter = document.getElementById('main__filter');
    filter.addEventListener('submit', function (e) {
        e.preventDefault();
        var config = {
            type: filter.type.value,
            direction: filter.direction.value,
            status: filter.status.checked,
            admin_create: filter.admin_create.checked
        };
        requestTasks(config);
    });

    function requestTasks(config) {
        config = config || {
            type: 'undefined',
            direction: 'on_increase',
            status: false,
            admin_create: false
        };

        // запрашиваю задачи с настройками фильтра
        console.log('запрашиваем main/tasks');
        var promise = (0, _index2.default)('/main/tasks/', config);
        promise.then(function (tasks) {
            insertTasks(tasks);
        }, function (ms) {
            console.log(ms);
        });
    }

    function insertTasks(tasks) {
        var n = document.querySelector('.main__tasks');
        if (n) {
            pagination.remove();n.parentNode.removeChild(n);
        }

        document.querySelector('.main__filter').insertAdjacentHTML('afterend', tasks);
        pagination.add();
        admin();
    }

    requestTasks();
}

var pagination = {
    target: document.querySelector('.main__pagination'),
    previous: document.getElementById('pagination__previous'),
    next: document.getElementById('pagination__next'),
    domTasks: '',
    domDigitalA: '',
    currentList: 1,
    countList: '',
    add: function add() {
        this.domTasks = document.querySelectorAll('.main__tasks .card');
        this.countList = parseInt(this.domTasks.length / 3, 10);
        if (this.domTasks.length % 3 !== 0) ++this.countList;
        if (this.countList <= 1) return;

        this.generateDigitLine();
        this.addEvents();
        this.target.classList.remove('d-none');
        this.target.classList.add('d-flex');
    },
    remove: function remove() {
        this.removeEvents();
        this.removeDigitalLine();
        this.target.classList.remove('d-flex');
        this.target.classList.add('d-none');
        this.currentList = 1;
    },
    addEvents: function addEvents() {
        var _this = this;

        this.EventClickPrevious = this.EventClickPrevious.bind(this);
        this.EventClickNext = this.EventClickNext.bind(this);
        this.EventClickDigit = this.EventClickDigit.bind(this);

        this.previous.addEventListener('click', this.EventClickPrevious);
        this.next.addEventListener('click', this.EventClickNext);
        this.domDigitalA = document.querySelectorAll('#digit_a').forEach(function (elm) {
            return elm.addEventListener('click', _this.EventClickDigit);
        });
    },
    removeEvents: function removeEvents() {
        var _this2 = this;

        console.log(this.next);
        this.previous.removeEventListener('click', this.EventClickPrevious);
        this.next.removeEventListener('click', this.EventClickNext);
        this.domDigitalA = document.querySelectorAll('#digit_a').forEach(function (elm) {
            return elm.removeEventListener('click', _this2.EventClickDigit);
        });
    },
    generateDigitLine: function generateDigitLine() {
        for (var i = 1; i <= this.countList; i++) {
            var li = document.createElement('li');
            li.className = this.currentList == i ? "page-item active" : "page-item";
            li.id = "digit_li";
            var a = document.createElement('a');
            a.href = "#";
            a.className = "page-link";
            a.id = "digit_a";
            a.innerText = i;
            li.append(a);
            document.querySelector('.page-item:last-of-type').insertAdjacentElement('beforebegin', li);
        }
    },
    removeDigitalLine: function removeDigitalLine() {
        document.querySelectorAll('#digit_li').forEach(function (n) {
            return n.parentNode.removeChild(n);
        });
    },
    EventClickPrevious: function EventClickPrevious(e) {
        e.preventDefault();
        if (this.currentList < 2) return;
        this.hiddenAllTasks();
        this.removeActiveClass();

        --this.currentList;
        this.showCurrentListTasks();
        this.instActiveClass();
    },
    EventClickNext: function EventClickNext(e) {
        e.preventDefault();
        if (this.currentList >= this.countList) return;
        this.hiddenAllTasks();
        this.removeActiveClass();

        ++this.currentList;
        this.showCurrentListTasks();
        this.instActiveClass();
    },
    EventClickDigit: function EventClickDigit(e) {
        e.preventDefault();
        this.hiddenAllTasks();
        this.removeActiveClass();

        this.currentList = parseInt(e.target.innerText, 10);
        this.showCurrentListTasks();
        this.instActiveClass();
    },
    hiddenAllTasks: function hiddenAllTasks() {
        this.domTasks.forEach(function (elm) {
            return elm.classList.add('d-none');
        });
    },
    removeActiveClass: function removeActiveClass() {
        document.querySelectorAll('#digit_li')[this.currentList - 1].classList.remove('active');
    },
    instActiveClass: function instActiveClass() {
        document.querySelectorAll('#digit_li')[this.currentList - 1].classList.add('active');
    },
    showCurrentListTasks: function showCurrentListTasks() {
        var _this3 = this;

        this.domTasks.forEach(function (elm, id) {
            if (id + 1 >= _this3.currentList * 3 - 2 && id + 1 <= _this3.currentList * 3) elm.classList.remove('d-none');
        });
    }
};

function admin() {
    if (!flagAdmin) return;
    var buffer = {};

    var callbacks = {

        clickTask: function clickTask(e) {},
        clickCheckbox: function clickCheckbox(e) {},
        saveToServer: function saveToServer(e) {},
        cancelSaveToServer: function cancelSaveToServer(e) {},
        save: function save(e) {},
        cancel: function cancel(e) {}
    };

    var tasks = document.querySelectorAll('.task');
    tasks.forEach(function (elm) {
        elm.classList.add('create');
        elm.addEventListener('click', callbacks.clickTask);
    });
}

/***/ })

/******/ });
//# sourceMappingURL=main.js.map