(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[11],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile/LoanRepayment.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Profile/LoanRepayment.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_1__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

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
  name: "LoanRepayment",
  data: function data() {
    return {
      data: []
    };
  },
  methods: {
    repayment: function repayment() {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var response;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _context.next = 2;
                return _this.$store.dispatch('sendRepaymentData', _this.sum());

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
    sum: function sum() {
      var summ = this.data.Sum;
      summ = +summ.replace(/\s/g, '');
      return lodash__WEBPACK_IMPORTED_MODULE_1___default.a.ceil(lodash__WEBPACK_IMPORTED_MODULE_1___default.a.toNumber(this.data.PercentSum) + lodash__WEBPACK_IMPORTED_MODULE_1___default.a.toNumber(this.data.Penalty) + summ, 2);
    }
  },
  mounted: function mounted() {
    var _this2 = this;

    return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
        while (1) {
          switch (_context2.prev = _context2.next) {
            case 0:
              _context2.next = 2;
              return _this2.$store.dispatch('getValidContract');

            case 2:
              _this2.data = _context2.sent;

              if (_this2.$store.getters.email) {
                _context2.next = 6;
                break;
              }

              _context2.next = 6;
              return _this2.$store.dispatch('loadContactData');

            case 6:
            case "end":
              return _context2.stop();
          }
        }
      }, _callee2);
    }))();
  }
});

/***/ }),

/***/ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile/LoanRepayment.vue?vue&type=template&id=7ca72782&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Profile/LoanRepayment.vue?vue&type=template&id=7ca72782&scoped=true& ***!
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
  return _c(
    "section",
    [
      _vm.data.Sum
        ? _c(
            "v-card",
            [
              _c(
                "v-row",
                [
                  _c(
                    "v-col",
                    [
                      _c("v-alert", { attrs: { color: "success m-4 mb-0" } }, [
                        _vm._v(
                          "\n          Вы можете погасить заём, используя вашу банковскую карту. Для этого Вам  необходимо перейти по ссылке,\n          нажав на кнопку «Оплатить». Обращаем Ваше  внимание, что сумма платежа составляет "
                        ),
                        _c("b", [_vm._v(_vm._s(_vm.sum()) + " руб.")])
                      ])
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c("v-card-title", [
                _vm._v("Погашение займа № " + _vm._s(_vm.data.Number))
              ]),
              _vm._v(" "),
              _c(
                "v-card-text",
                { staticClass: "text--primary" },
                [
                  _c("v-simple-table", {
                    scopedSlots: _vm._u(
                      [
                        {
                          key: "default",
                          fn: function() {
                            return [
                              _c("tbody", [
                                _c("tr"),
                                _c("tr", [
                                  _c("td", [_c("b", [_vm._v("Сумма займа:")])]),
                                  _c("td", [
                                    _vm._v(" " + _vm._s(_vm.data.Sum) + " руб.")
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("tr", [
                                  _c("td", [
                                    _c("b", [_vm._v("Срок займа (дней):")])
                                  ]),
                                  _c("td", [
                                    _vm._v(" " + _vm._s(_vm.data.Days))
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("tr", [
                                  _c("td", [
                                    _c("b", [_vm._v("Дата возврата займа:")])
                                  ]),
                                  _c("td", [
                                    _vm._v(" " + _vm._s(_vm.data.ReturnDate))
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("tr", [
                                  _c("td", [
                                    _c("b", [
                                      _vm._v("Сумма процентов на текущий день:")
                                    ])
                                  ]),
                                  _c("td", [
                                    _vm._v(
                                      " " +
                                        _vm._s(_vm.data.PercentSum) +
                                        " руб."
                                    )
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("tr", [
                                  _c("td", [_c("b", [_vm._v("Процент:")])]),
                                  _c("td", [
                                    _vm._v(
                                      " " + _vm._s(_vm.data.Percent) + " %"
                                    )
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("tr", [
                                  _c("td", [_c("b", [_vm._v("Пени:")])]),
                                  _c("td", [
                                    _vm._v(" " + _vm._s(_vm.data.Penalty))
                                  ])
                                ])
                              ])
                            ]
                          },
                          proxy: true
                        }
                      ],
                      null,
                      false,
                      3487207584
                    )
                  }),
                  _vm._v(" "),
                  _c(
                    "a",
                    {
                      staticClass: "btn btn-nav",
                      on: { click: _vm.repayment }
                    },
                    [_vm._v("Оплатить")]
                  )
                ],
                1
              )
            ],
            1
          )
        : _c(
            "v-card",
            [
              _c("v-alert", { attrs: { color: "danger" } }, [
                _vm._v(
                  "\n      В данный момент у Вас нет активных займов\n    "
                )
              ])
            ],
            1
          )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Profile/LoanRepayment.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/Profile/LoanRepayment.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LoanRepayment_vue_vue_type_template_id_7ca72782_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LoanRepayment.vue?vue&type=template&id=7ca72782&scoped=true& */ "./resources/js/components/Profile/LoanRepayment.vue?vue&type=template&id=7ca72782&scoped=true&");
/* harmony import */ var _LoanRepayment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LoanRepayment.vue?vue&type=script&lang=js& */ "./resources/js/components/Profile/LoanRepayment.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _LoanRepayment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _LoanRepayment_vue_vue_type_template_id_7ca72782_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _LoanRepayment_vue_vue_type_template_id_7ca72782_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "7ca72782",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Profile/LoanRepayment.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Profile/LoanRepayment.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/Profile/LoanRepayment.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanRepayment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./LoanRepayment.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile/LoanRepayment.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanRepayment_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Profile/LoanRepayment.vue?vue&type=template&id=7ca72782&scoped=true&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/components/Profile/LoanRepayment.vue?vue&type=template&id=7ca72782&scoped=true& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanRepayment_vue_vue_type_template_id_7ca72782_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./LoanRepayment.vue?vue&type=template&id=7ca72782&scoped=true& */ "./node_modules/laravel-mix/node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Profile/LoanRepayment.vue?vue&type=template&id=7ca72782&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanRepayment_vue_vue_type_template_id_7ca72782_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_laravel_mix_node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LoanRepayment_vue_vue_type_template_id_7ca72782_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);