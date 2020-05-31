(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile/LoanExtension.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Profile/LoanExtension.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_3__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      days: 1,
      contractData: null,
      percentSum: 0,
      returnDate: undefined
    };
  },
  computed: _objectSpread(_objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapGetters"])(['loanData'])), {}, {
    isNeedPayPercent: function isNeedPayPercent() {
      return this.percentSum > 0;
    }
  }),
  methods: {
    click: function click() {
      if (this.isNeedPayPercent) this.payment();else this.extension();
    },
    payment: function payment() {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var response;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.next = 2;
                return _this.$store.dispatch('extensionPayPercent', _this.percentSum);

              case 2:
                response = _context.sent;

                if (response.hasOwnProperty('userWebLink')) {
                  location.replace(response.userWebLink);
                }

              case 4:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    extension: function extension() {
      var _this2 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.next = 2;
                return _this2.$store.dispatch('extendLoan', _this2.returnDate.format('YYYYMMDD'));

              case 2:
                _this2.$router.push('/profile');

              case 3:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    }
  },
  mounted: function mounted() {
    var _this3 = this;

    return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3() {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
        while (1) {
          switch (_context3.prev = _context3.next) {
            case 0:
              _context3.next = 2;
              return _this3.$store.dispatch('getValidContract');

            case 2:
              _this3.contractData = _context3.sent;
              _this3.percentSum = lodash__WEBPACK_IMPORTED_MODULE_2___default.a.parseInt(_this3.contractData.PercentSum) + lodash__WEBPACK_IMPORTED_MODULE_2___default.a.parseInt(_this3.contractData.Penalty);
              _this3.returnDate = moment__WEBPACK_IMPORTED_MODULE_3___default()(_this3.contractData.ReturnDate, 'DD.MM.YYYY').locale('ru').add(1, 'days');

            case 5:
            case "end":
              return _context3.stop();
          }
        }
      }, _callee3);
    }))();
  },
  watch: {
    days: function days() {
      this.returnDate = moment__WEBPACK_IMPORTED_MODULE_3___default()(this.contractData.ReturnDate, 'DD.MM.YYYY').locale('ru');
      this.returnDate.add(this.days, 'days');
    }
  }
});

/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile/LoanExtension.vue?vue&type=template&id=0791ad64&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Profile/LoanExtension.vue?vue&type=template&id=0791ad64&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("v-container", { attrs: { fluid: "" } }, [
    _vm.loanData.Number
      ? _c(
          "section",
          [
            _c(
              "v-row",
              [
                _c(
                  "v-col",
                  [
                    _vm.isNeedPayPercent
                      ? _c(
                          "v-alert",
                          { attrs: { color: "red", elevation: "2" } },
                          [
                            _vm._v(
                              "Для продления займа Вам необходимо оплатить текущий процент. "
                            ),
                            _c("br"),
                            _vm._v(" "),
                            _c("span", [
                              _vm._v("Сумма процентов: "),
                              _c("span", { staticClass: "font-weight-bold" }, [
                                _vm._v(_vm._s(_vm.percentSum) + " руб.")
                              ])
                            ])
                          ]
                        )
                      : _vm._e(),
                    _vm._v(" "),
                    _c(
                      "v-row",
                      [
                        _c("v-col", [
                          _c("p", [
                            _c("span", { staticClass: "font-weight-bold" }, [
                              _vm._v("Количество дней прдления:")
                            ]),
                            _vm._v(" " + _vm._s(_vm.days))
                          ])
                        ]),
                        _vm._v(" "),
                        _c("v-col", [
                          _c("p", [
                            _c("span", { staticClass: "font-weight-bold" }, [
                              _vm._v("Новая дата возврата займа:")
                            ]),
                            _vm._v(" " + _vm._s(_vm.returnDate.format("L")))
                          ])
                        ])
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "v-row",
                      [
                        _c(
                          "v-col",
                          [
                            _c("v-slider", {
                              staticClass: "align-center",
                              attrs: {
                                max: 30,
                                min: 1,
                                step: 1,
                                color: "#fc0101",
                                "track-color": "#f6f6f6",
                                "hide-details": ""
                              },
                              model: {
                                value: _vm.days,
                                callback: function($$v) {
                                  _vm.days = $$v
                                },
                                expression: "days"
                              }
                            })
                          ],
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "a",
                      {
                        staticClass: "btn btn-nav mt-4",
                        on: { click: _vm.click }
                      },
                      [_vm._v("Продлить займ")]
                    )
                  ],
                  1
                )
              ],
              1
            )
          ],
          1
        )
      : _c(
          "section",
          [
            _c("v-alert", { attrs: { color: "danger" } }, [
              _vm._v("\n      В данный момент у Вас нет активных займов\n    ")
            ])
          ],
          1
        )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Profile/LoanExtension.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/Profile/LoanExtension.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LoanExtension_vue_vue_type_template_id_0791ad64_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LoanExtension.vue?vue&type=template&id=0791ad64&scoped=true& */ "./resources/js/components/Profile/LoanExtension.vue?vue&type=template&id=0791ad64&scoped=true&");
/* harmony import */ var _LoanExtension_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LoanExtension.vue?vue&type=script&lang=js& */ "./resources/js/components/Profile/LoanExtension.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _LoanExtension_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _LoanExtension_vue_vue_type_template_id_0791ad64_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _LoanExtension_vue_vue_type_template_id_0791ad64_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "0791ad64",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Profile/LoanExtension.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Profile/LoanExtension.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/Profile/LoanExtension.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanExtension_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./LoanExtension.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile/LoanExtension.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanExtension_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Profile/LoanExtension.vue?vue&type=template&id=0791ad64&scoped=true&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/Profile/LoanExtension.vue?vue&type=template&id=0791ad64&scoped=true& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanExtension_vue_vue_type_template_id_0791ad64_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./LoanExtension.vue?vue&type=template&id=0791ad64&scoped=true& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile/LoanExtension.vue?vue&type=template&id=0791ad64&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanExtension_vue_vue_type_template_id_0791ad64_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanExtension_vue_vue_type_template_id_0791ad64_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);