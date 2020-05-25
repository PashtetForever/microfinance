(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[28],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ContactData.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ContactData.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* WEBPACK VAR INJECTION */(function(process) {/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");


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
//

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      emailRules: [function (v) {
        return !!v || 'Требуется ввести Email';
      }, function (v) {
        return /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(v) || 'Введенный Email не корректен';
      }],
      verifyRules: [function (v) {
        return !!v || 'Требуется согласие';
      }],
      documents: [{
        name: 'Политику сайта',
        path: 'http://sentimo.ispvds.com/upload/iblock/74a/74aab95bb9314315ff00e136a7d6aea0.docx'
      }, {
        name: 'Правила предоставления он-лайн займов',
        path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Правила предоставления он-лайн займов.doc'
      }, {
        name: 'Соглашение об использовании АСП',
        path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Соглашение об АСП.docx'
      }, {
        name: 'и даю согласие на Обработку персональных данных',
        path: process.env.VUE_APP_DOCUMENTS_PATH + 'documenti/Согласие на обработку персональных данных.docx'
      }],
      verify: false,
      isValid: false,
      originalEmail: ''
    };
  },
  computed: _objectSpread(_objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapGetters"])(['isVerifyEmail', 'phone', 'fio'])), {}, {
    email: {
      get: function get() {
        return this.$store.getters.email;
      },
      set: function set(value) {
        this.$store.commit('email', value);
      }
    },
    pathToNext: function pathToNext() {
      return !this.isChangedEmail ? 'data' : 'verify-email';
    },
    isChangedEmail: function isChangedEmail() {
      return this.originalEmail !== this.email;
    }
  }),
  mounted: function mounted() {
    var _this = this;

    return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
      return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
        while (1) {
          switch (_context.prev = _context.next) {
            case 0:
              if (_this.$store.getters.fio) {
                _context.next = 3;
                break;
              }

              _context.next = 3;
              return _this.$store.dispatch('loadContactData');

            case 3:
              _this.originalEmail = _this.email;

            case 4:
            case "end":
              return _context.stop();
          }
        }
      }, _callee);
    }))();
  }
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../../../node_modules/process/browser.js */ "./node_modules/process/browser.js")))

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ContactData.vue?vue&type=template&id=12f96dcf&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ContactData.vue?vue&type=template&id=12f96dcf&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************/
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
    "v-row",
    [
      _c(
        "v-col",
        { attrs: { xs: "12", md: "11", "offset-sm": "1" } },
        [
          _c("app-order-form-min"),
          _vm._v(" "),
          _c("app-headers", {
            attrs: { h1: "Подтверждение контактных данных" }
          }),
          _vm._v(" "),
          !_vm.isVerifyEmail
            ? _c("v-alert", { attrs: { color: "red", elevation: "2" } }, [
                _vm._v(
                  "Необходимо подтвердить Вашу учетную записи. Заполните форму ниже, на указанный Email придет сообщение с кодом,\n      введите код на следующем шаге.\n    "
                )
              ])
            : _vm._e(),
          _vm._v(" "),
          _c(
            "v-form",
            {
              ref: "personalDataForm",
              model: {
                value: _vm.isValid,
                callback: function($$v) {
                  _vm.isValid = $$v
                },
                expression: "isValid"
              }
            },
            [
              _c("v-text-field", {
                attrs: { disabled: "", placeholder: "Фамилия Имя Отчество" },
                model: {
                  value: _vm.fio,
                  callback: function($$v) {
                    _vm.fio = $$v
                  },
                  expression: "fio"
                }
              }),
              _vm._v(" "),
              _c("v-text-field", {
                attrs: { placeholder: "Телефон", disabled: "" },
                model: {
                  value: _vm.phone,
                  callback: function($$v) {
                    _vm.phone = $$v
                  },
                  expression: "phone"
                }
              }),
              _vm._v(" "),
              _c("v-text-field", {
                attrs: {
                  rules: _vm.emailRules,
                  required: "",
                  value: _vm.email,
                  placeholder: "E-mail"
                },
                model: {
                  value: _vm.email,
                  callback: function($$v) {
                    _vm.email = $$v
                  },
                  expression: "email"
                }
              }),
              _vm._v(" "),
              _c("v-checkbox", {
                attrs: { label: "", rules: _vm.verifyRules, required: "" },
                scopedSlots: _vm._u([
                  {
                    key: "label",
                    fn: function() {
                      return [
                        _c(
                          "div",
                          [
                            _vm._v(
                              "\n            Нажимая на кнопку «Далее» я принимаю\n            "
                            ),
                            _vm._l(_vm.documents, function(doc, index) {
                              return _c("span", { key: doc.path }, [
                                _vm._v(
                                  _vm._s(index !== 0 ? "," : "") +
                                    "\n              "
                                ),
                                _c(
                                  "a",
                                  {
                                    attrs: { target: "_blank", href: doc.path },
                                    on: {
                                      click: function($event) {
                                        $event.stopPropagation()
                                      }
                                    }
                                  },
                                  [_vm._v(_vm._s(doc.name))]
                                )
                              ])
                            })
                          ],
                          2
                        )
                      ]
                    },
                    proxy: true
                  }
                ]),
                model: {
                  value: _vm.verify,
                  callback: function($$v) {
                    _vm.verify = $$v
                  },
                  expression: "verify"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c("app-nav", {
            attrs: {
              backPath: "/",
              toPath: this.pathToNext,
              disableNext: !_vm.isValid
            }
          })
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

/***/ "./resources/js/components/ContactData.vue":
/*!*************************************************!*\
  !*** ./resources/js/components/ContactData.vue ***!
  \*************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ContactData_vue_vue_type_template_id_12f96dcf_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ContactData.vue?vue&type=template&id=12f96dcf&scoped=true& */ "./resources/js/components/ContactData.vue?vue&type=template&id=12f96dcf&scoped=true&");
/* harmony import */ var _ContactData_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ContactData.vue?vue&type=script&lang=js& */ "./resources/js/components/ContactData.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ContactData_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ContactData_vue_vue_type_template_id_12f96dcf_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ContactData_vue_vue_type_template_id_12f96dcf_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "12f96dcf",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ContactData.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ContactData.vue?vue&type=script&lang=js&":
/*!**************************************************************************!*\
  !*** ./resources/js/components/ContactData.vue?vue&type=script&lang=js& ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactData_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./ContactData.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ContactData.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactData_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ContactData.vue?vue&type=template&id=12f96dcf&scoped=true&":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/ContactData.vue?vue&type=template&id=12f96dcf&scoped=true& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactData_vue_vue_type_template_id_12f96dcf_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ContactData.vue?vue&type=template&id=12f96dcf&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ContactData.vue?vue&type=template&id=12f96dcf&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactData_vue_vue_type_template_id_12f96dcf_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ContactData_vue_vue_type_template_id_12f96dcf_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);