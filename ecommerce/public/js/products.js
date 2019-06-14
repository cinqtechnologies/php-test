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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/products.js":
/*!****************************************!*\
  !*** ./resources/js/pages/products.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var app = new Vue({
  el: '#app',
  data: {
    pageLoading: true,
    showRetailerDetails: false,
    products: [],
    retailer: {
      id: ''
    },
    currentPage: 1,
    totalPages: 1
  },
  mounted: function mounted() {
    this.getProducts().then(function () {
      document.getElementById('main-content').style.display = null;
    });
  },
  computed: {
    labelProducts: function labelProducts() {
      return this.showRetailerDetails ? "Retailer's Products" : 'Products';
    }
  },
  methods: {
    getProducts: function getProducts() {
      var _this = this;

      var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      this.pageLoading = true;
      this.currentPage = page;
      return axios.get('/products/' + this.retailer.id + '?page=' + page).then(function (res) {
        _this.products = res.data.products.data;
        _this.totalPages = res.data.products.last_page;
      }).then(function () {
        _this.pageLoading = false;
      }).catch(function (error) {
        return console.log(error);
      });
    },
    productsByRetailer: function productsByRetailer(retailerId) {
      var _this2 = this;

      this.retailer.id = retailerId;
      this.getProducts();
      axios.get('/retailer/' + retailerId).then(function (res) {
        _this2.retailer = Object.assign({}, _this2.retailer, res.data.retailer);
        _this2.showRetailerDetails = true;
      }).catch(function (error) {
        return console.log(error);
      });
    },
    dismissRetailerFilter: function dismissRetailerFilter() {
      this.retailer.id = '';
      this.getProducts();
      this.showRetailerDetails = false;
    }
  }
});

/***/ }),

/***/ 1:
/*!**********************************************!*\
  !*** multi ./resources/js/pages/products.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\dev\estudo\php-test\ecommerce\resources\js\pages\products.js */"./resources/js/pages/products.js");


/***/ })

/******/ });