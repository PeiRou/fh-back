webpackJsonp([1],{

/***/ 477:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(818)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(820)
/* template */
var __vue_template__ = __webpack_require__(955)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/Game.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2beefe62", Component.options)
  } else {
    hotAPI.reload("data-v-2beefe62", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 764:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(765)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(767)
/* template */
var __vue_template__ = __webpack_require__(773)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-4d4a2e68"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/mainWrap/siderBar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4d4a2e68", Component.options)
  } else {
    hotAPI.reload("data-v-4d4a2e68", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 765:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(766);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("75bf043c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4d4a2e68\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./siderBar.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4d4a2e68\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./siderBar.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 766:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/*全局样式*/\nbody[data-v-4d4a2e68] {\n\tfont: 12px/1.5 \"\\5FAE\\8F6F\\96C5\\9ED1\", \"\\5B8B\\4F53\", Arial, Helvetica, sans-serif;\n\toverflow-y: hidden;\n}\n.main-body[data-v-4d4a2e68] {\n\tposition: absolute;\n\toverflow-x: auto;\n\ttop: 0;\n\tleft: 0;\n\tright: 0;\n\tbottom: 30px;\n}\n.clearfix[data-v-4d4a2e68]:after {\n\tcontent: \"\";\n\theight: 0;\n\tvisibility: hidden;\n\tdisplay: block;\n\tclear: both;\n}\n.clearfix[data-v-4d4a2e68] {\n\tzoom: 1;\n}\na[data-v-4d4a2e68] {\n\ttext-decoration: none;\n}\na[data-v-4d4a2e68]:hover {\n\ttext-decoration: none;\n}\n.show[data-v-4d4a2e68] {\n\tdisplay: block;\n}\n/*与sidebar有关的全局性样式*/\n/*与sidebar有关的全局性样式结束*/\n/*skin_blue相关的全局性样式*/\n/*skin_blue相关的全局性样式结束*/\n/*全局样式结束 将顶部固定在了左上角*/\n/*skin_blue 样式 sidebar*/\n.skin_blue .sub[data-v-4d4a2e68] {\n\tcolor: #666;\n\tbackground: #e6e6e6;\n\tbackground: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n\tbackground: linear-gradient( to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n\tborder-bottom: 1px solid #ccc;\n}\n.skin_blue .sub a[data-v-4d4a2e68] {\n\tcolor: #666;\n}\n.skin_blue .sub .selected[data-v-4d4a2e68],\n.skin_blue .sub a[data-v-4d4a2e68]:hover {\n\tcolor: #f98d5c;\n}\n.skin_blue .r-wrap[data-v-4d4a2e68],\n.skin_blue .r-wrap a[data-v-4d4a2e68] {\n\tcolor: #fff;\n}\n.skin_blue .r-nowrap1[data-v-4d4a2e68] {\n\tbackground: #2161b3;\n}\n.skin_blue .nowrap2[data-v-4d4a2e68] {\n\tborder: solid 1px #f4521b;\n\tbackground: #ff9461;\n\tbackground: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgba(255, 148, 97, 1)), to(rgba(255, 104, 53, 1)));\n\tbackground: linear-gradient( to bottom, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%);\n}\n.skin_blue .nowrap2[data-v-4d4a2e68]:hover {\n\tbackground: url(\"/static/game/images/skin/blue/announce-bg.png\") no-repeat center bottom;\n}\n.skin_blue li.link[data-v-4d4a2e68]:hover {\n\tbackground: #346fb9;\n\tbackground: -webkit-gradient( linear, left top, left bottom, color-stop(0, rgba(52, 111, 185, 1)), to(rgba(52, 111, 185, 1)));\n\tbackground: linear-gradient( to bottom, rgba(52, 111, 185, 1) 0, rgba(52, 111, 185, 1) 100%);\n}\n/*skin_blue 样式 siderbar 结束*/\n/*与中间有关的样式*/\n.main-wrap[data-v-4d4a2e68] {\n\tposition: absolute;\n\twidth: 100%;\n\ttop: 137px;\n\tbottom: 0;\n}\n/*与中间有关的样式结束*/\n/*siderbar相关样式*/\n.siderbar[data-v-4d4a2e68] {\n\tposition: absolute;\n\twidth: 200px;\n\ttop: 0;\n\tleft: 0;\n\tbottom: 0;\n\tbackground-color: #e6e6e6;\n\ttext-align: center;\n\tborder-right: solid 1px #ccc;\n}\n.side_left ul[data-v-4d4a2e68] {\n\tlist-style: outside none none;\n\tmargin: 0;\n\tpadding: 0;\n}\n.side_left li[data-v-4d4a2e68] {\n\tposition: relative;\n}\n.side_left li a[data-v-4d4a2e68] {\n\tdisplay: block;\n\twidth: 100%;\n\theight: 100%;\n}\n.side_left p[data-v-4d4a2e68] {\n\tdisplay: block;\n\tline-height: 18px;\n\tmargin: 0;\n\twhite-space: nowrap;\n}\n.side_left[data-v-4d4a2e68] {\n\tmargin-bottom: 2px;\n}\n.side_left .r-wrap[data-v-4d4a2e68] {\n\twidth: 190px;\n\tfont-weight: 700;\n\tmargin: 4px 5px 0 5px;\n\tline-height: 16px;\n\t/*background: #2161b3;*/\n}\n.side_left .r-nowrap1[data-v-4d4a2e68] {\n\tfont-size: 14px;\n\theight: 32px;\n\tline-height: 32px;\n\ttext-align: center;\n\tborder-radius: 4px;\n}\n.side_left .info[data-v-4d4a2e68] {\n\tborder: 1px solid #999;\n\tborder-top: none;\n\twidth: 188px;\n\tmargin: -2px 5px 8px;\n\tline-height: 22px;\n\tbackground: #fff;\n\tborder-bottom-left-radius: 4px;\n\tborder-bottom-right-radius: 4px;\n\ttext-align: left;\n\ttext-indent: 25px;\n\tpadding: 5px 0;\n}\n.side_left .info a[data-v-4d4a2e68] {\n\tdisplay: inline;\n\tmargin-left: 5px;\n}\n.side_left .info a img[data-v-4d4a2e68] {\n\tvertical-align: bottom;\n}\n.side_left .new[data-v-4d4a2e68] {\n\tposition: absolute;\n\ttop: 10px;\n\tright: 15px;\n}\n.side_left .nowrap2[data-v-4d4a2e68] {\n\tdisplay: inline-block;\n\twidth: 88px;\n\theight: 34px;\n\tline-height: 34px;\n\tfont-size: 12px;\n\tfont-weight: 700;\n\ttext-align: center;\n\tborder-radius: 3px;\n}\n/*siderbar相关样式结束*/\n/*orderList样式*/\n.sider-col2[data-v-4d4a2e68] {\n\tmargin: 0 1px;\n}\n", ""]);

// exports


/***/ }),

/***/ 767:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuex__ = __webpack_require__(338);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__cart_orderList__ = __webpack_require__(768);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__cart_orderList___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__cart_orderList__);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

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
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
  name: "sider-bar",
  data: function data() {
    return {
      userMessage: {},
      orderListFromBack: {}
    };
  },

  components: {
    OrderList: __WEBPACK_IMPORTED_MODULE_1__cart_orderList___default.a
  },
  computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["b" /* mapGetters */])({
    orderList: "getOrderList",
    userName: "getUserName",
    money: "getMoney",
    testFlag: "getTestFlag",
    bettingTotal: "getBettingTotal",
    currentGameCode: "getCurrentGameCode"
  }), {
    userNameComputed: function userNameComputed() {
      if (this.testFlag === 1) {
        return "游客";
      } else {
        // userMessage表示用户登录进来之后再刷新（后面的需要覆盖前面的）

        // this.userName是第一次登录进来之后获取的，这里我们直接将数据存入即可，之后每次更新先用vuex，然后每次开奖之后，用后台校验一次

        // 后端覆盖前段的数据
        return this.userName;
        // if(this.userMessage !== {}){
        // return this.userMessage.user
        // }else{
        //
        // }
      }
    },
    moneyComputed: function moneyComputed() {
      return this.money;
      // if(this.userMessage !== {}){
      //     return this.userMessage.money
      // }else{
      //     return this.money
      // }
    },
    bettingTotalComputed: function bettingTotalComputed() {
      return this.bettingTotal;

      // if(this.userMessage !== {}){
      //     return this.userMessage.sel_money
      // }else{
      //     return this.bettingTotal
      // }
    },

    // 这里我们取出从后台获取的数据

    gameIdComputed: {
      get: function get() {
        switch (this.currentGameCodeFromLocalStorage) {
          case 'jspk10':
            return '80';
          case 'pk10':
            return '50';
          case 'jsft':
            return '82';
          case 'jsssc':
            return '81';
          case 'cqssc':
            return '1';
          default:
            return '80';
        }
      }

    },
    // orderListComputed: {
    //    get: function () {
    //         if(this.orderListFromBack !== {}) {
    //             return this.orderListFromBack.orders
    //         }else{
    //             return this.orderList
    //         }
    // }
    // },
    currentGameCodeFromLocalStorage: {
      get: function get() {
        var code = window.localStorage.getItem('currentGameCode');
        return code;
      }
      // 这里我们取出从后台获取的数据
    } }),
  methods: {
    closeContSider: function closeContSider() {
      // alert('closeContSider')
      this.$store.dispatch("contSiderShowFalse");
    }
  },
  mounted: function mounted() {
    var _this = this;

    // 获取用户信息
    axios.get('/web/getUser').then(function (response) {
      _this.userMessage = response.data;
      // console.log(this.userMessage)
      _this.$store.dispatch('refresh_sel_money', _this.userMessage);
    });

    // 获取用户注单信息
    axios.get('/web/getOrders/' + this.gameIdComputed).then(function (response) {
      _this.orderListFromBack = response.data;
    });
  }
});

/***/ }),

/***/ 768:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(769)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(771)
/* template */
var __vue_template__ = __webpack_require__(772)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-acc8d2a6"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/mainWrap/cart/orderList.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-acc8d2a6", Component.options)
  } else {
    hotAPI.reload("data-v-acc8d2a6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 769:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(770);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("77d58254", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-acc8d2a6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./orderList.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-acc8d2a6\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./orderList.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 770:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\na[data-v-acc8d2a6],\nb[data-v-acc8d2a6],\nblockquote[data-v-acc8d2a6],\nbody[data-v-acc8d2a6],\ncaption[data-v-acc8d2a6],\ndd[data-v-acc8d2a6],\ndiv[data-v-acc8d2a6],\ndl[data-v-acc8d2a6],\ndt[data-v-acc8d2a6],\nem[data-v-acc8d2a6],\nform[data-v-acc8d2a6],\nh1[data-v-acc8d2a6],\nh2[data-v-acc8d2a6],\nh3[data-v-acc8d2a6],\nh4[data-v-acc8d2a6],\nh5[data-v-acc8d2a6],\nh6[data-v-acc8d2a6],\ni[data-v-acc8d2a6],\niframe[data-v-acc8d2a6],\nimg[data-v-acc8d2a6],\ninput[data-v-acc8d2a6],\nlabel[data-v-acc8d2a6],\nli[data-v-acc8d2a6],\nobject[data-v-acc8d2a6],\nol[data-v-acc8d2a6],\np[data-v-acc8d2a6],\nspan[data-v-acc8d2a6],\nstrong[data-v-acc8d2a6],\ntable[data-v-acc8d2a6],\ntbody[data-v-acc8d2a6],\ntd[data-v-acc8d2a6],\ntfoot[data-v-acc8d2a6],\nth[data-v-acc8d2a6],\nthead[data-v-acc8d2a6],\ntr[data-v-acc8d2a6],\nu[data-v-acc8d2a6],\nul[data-v-acc8d2a6] {\n    padding: 0;\n    margin: 0\n}\ntable[data-v-acc8d2a6] {\n    border-collapse: collapse;\n    border-spacing: 0\n}\nfieldset[data-v-acc8d2a6],\nimg[data-v-acc8d2a6] {\n    border: 0\n}\nimg[data-v-acc8d2a6] {\n    -ms-interpolation-mode: bicubic\n}\ninput[data-v-acc8d2a6],\nselect[data-v-acc8d2a6],\ntextarea[data-v-acc8d2a6] {\n    font-family: Arial, Helvetica, sans-serif\n}\nol[data-v-acc8d2a6],\nul[data-v-acc8d2a6] {\n    list-style: none\n}\nh1[data-v-acc8d2a6],\nh2[data-v-acc8d2a6],\nh3[data-v-acc8d2a6],\nh4[data-v-acc8d2a6],\nh5[data-v-acc8d2a6],\nh6[data-v-acc8d2a6] {\n    font-size: 100%\n}\nbody[data-v-acc8d2a6] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.sider-col2[data-v-acc8d2a6] {\n    margin: 0 1px\n}\n#lastBets[data-v-acc8d2a6] {\n    display: none\n}\n#lastBets .bets[data-v-acc8d2a6] {\n    border-left: 1px solid #b9c2cb;\n    border-right: 1px solid #b9c2cb;\n    color: #000;\n    width: 188px;\n    overflow-y: auto;\n    text-indent: 5px;\n    text-align: left;\n    margin: 4px 4px 0 4px;\n    max-height: 300px\n}\n#betResultPanel li[data-v-acc8d2a6] {\n    background: #fff none repeat scroll 0 0;\n    border-top: 1px solid;\n    padding: 1px\n}\n#lastBets li[data-v-acc8d2a6] {\n    background: #fff none repeat scroll 0 0;\n    padding: 1px\n}\n#lastBets li[data-v-acc8d2a6]:nth-child(2n) {\n    background: #efefef none repeat scroll 0 0\n}\n.side_left .bets .bid[data-v-acc8d2a6] {\n    color: #119400\n}\n.side_left .bets .text[data-v-acc8d2a6] {\n    color: #0017c7\n}\n.side_left .bets .odds[data-v-acc8d2a6] {\n    color: red;\n    font-family: Arial, Helvetica, Verdana, Geneva, sans-serif;\n    font-weight: 700\n}\n.side_left li[data-v-acc8d2a6] {\n    position: relative\n}\n.side_left li a[data-v-acc8d2a6] {\n    display: block;\n    width: 100%;\n    height: 100%\n}\n\n", ""]);

// exports


/***/ }),

/***/ 771:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuex__ = __webpack_require__(338);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

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
    name: "order-list",
    data: function data() {
        return {
            orderListFromBack: {}
        };
    },

    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["b" /* mapGetters */])({
        orderList: 'getOrderList',
        currentGameCode: 'getCurrentGameCode', // 从localStorage里面取出
        plays: 'getMspk10LmpPlays',
        playCates: 'getMspk10LmpPlayCates'
    }), {
        currentGameCodeFromLocalStorage: {
            get: function get() {
                var code = window.localStorage.getItem('currentGameCode');
                return code;
            }

        },
        gameIdComputed: {
            get: function get() {
                switch (this.currentGameCodeFromLocalStorage) {
                    case 'jspk10':
                        return '80';
                    case 'pk10':
                        return '50';
                    case 'jsft':
                        return '82';
                    case 'jsssc':
                        return '81';
                    case 'cqssc':
                        return '1';
                    default:
                        return '80';
                }
            }
        },
        orderListWithGoodsName: {
            get: function get() {
                var _this = this;

                // 通过id获取名字，通过playCateId获取第二个参数
                // return this.plays
                var emptyArr = [];
                // this.cartList.forEach(cartItem => {
                //     for(let item in this.plays) {
                //         // console.log(item)
                //         if(item == cartItem.id){
                //             this.plays[item].count = cartItem.count
                //             emptyArr.push(this.plays[item])
                //         }
                //     }
                // })
                // 存在于vuex里面的，只存id，之后需要什么数据，就取出什么数据
                // //1. 将相关的信息从plays里面取出
                // this.cartList.forEach(cartItem => {
                //     for(let item in this.plays) {
                //         // console.log(item)
                //         if(item === cartItem.id){
                //             cartItem.name         = this.plays[item].name
                //             cartItem.playCateId   = this.plays[item].playCateId
                //             cartItem.odds         = this.plays[item].odds
                //             cartItem.rebate       = this.plays[item].rebate
                //             cartItem.minMoney     = this.plays[item].minMoney
                //             cartItem.maxMoney     = this.plays[item].maxMoney
                //             cartItem.maxTurnMoney = this.plays[item].maxTurnMoney
                //
                //         }
                //     }
                // })
                //
                // //2. 将相关的信息(playCate 的名字)从playCates里面取出
                // this.cartList.forEach(cartItem => {
                //     for(let item in this.playCates) {
                //         // console.log(item)
                //         if(item === cartItem.playCateId){
                //             cartItem.playCatesName        = this.playCates[item].name
                //             // console.log(cartItem)
                //         }
                //     }
                // })
                //
                // //3. 将名字组合起来
                // this.cartList.forEach(cartItem => {
                //     if(cartItem.playCateId === 1) {
                //         cartItem.goodsName = cartItem.name
                //     } else {
                //         cartItem.goodsName = cartItem.playCatesName + ' ' + cartItem.name
                //     }
                // })
                //
                //4.将cart中的信息存入emptyArr
                // this.cartList.forEach(cartItem => {
                //     emptyArr.push(cartItem)
                // })

                // 将前面四步的内容合并在一起，这里特别要注意for循环是并行的要用if把这些for循环连接起来
                var step = 0;
                this.orderList.forEach(function (cartItem) {
                    if (step === 0) {
                        for (var item in _this.plays) {
                            //1. 将相关的信息从plays里面取出
                            if (item == cartItem.id) {
                                cartItem.gameId = _this.plays[item].gameId;
                                cartItem.name = _this.plays[item].name;
                                cartItem.playCateId = _this.plays[item].playCateId;
                                cartItem.odds = _this.plays[item].odds;
                                cartItem.rebate = _this.plays[item].rebate;
                                cartItem.minMoney = _this.plays[item].minMoney;
                                cartItem.maxMoney = _this.plays[item].maxMoney;
                                cartItem.maxTurnMoney = _this.plays[item].maxTurnMoney;

                                // 加入开奖期数 通过当前页面获取相关的期数，先不考虑客户 多个彩种同时下注的情况
                            }
                        }
                        step++;
                    }
                    if (step === 1) {
                        //2. 将相关的信息(playCate 的名字)从playCates里面取出
                        for (var _item in _this.playCates) {
                            // console.log(item)
                            if (_item == cartItem.playCateId) {
                                cartItem.playCatesName = _this.playCates[_item].name;
                                cartItem.playCateNameId = _this.playCates[_item].id;
                                // console.log(cartItem)
                            }
                        }
                        step++;
                    }
                    if (step === 2) {
                        // console.log(cartItem.playCateNameId)
                        // 这里需要如果名字是总和-龙虎和，那么需要playCateName不用加上
                        if (cartItem.playCateNameId == 1) {
                            cartItem.goodsName = cartItem.name;
                        } else {
                            cartItem.goodsName = cartItem.playCatesName + ' - ' + cartItem.name;
                        }
                        step++;
                    }
                    if (step === 3) {
                        //4.将cart中的信息存入emptyArr
                        emptyArr.push(cartItem);
                        //最后一步将step清0
                        step = 0;
                    }
                });
                // console.log(_this.emptyArr)
                // console.log(step)
                return emptyArr;
            }
        }
    }),
    mounted: function mounted() {
        var _this2 = this;

        // 获取用户注单信息
        axios.get('/web/getOrders/' + this.gameIdComputed).then(function (response) {
            _this2.orderListFromBack = response.data;
            // console.log('从后台获取的数据')
            // 这里获取的数据中的期数字段需要从 issue改成expect
            _this2.$store.dispatch('StoreOrderListFromBack', _this2.orderListFromBack);
        });
    }
});

/***/ }),

/***/ 772:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      {
        staticClass: "side_left",
        staticStyle: { display: "block" },
        attrs: { id: "lastBets" }
      },
      [
        _c(
          "ul",
          { staticClass: "bets" },
          _vm._l(this.orderListWithGoodsName, function(item) {
            return _c("li", [
              _c("p", [
                _vm._v("期号："),
                _c("span", { staticClass: "bid" }, [
                  _vm._v(_vm._s(item.expect))
                ])
              ]),
              _vm._v(" "),
              _c("p", [
                _vm._v("\n                    内容："),
                _c("span", { staticClass: "text" }, [
                  _vm._v(
                    " " + _vm._s(item.goodsName) + "\n                    "
                  )
                ]),
                _vm._v("@ "),
                _c("span", { staticClass: "odds" }, [_vm._v(_vm._s(item.odds))])
              ]),
              _vm._v(" "),
              _c("p", [_vm._v("金额：￥" + _vm._s(item.count))])
            ])
          })
        )
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-acc8d2a6", module.exports)
  }
}

/***/ }),

/***/ 773:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "siderbar" }, [
    _c("div", { staticClass: "side_left userctrl" }, [
      _c("ul", [
        _c("li", [
          _c("div", { staticClass: "r-wrap r-nowrap1" }, [_vm._v("账户信息")]),
          _vm._v(" "),
          _c("div", { staticClass: "info" }, [
            _c("div", [
              _c("label", [_vm._v("账号：")]),
              _c("span", { attrs: { id: "userinfo_name" } }, [
                _vm._v(_vm._s(_vm.userNameComputed))
              ])
            ]),
            _vm._v(" "),
            _c("div", [
              _c("label", [_vm._v("账号余额：")]),
              _c("span", { staticClass: "balance" }, [
                _vm._v(_vm._s(_vm.moneyComputed))
              ])
            ]),
            _vm._v(" "),
            _c("div", [
              _c("label", [_vm._v("未结金额：")]),
              _c("span", { staticClass: "betting" }, [
                _vm._v(_vm._s(_vm.bettingTotalComputed))
              ]),
              _vm._v(" "),
              _vm._m(0)
            ])
          ])
        ]),
        _vm._v(" "),
        _vm._m(1),
        _vm._v(" "),
        _vm._m(2),
        _vm._v(" "),
        _c("li", { staticClass: "r-wrap " }, [
          _c(
            "div",
            { staticClass: "nowrap2" },
            [
              _c("router-link", { attrs: { to: "/frame/wechatchange" } }, [
                _vm._v("在线充值")
              ])
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "nowrap2" },
            [
              _c("router-link", { attrs: { to: "/frame/tk" } }, [
                _vm._v("在线提款")
              ])
            ],
            1
          )
        ]),
        _vm._v(" "),
        _c(
          "li",
          { staticClass: "r-wrap r-nowrap1 link" },
          [
            _c(
              "router-link",
              {
                staticClass: "r-bg",
                attrs: { to: "/frame/Grzx" },
                nativeOn: {
                  click: function($event) {
                    _vm.closeContSider()
                  }
                }
              },
              [_vm._v("个人中心")]
            ),
            _vm._v(" "),
            _c("img", {
              staticClass: "new",
              attrs: { src: "/static/game/static/images/msg_new2.png" }
            })
          ],
          1
        ),
        _vm._v(" "),
        _c(
          "li",
          { staticClass: "r-wrap r-nowrap1 link" },
          [
            _c(
              "router-link",
              { staticClass: "r-bg", attrs: { to: "/frame/Cjhd" } },
              [_vm._v("抽奖活动")]
            ),
            _vm._v(" "),
            _c("img", {
              staticClass: "new",
              attrs: { src: "/static/game/static/images/msg_new2.png" }
            })
          ],
          1
        ),
        _vm._v(" "),
        _vm._m(3)
      ])
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "sider-col2" },
      [_vm.orderList.length ? _c("OrderList") : _vm._e()],
      1
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "a",
      { attrs: { href: "javascript:void(0)", title: "点击刷新消息" } },
      [
        _c("img", {
          attrs: {
            alt: "点击刷新消息",
            src: "/static/game/static/images/refresh.png",
            width: "18",
            height: "18",
            title: "点击刷新消息"
          }
        })
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", { staticClass: "r-wrap r-nowrap1" }, [
      _c("a", { attrs: { href: "javascript:;", target: "_blank" } }, [
        _vm._v("开奖直播")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", { staticClass: "r-wrap r-nowrap1" }, [
      _c("a", { attrs: { href: "javascript:;", target: "_blank" } }, [
        _vm._v("手机APP下载")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", { staticClass: "r-wrap r-nowrap1" }, [
      _c("div", [_vm._v("最新注单")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4d4a2e68", module.exports)
  }
}

/***/ }),

/***/ 818:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(819);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("2983ddce", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2beefe62\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Game.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2beefe62\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Game.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 819:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n.el-notification__title {\n    background: #4274b3;\n    padding: 3px 15px;\n    display: inline-block;\n    font-size: 16px;\n    color: #FFFFFF;\n}\n.t-qi{\n    color: #2060b3;\n}\n", ""]);

// exports


/***/ }),

/***/ 820:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__parts_mainBodyOuter_vue__ = __webpack_require__(821);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__parts_mainBodyOuter_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__parts_mainBodyOuter_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__common_loading_Loading_vue__ = __webpack_require__(951);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__common_loading_Loading_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__common_loading_Loading_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_js_cookie__ = __webpack_require__(340);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_js_cookie___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_js_cookie__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__helpers_jwt__ = __webpack_require__(201);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_vuex__ = __webpack_require__(338);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

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



 // 引入Loading

//为读取cookie而引入的插件






/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            getPlayCatesOuter: {
                getPlayCates: {}
            },
            getPlaysOuter: {
                getPlays: {}
            },
            getGameMapOuter: {
                getGameMap: {}
            },
            winData: {} //开奖中奖数据
        };
    },

    name: "game",
    components: {
        mainBodyOuter: __WEBPACK_IMPORTED_MODULE_0__parts_mainBodyOuter_vue___default.a,
        Loading: __WEBPACK_IMPORTED_MODULE_1__common_loading_Loading_vue___default.a
    },
    methods: {
        getData: function getData() {
            var _this = this;
            window.axios.get('/static/gamedatas.js').then(function (response) {
                // 获取数据
                var str = response.data;
                // 将数据切割成数组
                var strs = str.split(";");
                // let gamesArray = strs[0].slice(13,-1).split(",")
                // for (let i = 0; i < gamesArray.length; i++) {
                //     _this.getGameDatas.games[i] = gamesArray[i]
                // }
                // _this.getGameDatas.gameMap      = JSON.parse(strs[1].slice(15))
                // _this.getGameDatas.playCates    = JSON.parse(strs[2].slice(17))
                // _this.getGameDatas.plays        = JSON.parse(strs[3].slice(13))
                // _this.getGameDatas.playComs     = JSON.parse(strs[4].slice(16))
                // _this.getGameDatas.animalsYear  = strs[5].slice(20,-1)
                // console.log(strs[2].slice(17));
                // 游戏数据
                // 标题数据
                _this.getPlayCatesOuter.getPlayCates = JSON.parse(strs[2].slice(17));
                // input数据
                _this.getPlaysOuter.getPlays = JSON.parse(strs[3].slice(13));

                //console.log(_this.getPlayCates)

            }).then(
            // console.log(JSON.stringify(_this.getGameDatas))


            // 将标题数据存入
            this.$store.dispatch('getPlayCatesFromGameDatas', { getPlayCatesFromGameDatas: _this.getPlayCatesOuter }),

            // 将input数据存入
            this.$store.dispatch('getPlaysFromGameDatas', { getPlaysFromGameDatas: _this.getPlaysOuter })

            // console.log(_this.getPlaysOuter)
            // this.$store.dispatch('getGameDatas',{ getGameDatas: _this.getGameDatas })
            );

            setTimeout(function () {
                _this.$store.dispatch('hideLoading');
            }, 500);
        },

        getOpenCodeData: function getOpenCodeData() {
            var _this = this;
            // 获取所有的数据
            // 秒速赛车

            window.axios.get("/api/getMssc").then(function (response) {

                var _data = JSON.parse(response.data);
                // 将数据存入vuex
                _this.$store.dispatch('storeMsscOpenCodeData', { openCode: _data });
            }).catch(function (error) {
                console.log(error);
            });

            // 北京赛车

            window.axios.get("/api/getBjpk10").then(function (response) {

                var _data = response.data;
                // 将数据存入vuex 北京pk10与重庆时时彩是官方的接口，数据有点不一样
                _this.$store.dispatch('storeBjpk10OpenCodeData', { openCode: _data });
            }).catch(function (error) {
                console.log(error);
            });

            // 秒速飞艇

            window.axios.get("/api/getMsft").then(function (response) {

                var _data = JSON.parse(response.data);
                // 将数据存入vuex
                _this.$store.dispatch('storeMsftOpenCodeData', { openCode: _data });
            }).catch(function (error) {
                console.log(error);
            });

            //　秒速时时彩

            window.axios.get("/api/getMsssc").then(function (response) {

                var _data = JSON.parse(response.data);
                // 将数据存入vuex
                _this.$store.dispatch('storeMssscOpenCodeData', { openCode: _data });
            }).catch(function (error) {
                console.log(error);
            });

            // 重庆时时彩

            window.axios.get("/api/getCqssc").then(function (response) {
                var _data = response.data;
                // 将数据存入vuex
                _this.$store.dispatch('storeCqsscOpenCodeData', { openCode: _data });
            }).catch(function (error) {
                console.log(error);
            });
        }
    },
    mounted: function mounted() {

        var _this = this;

        // 之后所有获取数据的地方都放在Game.vue里面进行，然后取什么数据，就用currentGameCode来决定
        this.getOpenCodeData();

        this.getData();

        this.$store.dispatch('showLoading');

        // /接收开奖信息/
        _this.socket.on('open-channel', function (data) {
            _this.$store.dispatch('setOpenCodeSoundToTrue'); //  只有后台推送数据过来时才会响应
            // console.log(typeof (data));
            _this.winData = data;

            //校验挡前用户是否有中奖，   若有调用中奖通知组件

            console.log(_this.winListWithGoodsName);
            if (_this.winListWithGoodsName != "") {
                _this.$notify({
                    title: '中奖通知',
                    message: _this.winListWithGoodsName,
                    position: 'bottom-right',
                    duration: 5000,
                    dangerouslyUseHTMLString: true
                });
            }

            _this.$store.dispatch('setOpenCodeSoundToTrue'); //  只有后台推送数据过来时才会响应
            // console.log(data)
            switch (data.code) {
                case 'mssc':
                    // alert(data.issue)
                    // console.log(_this)
                    _this.$store.dispatch('storeMsscOpenCodeData', { openCode: data });
                    break;
                case 'bjpk10':
                    // alert('bjpk10')
                    _this.$store.dispatch('storeBjpk10OpenCodeData', { openCode: data });
                    break;
                case 'msft':
                    // alert('msft')
                    _this.$store.dispatch('storeMsftOpenCodeData', { openCode: data });
                    break;
                case 'msssc':
                    // alert('msssc')
                    _this.$store.dispatch('storeMssscOpenCodeData', { openCode: data });
                    break;
                case 'cqssc':
                    // alert('cqssc')
                    _this.$store.dispatch('storeCqsscOpenCodeData', { openCode: data });
                    break;
                // case 'lhc':
                //     alert('lhc 香港六合彩还未开通')
                //     // this.$router.push({path: '/lhc/tema'})
                //     break
                // case 'xydd':
                //     // alert('xydd')
                //     this.$router.push({path: '/xydd/xydd'})
                //     break
                // case 'xync':
                //     alert('xync 幸运农场还未开通')
                //     // this.$router.push({path: '/cqxync/lmp'})
                //     break
                // case 'xylhc':
                //     alert('xylhc 幸运六合彩')
                //     // this.$router.push({path: '/xylhc/tema'})
                //     break
                default:
                    alert('在最外层的Game.vue里面的switch case里面，code没有这个值，修改那里面的case');
                    break;
                // case ''
            }
        });
    },

    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_4_vuex__["b" /* mapGetters */])({
        loading: 'loading',
        plays: 'getMspk10LmpPlays',
        playCates: 'getMspk10LmpPlayCates',
        currentGameCode: 'getCurrentGameCode',
        gameMap: 'getAllGames',
        userName: 'getUserName'
        // authenticated: 'getAuthenticated'
    }), {
        winListWithGoodsName: function winListWithGoodsName() {
            var _this2 = this;

            var _this = this;

            // return _this.winData.winner
            // 通过id获取名字，通过playCateId获取第二个参数
            // return this.plays
            var emptyArr = [];
            //
            // this.cartList.forEach(cartItem => {
            //     for(let item in this.plays) {
            //         // console.log(item)
            //         if(item == cartItem.id){
            //             this.plays[item].count = cartItem.count
            //             emptyArr.push(this.plays[item])
            //         }
            //     }
            // })

            // 存在于vuex里面的，只存id，之后需要什么数据，就取出什么数据

            // //1. 将相关的信息从plays里面取出
            //
            // this.cartList.forEach(cartItem => {
            //     for(let item in this.plays) {
            //         // console.log(item)
            //         if(item === cartItem.id){
            //             cartItem.name         = this.plays[item].name
            //             cartItem.playCateId   = this.plays[item].playCateId
            //             cartItem.odds         = this.plays[item].odds
            //             cartItem.rebate       = this.plays[item].rebate
            //             cartItem.minMoney     = this.plays[item].minMoney
            //             cartItem.maxMoney     = this.plays[item].maxMoney
            //             cartItem.maxTurnMoney = this.plays[item].maxTurnMoney
            //
            //         }
            //     }
            // })
            //
            // //2. 将相关的信息(playCate 的名字)从playCates里面取出
            // this.cartList.forEach(cartItem => {
            //     for(let item in this.playCates) {
            //         // console.log(item)
            //         if(item === cartItem.playCateId){
            //             cartItem.playCatesName        = this.playCates[item].name
            //             // console.log(cartItem)
            //         }
            //     }
            // })
            //
            // //3. 将名字组合起来
            // this.cartList.forEach(cartItem => {
            //     if(cartItem.playCateId === 1) {
            //         cartItem.goodsName = cartItem.name
            //     } else {
            //         cartItem.goodsName = cartItem.playCatesName + ' ' + cartItem.name
            //     }
            // })
            //
            //4.将cart中的信息存入emptyArr
            // this.cartList.forEach(cartItem => {
            //     emptyArr.push(cartItem)
            // })

            // 将前面四步的内容合并在一起，这里特别要注意for循环是并行的要用if把这些for循环连接起来


            var step = 0;

            var emptyArrUserName = [];

            _this.winData.winer.forEach(function (item) {
                if (item.user === _this2.userName) {
                    emptyArrUserName.push(item);
                }
            });

            // 通过userName筛选中奖信息


            emptyArrUserName.forEach(function (winDataItem) {
                // console.log(123)
                if (step === 0) {
                    for (var item in _this.plays) {
                        // console.log(item)

                        //1. 将相关的信息从plays里面取出
                        if (item == winDataItem.gameId) {
                            winDataItem.gameId = _this2.plays[item].gameId;
                            winDataItem.name = _this2.plays[item].name;
                            winDataItem.playCateId = _this2.plays[item].playCateId;
                            winDataItem.odds = _this2.plays[item].odds;
                            winDataItem.rebate = _this2.plays[item].rebate;
                            winDataItem.minMoney = _this2.plays[item].minMoney;
                            winDataItem.maxMoney = _this2.plays[item].maxMoney;
                            winDataItem.maxTurnMoney = _this2.plays[item].maxTurnMoney;
                            // console.log(cartItem)
                        }
                    }
                    step++;
                }

                if (step === 1) {
                    //2. 将相关的信息(playCate 的名字)从playCates里面取出
                    for (var _item in _this.playCates) {
                        // console.log(item)
                        if (_item == winDataItem.playCateId) {
                            winDataItem.playCatesName = _this2.playCates[_item].name;
                            winDataItem.playCateNameId = _this2.playCates[_item].id;
                            // console.log(cartItem)
                        }
                    }
                    step++;
                }

                if (step === 2) {

                    // console.log(cartItem.playCateNameId)
                    // 这里需要如果名字是总和-龙虎和，那么需要playCateName不用加上
                    if (winDataItem.playCateNameId === 1) {
                        winDataItem.goodsName = winDataItem.name;
                    } else {
                        winDataItem.goodsName = winDataItem.playCatesName + ' - ' + winDataItem.name;
                    }
                    step++;
                }

                // 根据gameId取出gameName

                if (step == 3) {
                    for (var _item2 in _this.gameMap) {
                        //1. 将相关的信息从plays里面取出
                        if (_item2 == winDataItem.gameId) {
                            winDataItem.gameName = _this.gameMap[_item2].name;
                            // console.log(cartItem)
                        }
                    }

                    winDataItem.currentGameCode = _this2.currentGameCode;
                    step++;
                }

                if (step === 4) {
                    //4.将cart中的信息存入emptyArr


                    emptyArr.push(winDataItem);
                    //最后一步将step清0
                    step = 0;
                }
            });

            // console.log(_this.emptyArr)
            // console.log(step)
            //_this.winData = emptyArr;
            // return emptyArr;
            var nullStr = '';

            emptyArr.forEach(function (item) {
                nullStr += '\<p\>\<span class="t-qi"\> ' + item.gameName + '\ </span\> 第 <span style="color: #0c325e">' + _this2.winData.expect + '</span> 期 ' + item.goodsName + ' 已中奖, 中奖金额 \<span style="color: rgb(224, 79, 76);"\>' + item.money + '\</span\>\</p\>';
                nullStr = '\<div\>' + nullStr + '\</div\>';
            });

            return nullStr;

            // 在这里组拼 消息通知
            // 名字之后再在gameDatas里面取出来。这里我们先直接从currentCode里面取出


            // <div><p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第二球 单 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">1.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第二球 小 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">4975.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第一球 0 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">8.95</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 总和小 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">1.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第三球 小 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">4975.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第四球 大 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">1.00</span></p>
            //     <p><span class="t-qi">秒速时时彩</span> 第 180327639 期 第三球 小 已中奖, 中奖金额 <span
            //     style="color: rgb(224, 79, 76);">1.00</span></p></div>
            //     </div>

        }
    }),
    // 开始进行登录注册的状态管理

    created: function created() {

        // alert(Cookie.get('token'))
        // let token = this.$cookie.get('laravel_session');
        // console.log("Token"+token);

        // 如果localStorage里面没有的话，就要refreshToken,来存这个token

        this.$store.dispatch('setAuthUser');

        // console.log(Cookie.get('XSRF-TOKEN'));

        // if (jwtToken.getToken()) {
        //     this.$store.dispatch('setAuthUser')
        // // } else if(Cookie.get('auth_id')) {
        // } else if(Cookie.get('user_id')) {
        //     this.$store.dispatch('refreshToken')
        // }

    }
});

/***/ }),

/***/ 821:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(822)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(824)
/* template */
var __vue_template__ = __webpack_require__(950)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/mainBodyOuter.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2549acb8", Component.options)
  } else {
    hotAPI.reload("data-v-2549acb8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 822:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(823);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("040f4f34", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2549acb8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./mainBodyOuter.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2549acb8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./mainBodyOuter.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 823:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n.main-body {\n    position: absolute;\n    overflow-x: auto;\n    top: 0;\n    left: 0;\n    right: 0;\n    bottom: 30px;\n}\n.header {\n    position: absolute;\n    color: #fff;\n    min-width: 1240px;\n    width: 100%;\n}\n.main-wrap {\n    position: absolute;\n    width: 100%;\n    top: 137px;\n    bottom: 0;\n}\n.content-wrap {\n    min-width: 1038px;\n    overflow: hidden;\n    font-size: 12px;\n    position: absolute;\n    top: 0;\n    right: 0;\n    height: 100%;\n    overflow-y: auto;\n    left: 201px;\n}\n.el-notification__title {\n    background: #4274b3;\n    padding: 3px 15px;\n    display: inline-block;\n    font-size: 16px;\n    color: #FFFFFF;\n}\n", ""]);

// exports


/***/ }),

/***/ 824:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuex__ = __webpack_require__(338);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__header_headerTop__ = __webpack_require__(825);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__header_headerTop___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__header_headerTop__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__header_headerMiddle__ = __webpack_require__(830);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__header_headerMiddle___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__header_headerMiddle__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__header_headerBottom_headerBottom_Mspk10__ = __webpack_require__(835);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__header_headerBottom_headerBottom_Mspk10___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__header_headerBottom_headerBottom_Mspk10__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__header_headerBottom_headerBottom_Bjpk10__ = __webpack_require__(840);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__header_headerBottom_headerBottom_Bjpk10___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4__header_headerBottom_headerBottom_Bjpk10__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__header_headerBottom_headerBottom_Ftpk10__ = __webpack_require__(845);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__header_headerBottom_headerBottom_Ftpk10___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5__header_headerBottom_headerBottom_Ftpk10__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__header_headerBottom_headerBottom_Msccs__ = __webpack_require__(850);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__header_headerBottom_headerBottom_Msccs___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6__header_headerBottom_headerBottom_Msccs__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__header_headerBottom_headerBottom_Cqssc__ = __webpack_require__(855);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__header_headerBottom_headerBottom_Cqssc___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_7__header_headerBottom_headerBottom_Cqssc__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__header_headerBottom_headerBottom_Xydd__ = __webpack_require__(860);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__header_headerBottom_headerBottom_Xydd___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_8__header_headerBottom_headerBottom_Xydd__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__header_headerBottom_headerBottom_Xglhc__ = __webpack_require__(865);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__header_headerBottom_headerBottom_Xglhc___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_9__header_headerBottom_headerBottom_Xglhc__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__header_headerBottom_headerBottom_Cqxync__ = __webpack_require__(870);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__header_headerBottom_headerBottom_Cqxync___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_10__header_headerBottom_headerBottom_Cqxync__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__header_headerBottom_headerBottom_Xylhc__ = __webpack_require__(875);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__header_headerBottom_headerBottom_Xylhc___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_11__header_headerBottom_headerBottom_Xylhc__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__header_headerBottom_headerBottom_Xykl8__ = __webpack_require__(880);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__header_headerBottom_headerBottom_Xykl8___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_12__header_headerBottom_headerBottom_Xykl8__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__header_headerBottom_headerBottom_Pcdd__ = __webpack_require__(885);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__header_headerBottom_headerBottom_Pcdd___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_13__header_headerBottom_headerBottom_Pcdd__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__header_headerBottom_headerBottom_Gd11x5__ = __webpack_require__(890);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__header_headerBottom_headerBottom_Gd11x5___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_14__header_headerBottom_headerBottom_Gd11x5__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__header_headerBottom_headerBottom_Jssb__ = __webpack_require__(895);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__header_headerBottom_headerBottom_Jssb___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_15__header_headerBottom_headerBottom_Jssb__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__header_headerBottom_headerBottom_Bjkl8__ = __webpack_require__(900);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__header_headerBottom_headerBottom_Bjkl8___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_16__header_headerBottom_headerBottom_Bjkl8__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_17__header_headerBottom_headerBottom_Gdklsf__ = __webpack_require__(905);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_17__header_headerBottom_headerBottom_Gdklsf___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_17__header_headerBottom_headerBottom_Gdklsf__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_18__header_headerBottom_headerBottom_Xjssc__ = __webpack_require__(910);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_18__header_headerBottom_headerBottom_Xjssc___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_18__header_headerBottom_headerBottom_Xjssc__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_19__mainWrap_siderBar__ = __webpack_require__(764);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_19__mainWrap_siderBar___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_19__mainWrap_siderBar__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_20__mainWrap_contSider__ = __webpack_require__(915);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_20__mainWrap_contSider___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_20__mainWrap_contSider__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_21__common_footer_footer__ = __webpack_require__(920);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_21__common_footer_footer___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_21__common_footer_footer__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_22__common_chatbar_chatbar__ = __webpack_require__(925);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_22__common_chatbar_chatbar___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_22__common_chatbar_chatbar__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_23__common_modalbox_ModalBox_vue__ = __webpack_require__(945);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_23__common_modalbox_ModalBox_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_23__common_modalbox_ModalBox_vue__);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

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



 // 引入头部顶部组件
 // 引入头部中间组件

// 引入headerBottom开始

 // 引入头部底部的组件
















// 引入headerBottoim结束

 // 引入mainWrap中的siderBar,中间的部分contMain通过路由加载出来
 // 引入mainWrap中的右边 ContSider

 // 引入底部公告

 // 引入右侧聊天室



/* harmony default export */ __webpack_exports__["default"] = ({
    name: "main-body-outer",
    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["b" /* mapGetters */])({
        myState: 'getMyState',
        contSiderShow: 'getContSiderShow'
    })),
    data: function data() {
        return {
            headerBottom: 'HeaderBottom_Mspk10', //头部组件默认是　秒速赛车
            skin_color: 'skin_blue', // 默认皮肤是蓝色
            MessageFromBackEnd: ''
        };
    },

    methods: {
        get: function get(msg) {
            // 通过点击事件 改变headerMiddle中间的
            // this.msgParent = msg
            this.headerBottom = msg;
        },
        getSkin: function getSkin(msg) {
            // 通过点击事件 改变header
            // alert(msg)
            this.skin_color = msg;
        },
        open_zhaongjian: function open_zhaongjian() {
            this.$notify({
                title: '中奖通知',
                message: '<div class="el-notification__content"><div><p><span class="t-qi">秒速时时彩</span> 第 180327614 期 第三球  小 已中奖, 中奖金额 <span style="color: rgb(224, 79, 76);">4975.00</span></p><p><span class="t-qi">秒速时时彩</span> 第 180327614 期 第三球  单 已中奖, 中奖金额 <span style="color: rgb(224, 79, 76);">4975.00</span></p></div></div>',
                position: 'bottom-right',
                duration: 0,
                dangerouslyUseHTMLString: true

            });
        }
    },
    components: {
        HeaderTop: __WEBPACK_IMPORTED_MODULE_1__header_headerTop___default.a,
        HeaderMiddle: __WEBPACK_IMPORTED_MODULE_2__header_headerMiddle___default.a,
        // 引入headerBottom
        HeaderBottom_Mspk10: __WEBPACK_IMPORTED_MODULE_3__header_headerBottom_headerBottom_Mspk10___default.a, // 最开始加载的
        jspk10: __WEBPACK_IMPORTED_MODULE_3__header_headerBottom_headerBottom_Mspk10___default.a, // 通过headerMiddle点击事件,从子组件headMiddle传出的值jspk10
        pk10: __WEBPACK_IMPORTED_MODULE_4__header_headerBottom_headerBottom_Bjpk10___default.a,
        jsft: __WEBPACK_IMPORTED_MODULE_5__header_headerBottom_headerBottom_Ftpk10___default.a,
        jsssc: __WEBPACK_IMPORTED_MODULE_6__header_headerBottom_headerBottom_Msccs___default.a,
        cqssc: __WEBPACK_IMPORTED_MODULE_7__header_headerBottom_headerBottom_Cqssc___default.a,
        xydd: __WEBPACK_IMPORTED_MODULE_8__header_headerBottom_headerBottom_Xydd___default.a,
        lhc: __WEBPACK_IMPORTED_MODULE_9__header_headerBottom_headerBottom_Xglhc___default.a,
        xylhc: __WEBPACK_IMPORTED_MODULE_11__header_headerBottom_headerBottom_Xylhc___default.a,
        xync: __WEBPACK_IMPORTED_MODULE_10__header_headerBottom_headerBottom_Cqxync___default.a,
        xykl8: __WEBPACK_IMPORTED_MODULE_12__header_headerBottom_headerBottom_Xykl8___default.a,
        pcdd: __WEBPACK_IMPORTED_MODULE_13__header_headerBottom_headerBottom_Pcdd___default.a,
        gd11x5: __WEBPACK_IMPORTED_MODULE_14__header_headerBottom_headerBottom_Gd11x5___default.a,
        jsk3: __WEBPACK_IMPORTED_MODULE_15__header_headerBottom_headerBottom_Jssb___default.a,
        //　缺少 福彩3D 需要扣

        bjkl8: __WEBPACK_IMPORTED_MODULE_16__header_headerBottom_headerBottom_Bjkl8___default.a,
        gdkl10: __WEBPACK_IMPORTED_MODULE_17__header_headerBottom_headerBottom_Gdklsf___default.a,
        xjssc: __WEBPACK_IMPORTED_MODULE_18__header_headerBottom_headerBottom_Xjssc___default.a,

        // 缺少 天津时时彩　
        // 引入headerBottom结束


        SiderBar: __WEBPACK_IMPORTED_MODULE_19__mainWrap_siderBar___default.a,
        ContSider: __WEBPACK_IMPORTED_MODULE_20__mainWrap_contSider___default.a,
        FooterNotice: __WEBPACK_IMPORTED_MODULE_21__common_footer_footer___default.a,
        ChatBar: __WEBPACK_IMPORTED_MODULE_22__common_chatbar_chatbar___default.a,
        ModalBox: __WEBPACK_IMPORTED_MODULE_23__common_modalbox_ModalBox_vue___default.a

    }

});

/***/ }),

/***/ 825:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(826)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(828)
/* template */
var __vue_template__ = __webpack_require__(829)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-b6d9b45c"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerTop.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b6d9b45c", Component.options)
  } else {
    hotAPI.reload("data-v-b6d9b45c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 826:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(827);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("1d76d86a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b6d9b45c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerTop.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b6d9b45c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerTop.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 827:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/*全局样式*/\n.logo-header[data-v-b6d9b45c]{\n    margin-top: 12px;\n    margin-left: 19px;\n    height: 40px;\n}\nbody[data-v-b6d9b45c] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.main-body[data-v-b6d9b45c] {\n    position: absolute;\n    overflow-x: auto;\n    top: 0;\n    left: 0;\n    right: 0;\n    bottom: 30px;\n}\n.clearfix[data-v-b6d9b45c]:after {\n    content: \"\";\n    height: 0;\n    visibility: hidden;\n    display: block;\n    clear: both;\n}\n.clearfix[data-v-b6d9b45c] {\n    zoom: 1\n}\na[data-v-b6d9b45c] {\n    text-decoration: none;\n}\na[data-v-b6d9b45c]:hover {\n    text-decoration: none;\n}\n\n/*全局样式结束 将顶部固定在了左上角*/\n\n/*skin_blue skin_red公共样式*/\n.menu1 .draw_number[data-v-b6d9b45c] {\n    position: absolute;\n    left: 15px;\n    top: 5px;\n}\n.menu1 .draw_number div[data-v-b6d9b45c] {\n    height: 22px;\n    line-height: 22px;\n    text-align: center;\n}\n\n/*skin_blue skin_red公共样式结束*/\n\n/*skin_blue相关样式*/\n.skin_blue .header[data-v-b6d9b45c] {\n    background: #2060b3;\n}\n.skin_blue .header-top[data-v-b6d9b45c] {\n    background: url(\"/static/game/images/skin/blue/main_bg.jpg\") no-repeat 0 0;\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-b6d9b45c],\n.skin_blue #skinPanel:hover ul[data-v-b6d9b45c],\n.skin_blue .skinHover[data-v-b6d9b45c] {\n    background: #234b95;\n}\n.skin_blue .header .menu3 a[data-v-b6d9b45c] {\n    background-color: #2f97f7;\n}\n\n/*skin_blue相关样式结束*/\n\n/*头部相关样式*/\n#result_balls[data-v-b6d9b45c] {\n    position: absolute;\n    left: 130px;\n    top: 10px;\n}\n.menu1 a span[data-v-b6d9b45c] {\n    display: block;\n    float: left;\n}\n.menu1 a b[data-v-b6d9b45c] {\n    display: block;\n    width: 27px;\n    height: 27px;\n    font-size: 0;\n    text-indent: -99999px;\n    margin-top: 10px;\n}\n.menu1 a i[data-v-b6d9b45c] {\n    display: block;\n    text-align: center;\n    font-style: normal;\n    font-weight: bolder;\n    color: #fff;\n}\n.menu1 .T_PK10 b[data-v-b6d9b45c] {\n    margin: 15px 0 0 5px;\n    height: 20px;\n    background: url(\"/static/game/images/ball/ball-pk.png\") no-repeat;\n}\n.menu1 .T_PK10 .b1[data-v-b6d9b45c] {\n    background-position: 0 0;\n}\n.menu1 .T_PK10 .b2[data-v-b6d9b45c] {\n    background-position: 0 -21px;\n}\n.menu1 .T_PK10 .b3[data-v-b6d9b45c] {\n    background-position: 0 -42px;\n}\n.menu1 .T_PK10 .b4[data-v-b6d9b45c] {\n    background-position: 0 -63px;\n}\n.menu1 .T_PK10 .b5[data-v-b6d9b45c] {\n    background-position: 0 -84px;\n}\n.menu1 .T_PK10 .b6[data-v-b6d9b45c] {\n    background-position: 0 -105px;\n}\n.menu1 .T_PK10 .b7[data-v-b6d9b45c] {\n    background-position: 0 -126px;\n}\n.menu1 .T_PK10 .b8[data-v-b6d9b45c] {\n    background-position: 0 -147px;\n}\n.menu1 .T_PK10 .b9[data-v-b6d9b45c] {\n    background-position: 0 -168px;\n}\n.menu1 .T_PK10 .b10[data-v-b6d9b45c] {\n    background-position: 0 -189px;\n}\n.menu1 span[data-v-b6d9b45c] {\n    display: block;\n    float: left;\n}\n.menu1 b[data-v-b6d9b45c] {\n    display: block;\n    height: 27px;\n    margin-top: 10px;\n    text-indent: -99999px;\n    width: 27px;\n}\n.menu1 i[data-v-b6d9b45c] {\n    color: #fff;\n    display: block;\n    font-style: normal;\n    font-weight: bolder;\n    text-align: center;\n}\n.header .menu2[data-v-b6d9b45c] {\n    line-height: 22px;\n    font-size: 13px;\n    position: absolute;\n    left: 738px;\n    top: 10px;\n}\n.header .menu2 span[data-v-b6d9b45c] {\n    padding: 0 5px;\n}\n.header .menu2 a[data-v-b6d9b45c] {\n    width: 5em;\n}\n.header .menu4[data-v-b6d9b45c] {\n    position: absolute;\n    left: 1050px;\n    top: 20px;\n}\n.header .menu4 a[data-v-b6d9b45c] {\n    display: block;\n    line-height: 22px;\n    background-image: url(\"/static/game/images/support.png\");\n    width: 70px;\n    height: 25px;\n}\n.header .menu3[data-v-b6d9b45c] {\n    position: absolute;\n    left: 1130px;\n    top: 20px;\n}\n.header .menu3 a[data-v-b6d9b45c] {\n    display: block;\n    line-height: 24px;\n    width: 60px;\n    height: 24px;\n    border-radius: 3px;\n    background: url(\"/static/game/images/logout.png\") no-repeat 9px center;\n    padding-left: 10px;\n}\n#skinPanel[data-v-b6d9b45c] {\n    display: inline-block;\n    color: #fff;\n    cursor: pointer;\n}\n#skinPanel ul[data-v-b6d9b45c] {\n    padding: 0 0 10px 0;\n    margin-left: -5px;\n    list-style: none;\n    position: absolute;\n    width: 62px;\n    z-index: 999;\n    display: none;\n}\n#skinPanel:hover ul[data-v-b6d9b45c] {\n    display: block;\n}\n#skinPanel ul li[data-v-b6d9b45c] {\n    padding: 2px 6px;\n    height: 20px;\n    line-height: 22px;\n    clear: both;\n}\n#skinPanel li a[data-v-b6d9b45c] {\n    color: #ddd;\n    text-align: center;\n    vertical-align: middle;\n}\n#skinPanel li a[data-v-b6d9b45c]:hover {\n    color: #fff;\n}\n#skinPanel li i[data-v-b6d9b45c] {\n    display: inline-block;\n    border: solid 1px #ffc8c8;\n    height: 9px;\n    width: 9px;\n    vertical-align: middle;\n    margin-right: 5px;\n}\n#skinPanel li a:hover i[data-v-b6d9b45c] {\n    border-color: #fff;\n}\n\n/*头部相关样式结束*/\n\n/*顶部声音开启 关闭图标*/\n.menu1 .open_sound[data-v-b6d9b45c] {\n    position: absolute;\n    right: 10px;\n    top: 5px;\n    background: url(/static/game/images/sound.png) no-repeat;\n    display: block;\n    float: right;\n    width: 16px;\n    height: 16px;\n    cursor: pointer;\n    z-index: 99;\n}\n.menu1 .close_sound[data-v-b6d9b45c] {\n    position: absolute;\n    right: 10px;\n    top: 5px;\n    background: url(/static/game/images/sound-close.png) no-repeat;\n    display: block;\n    width: 16px;\n    height: 16px;\n    cursor: pointer;\n    z-index: 99;\n}\n\n/*后来加上的*/\n.skin_red #skinPanel:hover ul[data-v-b6d9b45c] {\n    background: #832c3c;\n}\n.skin_red .header .menu3 a[data-v-b6d9b45c] {\n    background-color: #751d28;\n}\n.menu1 .T_SSC b[data-v-b6d9b45c] {\n    margin-left: 10px;\n    background: url(/static/game/images/ball/ball_2.png) no-repeat\n}\n.menu1 .T_SSC .b0[data-v-b6d9b45c] {\n    background-position: 0 0\n}\n.menu1 .T_SSC .b1[data-v-b6d9b45c] {\n    background-position: 0 -27px\n}\n.menu1 .T_SSC .b2[data-v-b6d9b45c] {\n    background-position: 0 -54px\n}\n.menu1 .T_SSC .b3[data-v-b6d9b45c] {\n    background-position: 0 -81px\n}\n.menu1 .T_SSC .b4[data-v-b6d9b45c] {\n    background-position: 0 -108px\n}\n.menu1 .T_SSC .b5[data-v-b6d9b45c] {\n    background-position: 0 -135px\n}\n.menu1 .T_SSC .b6[data-v-b6d9b45c] {\n    background-position: 0 -162px\n}\n.menu1 .T_SSC .b7[data-v-b6d9b45c] {\n    background-position: 0 -189px\n}\n.menu1 .T_SSC .b8[data-v-b6d9b45c] {\n    background-position: 0 -216px\n}\n.menu1 .T_SSC .b9[data-v-b6d9b45c] {\n    background-position: 0 -243px\n}\n.menu1 b[data-v-b6d9b45c] {\n    display: block;\n    height: 27px;\n    margin-top: 10px;\n    text-indent: -99999px;\n    width: 27px;\n}\n\n\n", ""]);

// exports


/***/ }),

/***/ 828:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuex__ = __webpack_require__(338);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

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
    name: "header-top",
    data: function data() {
        return {
            open: true,
            skin_blue: 'skin_blue',
            skin_red: 'skin_red'
        };
    },

    methods: {
        handleSound: function handleSound() {
            this.open = !this.open;
            this.$store.dispatch('handleSoundAlways');
        },
        change_skin_red: function change_skin_red() {

            // 更换皮肤的时候,就可以监听到 这个最好放到配置项文件里面
            //window.frames[0].postMessage('change_skin_red', 'http:112.213.105.60:8002')
            // alert('红色')
            // alert(this.skin_red)
            this.$emit('child-info-for-skin', this.skin_red);
        },
        change_skin_blue: function change_skin_blue() {

            // 更换皮肤的时候,就可以监听到 这个最好放到配置项文件里面
            //window.frames[0].postMessage('change_skin_blue', 'http:112.213.105.60:8002')
            // alert('蓝色')
            // alert(this.skin_blue)
            this.$emit('child-info-for-skin', this.skin_blue);
        },
        logout: function logout() {
            var _this = this;

            this.$confirm('确定退出系统吗？', '退出', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(function () {
                //这里是我们写的东西
                _this.$store.dispatch('logoutRequest'), location.href = '/';
                //这里是我们写的东西
                _this.$message({
                    type: 'success',
                    message: '退出成功'
                });
            }).catch(function () {
                _this.$message({
                    type: 'info',
                    message: 'Delete canceled'
                });
            });
            //和
            // this.$store.dispatch('logoutRequest')
            // location.href = '/'
        }
    },
    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["b" /* mapGetters */])({
        msscLmpOpenCodeData: 'getMsscLmpOpenCodeData',
        gameMap: 'getAllGames',
        currentGameCode: 'getCurrentGameCode',
        msscOpenCodeData: 'getMsscOpenCodeData',
        bjpk10OpenCodeData: 'getBjpk10OpenCodeData',
        msftOpenCodeData: 'getMsftOpenCodeData',
        mssscOpenCodeData: 'getMssscOpenCodeData',
        cqsscOpenCodeData: 'getCqsscOpenCodeData'
    }), {

        // gameName: {
        //     get: function () {
        //         let gameMap = this.gameMap
        //         let currentGameCode = this.msscLmpOpenCodeData.code
        //         // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
        //         if (currentGameCode === 'mssc') {
        //             currentGameCode = 'jspk10'
        //         }
        //
        //         // return this.gameMap
        //         for(let item in gameMap) {
        //             // console.log(gameMap[item]['code'])
        //             if (gameMap[item].code === currentGameCode) {
        //                 // console.log(123)
        //                 return this.gameMap[item].name
        //             }
        //         }
        //     }
        // },
        // openCodeClassName: {
        //         get: function () {
        //             let emptyArr = []
        //             let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
        //             currentOpenCode.forEach(item => {
        //                 let empyItem = 'b' + item
        //                 emptyArr.push(empyItem)
        //             })
        //             return emptyArr
        //         }
        // }
        gameName: {
            get: function get() {
                var gameMap = this.gameMap;
                var currentGameCode = 'jspk10';
                // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                // alert(this.currentGameCode)
                // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                if (this.currentGameCode === 'jspk10') {
                    currentGameCode = 'jspk10'; // vuex里面的值

                    var currentGameCodeFromLocalStorage = window.localStorage.getItem('currentGameCode'); // 从localStorage里面取出的
                    if (currentGameCodeFromLocalStorage != null) {
                        currentGameCode = currentGameCodeFromLocalStorage;
                    }
                }
                if (this.currentGameCode === 'pk10') {
                    currentGameCode = 'pk10';
                }
                if (this.currentGameCode === 'jsft') {
                    currentGameCode = 'jsft';
                }
                if (this.currentGameCode === 'jsssc') {
                    currentGameCode = 'jsssc';
                }
                if (this.currentGameCode === 'cqssc') {
                    currentGameCode = 'cqssc';
                }
                // return this.gameMap
                for (var item in gameMap) {
                    // console.log(gameMap[item]['code'])
                    if (gameMap[item].code === currentGameCode) {
                        // alert(123)
                        return this.gameMap[item].name;
                    }
                }
            }
        },
        openCodeClassName: {
            get: function get() {

                // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                var currentGameCode = 'jspk10';
                // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                // alert(this.currentGameCode)
                // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                if (this.currentGameCode === 'jspk10') {
                    currentGameCode = 'jspk10'; // vuex里面的值

                    var currentGameCodeFromLocalStorage = window.localStorage.getItem('currentGameCode'); // 从localStorage里面取出的
                    if (currentGameCodeFromLocalStorage != null) {
                        currentGameCode = currentGameCodeFromLocalStorage;
                    }
                }
                if (this.currentGameCode === 'pk10') {
                    currentGameCode = 'pk10';
                }
                if (this.currentGameCode === 'jsft') {
                    currentGameCode = 'jsft';
                }
                if (this.currentGameCode === 'jsssc') {
                    currentGameCode = 'jsssc';
                }
                if (this.currentGameCode === 'cqssc') {
                    currentGameCode = 'cqssc';
                }

                switch (currentGameCode) {
                    case 'jspk10':
                        // alert('jspk10')
                        // console.log(this.msscOpenCodeData.opencode)
                        // this.msscOpenCodeData.opencode
                        var emptyArr = [];
                        // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                        var currentOpenCode = this.msscOpenCodeData.opencode.split(',');
                        currentOpenCode.forEach(function (item) {
                            var empyItem = 'b' + parseInt(item);
                            emptyArr.push(empyItem);
                        });
                        return emptyArr;

                        break;
                    case 'pk10':
                        // alert('pk10')
                        var emptyArr2 = [];
                        // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                        var currentOpenCode2 = this.bjpk10OpenCodeData.opencode.split(',');
                        currentOpenCode2.forEach(function (item) {
                            var empyItem2 = 'b' + parseInt(item);
                            emptyArr2.push(empyItem2);
                        });
                        return emptyArr2;

                        break;
                    case 'jsft':
                        var emptyArr3 = [];
                        // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                        var currentOpenCode3 = this.msftOpenCodeData.opencode.split(',');
                        currentOpenCode3.forEach(function (item) {
                            var empyItem3 = 'b' + parseInt(item);
                            emptyArr3.push(empyItem3);
                        });
                        return emptyArr3;
                        break;
                    case 'jsssc':
                        var emptyArr4 = [];
                        // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                        var currentOpenCode4 = this.mssscOpenCodeData.opencode.split(',');
                        currentOpenCode4.forEach(function (item) {
                            var empyItem4 = 'b' + parseInt(item);
                            emptyArr4.push(empyItem4);
                        });
                        return emptyArr4;
                        break;
                    case 'cqssc':
                        var emptyArr5 = [];
                        // let currentOpenCode = this.msscLmpOpenCodeData.opencode.split(',')
                        var currentOpenCode5 = this.cqsscOpenCodeData.opencode.split(',');
                        currentOpenCode5.forEach(function (item) {
                            var empyItem5 = 'b' + parseInt(item);
                            emptyArr5.push(empyItem5);
                        });
                        return emptyArr5;
                        break;
                    // case 'lhc':
                    //     alert('lhc 香港六合彩还未开通')
                    //     this.$store.dispatch('setCurrentGameCode', 'lhc')
                    //     // this.$router.push({path: '/lhc/tema'})
                    //     break
                    // case 'xydd':
                    //     // alert('xydd')
                    //     this.$store.dispatch('setCurrentGameCode', 'xydd')
                    //     this.$router.push({path: '/xydd/xydd'})
                    //     break
                    // case 'xync':
                    //     this.$store.dispatch('setCurrentGameCode', 'xync')
                    //     alert('xync 幸运农场还未开通')
                    //     // this.$router.push({path: '/cqxync/lmp'})
                    //     break
                    // case 'xylhc':
                    //     this.$store.dispatch('setCurrentGameCode', 'xylhc')
                    //     alert('xylhc 幸运六合彩')
                    //     // this.$router.push({path: '/xylhc/tema'})
                    //     break
                    default:
                        alert('路由里面没有这个值，请查看routes/index');
                        break;
                    // case ''
                }
            }
        },
        expect: {
            get: function get() {

                // 从localStorage里面取currentGameCode出来
                // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                var currentGameCode = 'jspk10';
                // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                // alert(this.currentGameCode)
                // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                if (this.currentGameCode === 'jspk10') {
                    currentGameCode = 'jspk10'; // vuex里面的值

                    var currentGameCodeFromLocalStorage = window.localStorage.getItem('currentGameCode'); // 从localStorage里面取出的
                    if (currentGameCodeFromLocalStorage != null) {
                        currentGameCode = currentGameCodeFromLocalStorage;
                    }
                }
                if (this.currentGameCode === 'pk10') {
                    currentGameCode = 'pk10';
                }
                if (this.currentGameCode === 'jsft') {
                    currentGameCode = 'jsft';
                }
                if (this.currentGameCode === 'jsssc') {
                    currentGameCode = 'jsssc';
                }
                if (this.currentGameCode === 'cqssc') {
                    currentGameCode = 'cqssc';
                }

                // 从localStorage里面取currentGameCode出来 end


                switch (currentGameCode) {
                    case 'jspk10':
                        // alert('jspk10')
                        // console.log(this.msscOpenCodeData.opencode)
                        return this.msscOpenCodeData.expect;
                        break;
                    case 'pk10':
                        // alert('pk10')
                        return this.bjpk10OpenCodeData.expect;
                        break;
                    case 'jsft':
                        // alert('jsft')
                        // this.$store.dispatch('setCurrentGameCode', 'jsft')
                        // this.$router.push({path: '/msft/lmp'})
                        return this.msftOpenCodeData.expect;
                        break;
                    case 'jsssc':
                        // alert('jsssc')
                        return this.mssscOpenCodeData.expect;
                        break;
                    case 'cqssc':
                        console.log(this.cqsscOpenCodeData);
                        return this.cqsscOpenCodeData.expect;
                        break;
                    // case 'lhc':
                    //     alert('lhc 香港六合彩还未开通')
                    //     this.$store.dispatch('setCurrentGameCode', 'lhc')
                    //     // this.$router.push({path: '/lhc/tema'})
                    //     break
                    // case 'xydd':
                    //     // alert('xydd')
                    //     this.$store.dispatch('setCurrentGameCode', 'xydd')
                    //     this.$router.push({path: '/xydd/xydd'})
                    //     break
                    // case 'xync':
                    //     this.$store.dispatch('setCurrentGameCode', 'xync')
                    //     alert('xync 幸运农场还未开通')
                    //     // this.$router.push({path: '/cqxync/lmp'})
                    //     break
                    // case 'xylhc':
                    //     this.$store.dispatch('setCurrentGameCode', 'xylhc')
                    //     alert('xylhc 幸运六合彩')
                    //     // this.$router.push({path: '/xylhc/tema'})
                    //     break
                    default:
                        alert('路由里面没有这个值，请查看routes/index');
                        break;
                    // case ''
                }
            }
        },
        isPk10game: {
            get: function get() {

                // 从localStorage里面取currentGameCode出来
                // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                var currentGameCode = 'jspk10';
                // 这里的逻辑是，首先从vuex里面取值，如果取到的是默认的 jspk10,
                // 那么可能是刷新进来的，所以这里我们从localStorage里面取出值.然后我们created的时候，


                // alert(this.currentGameCode)
                // 这里是与数据有关的，所以转化为jspk10 北京赛车也要注意可能是bjsc
                if (this.currentGameCode === 'jspk10') {
                    currentGameCode = 'jspk10'; // vuex里面的值

                    var currentGameCodeFromLocalStorage = window.localStorage.getItem('currentGameCode'); // 从localStorage里面取出的
                    if (currentGameCodeFromLocalStorage != null) {
                        currentGameCode = currentGameCodeFromLocalStorage;
                    }
                }
                if (this.currentGameCode === 'pk10') {
                    currentGameCode = 'pk10';
                }
                if (this.currentGameCode === 'jsft') {
                    currentGameCode = 'jsft';
                }
                if (this.currentGameCode === 'jsssc') {
                    currentGameCode = 'jsssc';
                }
                if (this.currentGameCode === 'cqssc') {
                    currentGameCode = 'cqssc';
                }

                // 从localStorage里面取currentGameCode出来 end


                switch (currentGameCode) {
                    case 'jspk10':
                        // alert('jspk10')
                        // console.log(this.msscOpenCodeData.opencode)
                        return true;
                        break;
                    case 'pk10':
                        // alert('pk10')
                        return true;
                        break;
                    case 'jsft':
                        // alert('jsft')
                        // this.$store.dispatch('setCurrentGameCode', 'jsft')
                        // this.$router.push({path: '/msft/lmp'})
                        return true;
                        break;
                    case 'jsssc':
                        // alert('jsssc')
                        return false;
                        break;
                    case 'cqssc':
                        // alert('cqssc')
                        return false;
                        break;
                    // case 'lhc':
                    //     alert('lhc 香港六合彩还未开通')
                    //     this.$store.dispatch('setCurrentGameCode', 'lhc')
                    //     // this.$router.push({path: '/lhc/tema'})
                    //     break
                    // case 'xydd':
                    //     // alert('xydd')
                    //     this.$store.dispatch('setCurrentGameCode', 'xydd')
                    //     this.$router.push({path: '/xydd/xydd'})
                    //     break
                    // case 'xync':
                    //     this.$store.dispatch('setCurrentGameCode', 'xync')
                    //     alert('xync 幸运农场还未开通')
                    //     // this.$router.push({path: '/cqxync/lmp'})
                    //     break
                    // case 'xylhc':
                    //     this.$store.dispatch('setCurrentGameCode', 'xylhc')
                    //     alert('xylhc 幸运六合彩')
                    //     // this.$router.push({path: '/xylhc/tema'})
                    //     break
                    default:
                        alert('路由里面没有这个值，请查看routes/index');
                        break;
                    // case ''
                }
            }
        }
    })
});

/***/ }),

/***/ 829:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-top clearfix" }, [
    _vm._m(0),
    _vm._v(" "),
    _c("div", { staticClass: "menu1" }, [
      _c("div", { staticClass: "draw_number" }, [
        _c("div", [_vm._v(_vm._s(_vm.gameName))]),
        _vm._v(" "),
        _c("div", [
          _c("span", { staticClass: "cur_turn_num" }, [
            _vm._v(_vm._s(_vm.expect))
          ]),
          _vm._v("期开奖")
        ])
      ]),
      _vm._v(" "),
      _vm.isPk10game
        ? _c(
            "div",
            { staticClass: "T_PK10 L_BJPK10", attrs: { id: "result_balls" } },
            _vm._l(_vm.openCodeClassName, function(item) {
              return _c("span", [
                _c("b", { staticClass: "T_PK10 L_BJPK10", class: item }, [
                  _vm._v(_vm._s(item))
                ])
              ])
            })
          )
        : _c(
            "div",
            { staticClass: "T_SSC L_CQSSC", attrs: { id: "result_balls" } },
            _vm._l(_vm.openCodeClassName, function(item) {
              return _c("span", [
                _c("b", { class: item }, [_vm._v(_vm._s(item))])
              ])
            })
          ),
      _vm._v(" "),
      _vm.open
        ? _c("div", {
            staticClass: "open_sound",
            attrs: { title: "点击关闭提醒声音" },
            on: {
              click: function($event) {
                _vm.handleSound()
              }
            }
          })
        : _vm._e(),
      _vm._v(" "),
      !_vm.open
        ? _c("div", {
            staticClass: "close_sound",
            attrs: { title: "点击开启提醒声音" },
            on: {
              click: function($event) {
                _vm.handleSound()
              }
            }
          })
        : _vm._e()
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "menu2" }, [
      _c(
        "span",
        [
          _c(
            "router-link",
            {
              attrs: { to: "/betList/unsettled" },
              nativeOn: {
                click: function($event) {
                  _vm.closeContSider()
                }
              }
            },
            [_vm._v("未结明细")]
          ),
          _vm._v("  |")
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "span",
        [
          _c(
            "router-link",
            {
              attrs: { to: "/betList/settled" },
              nativeOn: {
                click: function($event) {
                  _vm.closeContSider()
                }
              }
            },
            [_vm._v("今天已结")]
          ),
          _vm._v("  |")
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "span",
        [
          _c(
            "router-link",
            {
              attrs: { to: "/frame/history" },
              nativeOn: {
                click: function($event) {
                  _vm.closeContSider()
                }
              }
            },
            [_vm._v("开奖结果")]
          ),
          _vm._v("  |")
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "span",
        [
          _c(
            "router-link",
            {
              attrs: { to: "/betReport" },
              nativeOn: {
                click: function($event) {
                  _vm.closeContSider()
                }
              }
            },
            [_vm._v("历史报表")]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("br"),
      _vm._v(" "),
      _c(
        "span",
        [
          _c(
            "router-link",
            {
              attrs: { to: "/frame/userBetInfo" },
              nativeOn: {
                click: function($event) {
                  _vm.closeContSider()
                }
              }
            },
            [_vm._v("个人资讯")]
          ),
          _vm._v("  |")
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "span",
        [
          _c(
            "router-link",
            {
              attrs: { to: "/frame/gameRule" },
              nativeOn: {
                click: function($event) {
                  _vm.closeContSider()
                }
              }
            },
            [_vm._v("游戏规则")]
          ),
          _vm._v("  |")
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "span",
        [
          _c(
            "router-link",
            {
              attrs: { to: "/financial" },
              nativeOn: {
                click: function($event) {
                  _vm.closeContSider()
                }
              }
            },
            [_vm._v("充值记录")]
          ),
          _vm._v("  |")
        ],
        1
      ),
      _vm._v(" "),
      _c("span", { attrs: { id: "skinPanel" } }, [
        _vm._v("\n                更换皮肤\n                "),
        _c("ul", { staticStyle: { "margin-top": "0px" } }, [
          _c("li", [
            _c(
              "a",
              {
                attrs: { href: "javascript:void(0)" },
                on: {
                  click: function($event) {
                    _vm.change_skin_red()
                  }
                }
              },
              [
                _c("i", { staticStyle: { background: "rgb(220, 47, 57)" } }),
                _vm._v("红色")
              ]
            )
          ]),
          _vm._v(" "),
          _c("li", [
            _c(
              "a",
              {
                attrs: { href: "javascript:void(0)" },
                on: {
                  click: function($event) {
                    _vm.change_skin_blue()
                  }
                }
              },
              [
                _c("i", { staticStyle: { background: "rgb(83, 130, 188)" } }),
                _vm._v("蓝色")
              ]
            )
          ])
        ])
      ])
    ]),
    _vm._v(" "),
    _vm._m(1),
    _vm._v(" "),
    _c("div", { staticClass: "menu3" }, [
      _c(
        "a",
        {
          staticClass: "logout",
          attrs: { href: "javascript:void(0);" },
          on: {
            click: function($event) {
              _vm.logout()
            }
          }
        },
        [_vm._v("退出")]
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "logo2" }, [
      _c("img", {
        staticClass: "logo-header",
        attrs: { src: "/home/images/SS500LOGO.png", alt: "最专业彩票网" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "menu4" }, [
      _c("a", {
        staticClass: "support",
        attrs: { href: "javascript:void(0);" }
      })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-b6d9b45c", module.exports)
  }
}

/***/ }),

/***/ 830:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(831)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(833)
/* template */
var __vue_template__ = __webpack_require__(834)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-5fca81b0"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerMiddle.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5fca81b0", Component.options)
  } else {
    hotAPI.reload("data-v-5fca81b0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 831:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(832);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("8c8b9d20", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5fca81b0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerMiddle.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5fca81b0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerMiddle.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 832:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/*全局样式*/\nbody[data-v-5fca81b0] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.main-body[data-v-5fca81b0] {\n    position: absolute;\n    overflow-x: auto;\n    top: 0;\n    left: 0;\n    right: 0;\n    bottom: 30px;\n}\n.clearfix[data-v-5fca81b0]:after {\n    content: \"\";\n    height: 0;\n    visibility: hidden;\n    display: block;\n    clear: both;\n}\n.clearfix[data-v-5fca81b0] {\n    zoom: 1\n}\na[data-v-5fca81b0] {\n    text-decoration: none;\n}\na[data-v-5fca81b0]:hover {\n    text-decoration: none;\n}\n.show[data-v-5fca81b0] {\n    display: block;\n}\n\n/*与头部有关的全局性样式*/\n.header[data-v-5fca81b0] {\n    position: absolute;\n    color: #fff;\n    min-width: 1240px;\n    width: 100%;\n}\n.header .menu1[data-v-5fca81b0] {\n    width: 490px;\n    position: absolute;\n    left: 230px;\n    top: 0;\n}\n.header a[data-v-5fca81b0] {\n    color: #fff;\n    text-align: center;\n}\n\n/*与头部有关的全局性样式结束*/\n\n/*skin_blue相关的全局性样式*/\n.skin_blue .header[data-v-5fca81b0] {\n    background: #3682d0;\n}\n.skin_blue .header-top[data-v-5fca81b0] {\n    background: url(\"/static/game/images/skin/blue/main_bg.jpg\") no-repeat 0 0;\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-5fca81b0],\n.skin_blue #skinPanel:hover ul[data-v-5fca81b0],\n.skin_blue .skinHover[data-v-5fca81b0] {\n    background: #234b95;\n}\n.skin_blue .header .menu3 a[data-v-5fca81b0] {\n    background-color: #2f97f7;\n}\n\n/*skin_blue相关的全局性样式结束*/\n\n/*全局样式结束 将顶部固定在了左上角*/\n\n/*skin_blue 样式 header_middle*/\n.skin_blue .header .lotterys[data-v-5fca81b0] {\n    background: #2161b3;\n}\n.skin_blue .header .lotterys .show span[data-v-5fca81b0] {\n    background: url(\"/static/game/images/skin/blue/nav_shuxian.png\") no-repeat scroll right 10px;\n}\n.skin_blue .lotterys .selected[data-v-5fca81b0],\n.skin_blue .lotterys .show > a[data-v-5fca81b0]:hover {\n    color: #143679;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%)\n}\n.skin_blue .header .lotterys .more-game[data-v-5fca81b0] {\n    border-left: solid 1px #2161b3;\n}\n.skin_blue .header .more-game-drop[data-v-5fca81b0] {\n    background-color: #e7e7e7;\n    border: solid 1px #2161b3;\n}\n.skin_blue .header .gamebox a[data-v-5fca81b0] {\n    background: #2161b3;\n}\n\n/*skin_blue 样式 header_middle 结束*/\n\n/*header_middle相关样式*/\n.header .lotterys[data-v-5fca81b0] {\n    height: 38px;\n    line-height: 38px;\n    position: relative;\n    z-index: 2;\n}\n.header .lotterys .show[data-v-5fca81b0] {\n    float: left;\n}\n.header .lotterys .show > a[data-v-5fca81b0] {\n    display: block;\n    float: left;\n    font-size: 13px;\n    text-align: center;\n    width: 120px;\n    position: relative;\n}\n.header .lotterys .more-game[data-v-5fca81b0] {\n    position: absolute;\n    font-weight: 700;\n    text-align: center;\n    width: 112px;\n    height: 100%;\n    left: 1110px;\n    top: 0;\n}\n.header .lotterys .more-game > a[data-v-5fca81b0] {\n    display: block;\n    width: 100%;\n    height: 100%;\n    position: absolute;\n    top: 0;\n    left: 0;\n    z-index: 100;\n}\n.header .lotterys .currentGameTxt[data-v-5fca81b0] {\n    font-style: normal;\n    font-size: 13px;\n    font-weight: 400;\n}\n.header .lotterys .selected span[data-v-5fca81b0],\n.header .lotterys span[data-v-5fca81b0]:hover {\n    background: 0 0 !important;\n}\n.header .more-game-drop[data-v-5fca81b0] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333;\n}\n.header .editbtn[data-v-5fca81b0] {\n    position: absolute;\n    display: inline-block;\n    top: 13px;\n    right: 5px;\n    width: 12px;\n    height: 13px;\n    background: url(\"/static/game/images/btnremove.png\") no-repeat;\n    cursor: pointer;\n    display: none;\n}\n.header .lotterys a span[data-v-5fca81b0] {\n    display: block;\n    width: 100%;\n}\n.header .gamebox[data-v-5fca81b0] {\n    margin-top: 20px;\n    padding: 25px 35px;\n    background-color: #fff;\n    border: solid 1px #ccc;\n    font-size: 13px;\n    height: auto;\n    overflow: hidden;\n}\n.header .gamebox a[data-v-5fca81b0] {\n    display: block;\n    width: 130px;\n    height: 38px;\n    float: left;\n    margin: 1px;\n    color: #fff;\n    position: relative;\n}\n.header .gamebox .editbtn[data-v-5fca81b0] {\n    background: url(\"/static/game/images/btnadd.png\");\n}\n.header .lotterys.menu-editMode .editbtn[data-v-5fca81b0] {\n    display: block;\n}\n.header .more-game-drop .actions[data-v-5fca81b0] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px;\n}\n.header .more-game-drop .actionBtn[data-v-5fca81b0] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400;\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-5fca81b0] {\n    background: #bbb;\n    display: none;\n}\n.header .lotterys.menu-editMode .more-game-drop .action-cancel[data-v-5fca81b0] {\n    display: inline-block;\n}\n\n/*header_middle相关样式结束*/\n\n/*以下是增加的*/\n.skin_blue .header .more-game-drop[data-v-5fca81b0] {\n    display: none;\n}\n.skin_blue .header .lotterys .more-game:hover .more-game-drop[data-v-5fca81b0] {\n    display: block;\n}\n\n/*加入红色页面的hover效果*/\n.skin_red .header .more-game-drop[data-v-5fca81b0] {\n    display: none;\n}\n.skin_red .header .lotterys .more-game:hover .more-game-drop[data-v-5fca81b0] {\n    display: block;\n}\n\n\n\n", ""]);

// exports


/***/ }),

/***/ 833:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuex__ = __webpack_require__(338);
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

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
    name: "header-top",
    //向mainBodyOuter父组件传递数据
    data: function data() {
        return {
            // msgChild: 'child',
            // msgMspk10: 'Mspk10',
            // msgBjpk10: 'Bjpk10',
            // msgFtpk10: 'Ftpk10',
            // msgMsssc: 'Msssc',
            // msgCqssc: 'Cqssc',
            // msgXydd: 'Xydd',
            // msgXglhc: 'Xglhc',
            // msgCqxync: 'Cqxync',
            // msgXylhc: 'Xylhc',
            // msgXykl8: 'Xykl8',
            // msgPcdd: 'Pcdd',
            // msgGd11x5: 'Gd11x5',
            // msgJssb: 'Jssb',
            // msgBjkl8: 'Bjkl8',
            // msgGdklsf: 'Gdklsf',
            // msgXjssc: 'Xjssc',

            // 顶部选中效果
            changeSelected: 0,
            html: '更多游戏',
            changeMore: 0,
            orderedHeaderMiddleData: [],

            // 获取头部中间信息
            getGamesOuter: {
                getGames: "" // 头部中间的顺序
            },
            getGameMapOuter: {
                getGameMap: {} // 头部中间的信息
            },
            getOrderedHeaderMiddleOuter: {
                getOrderedHeaderMiddle: []
            }

        };
    },

    computed: _extends({}, Object(__WEBPACK_IMPORTED_MODULE_0_vuex__["b" /* mapGetters */])({
        headerMiddle: 'getAllGames',
        // headerMiddleOrderStr: 'getGamesOrderStr',
        headerMiddleOrderStr: 'getHeaderMiddleOrderStr',
        orderedHeaderMiddle: 'getOrderedHeaderMiddle'
    })),
    methods: {
        getHeaderTopInfoFromHeaderMiddleActive: function getHeaderTopInfoFromHeaderMiddleActive() {

            var getDataAccordingToHeaderMiddle = window.localStorage.getItem('headerMiddleActive');

            switch (getDataAccordingToHeaderMiddle) {
                case '0':
                    window.axios.get("/api/getMssc").then(function (response) {
                        var _data = JSON.parse(response.data);
                        // 将数据存入vuex
                        // _this.$store.dispatch('storeMsscLmpOpenCodeData', {openCode: _data})
                        _this.$store.dispatch('storeMsscOpenCodeData', { openCode: _data });
                    }).catch(function (error) {
                        console.log(error);
                    });
                    break;
                case '1':
                    window.axios.get("/api/getMssc").then(function (response) {
                        var _data = JSON.parse(response.data);
                        // 将数据存入vuex
                        // _this.$store.dispatch('storeMsscLmpOpenCodeData', {openCode: _data})
                        _this.$store.dispatch('storeMsscOpenCodeData', { openCode: _data });
                    }).catch(function (error) {
                        console.log(error);
                    });
                    break;
                case '2':
                    cartItem.expect = parseInt(this.msftOpenCodeData.expect) + 1;
                    break;
                case '3':
                    cartItem.expect = parseInt(this.mssscOpenCodeData.expect) + 1;
                    break;
                case '4':
                    cartItem.expect = parseInt(this.cqsscOpenCodeData.expect) + 1;
                    break;

                default:
                    alert('当前彩种接口还没有接上');
                    break;

            }
        },
        getHeaderMiddleActive: function getHeaderMiddleActive() {
            var headerMiddleActive = window.localStorage.getItem('headerMiddleActive');

            if (headerMiddleActive != null) {
                this.changeSelected = parseInt(headerMiddleActive);
            }
        },


        getData: function getData() {
            var _this = this;
            window.axios.get('/static/gamedatas.js').then(function (response) {
                // 获取数据
                var str = response.data;
                // 将数据切割成数组
                var strs = str.split(";");

                // let gamesArray = strs[0].slice(13,-1).split(",")
                var gamesArrayStr = strs[0].slice(13, -1);
                var lv = gamesArrayStr.split(',');

                // console.log(gamesArrayStr)

                // for (let i = 0; i < gamesArray.length; i++) {
                //     _this.getGamesOuter.getGames[i]   = gamesArray[i]
                // }
                _this.getGamesOuter.getGames = gamesArrayStr;
                _this.getGameMapOuter.getGameMap = JSON.parse(strs[1].slice(15));
                var lvv = JSON.parse(strs[1].slice(15));

                // let emptyArr = []
                lv.forEach(function (value, index) {
                    //console.log(value)
                    for (var i in lvv) {
                        if (value == lvv[i]['id']) {
                            // this.emptyArr.push(lvv[i])
                            _this.getOrderedHeaderMiddleOuter.getOrderedHeaderMiddle.push(lvv[i]);
                            // console.log(lvv[i]['name'])
                        }
                        // console.log(lvv[i]['id'])
                    }
                });
                // console.log(_this.getOrderedHeaderMiddleOuter.getOrderedHeaderMiddle)

                // console.log(emptyArr)
                // state.headerMiddleOrder.getGames.forEach((value,index,array) => { // 将item按照headerMiddleOrder(games)中的顺序一个一个地放入到orderHeaderMiddle中
                // console.log(value)
                // console.log(index)
                // console.log(array)
                // state.orderedHeaderMiddle.push(JSON.parse(JSON.stringify(state.headerMiddle))[value])
                // })
                // console.log(state.orderedHeaderMiddle)
                // emptyArr.forEach((value,index,array) => { // 将item按照headerMiddleOrder(games)中的顺序一个一个地放入到orderHeaderMiddle中
                //     console.log(value)
                //     console.log(index)
                //     console.log(array)
                //    orderedHeaderMiddleOuter
                //     })
                // console.log(JSON.parse(JSON.stringify(emptyArr)))
                // console.log(_this.getGameMapOuter.getGameMap)
                // console.log(_this.getGamesOuter)
            }).then(
            // this.$store.dispatch('getAllGames').then(this.$store.dispatch('getGameOrder')).then(this.$store.dispatch('getOrderedHeaderMiddle')).then(this.getOrderedHeaderMiddleData())
            this.$store.dispatch('getGamesFromGameDatas', { getGamesFromGameDatas: _this.getGamesOuter }), this.$store.dispatch('getGameMapFromGameDatas', { getGameMapFromGameDatas: _this.getGameMapOuter })).then(this.$store.dispatch('getOrderedHeaderMiddle', { getOrderedHeaderMiddle: _this.getOrderedHeaderMiddleOuter }));
            // .then(this.$store.dispatch('getOrderedHeaderMiddle')).then(this.getOrderedHeaderMiddleData())
            // 将headerMiddle顺序存入
            //  this.$store.dispatch('getGamesFromGameDatas', { getGamesFromGameDatas: _this.getGamesOuter }),
            // 将headerMiddle数据存入
            // this.$store.dispatch('getGameMapFromGameDatas', { getGameMapFromGameDatas: _this.getGameMapOuter })
        },
        getOrderedHeaderMiddleData: function getOrderedHeaderMiddleData() {
            this.orderedHeaderMiddleData = this.orderedHeaderMiddle;
        },

        // changeViewsToHome: function () {
        //     alert('home');
        // },
        // changeViewsToPosts: function () {
        //     alert('posts');
        // },
        // changeViewsToArchive: function () {
        //     alert('archive');
        // },
        // send() {
        //     this.$emit('child-info', this.msgChild)
        // },


        changeHeaderBottom: function changeHeaderBottom(msg, k) {
            // alert(msg);
            // 点击　右侧的contSider　显示
            //     alert('openContSider')

            //将active的class存入localStorage,然后每次这组件mounted的时候，就从localStorage里面取出来。然后
            window.localStorage.setItem('headerMiddleActive', k);

            window.localStorage.setItem('currentGameCode', msg);

            //为了更新顶部，这里我们将currentCode直接存入localStorage，然后更新页面的时候，走一下路由，由于headerMiddle是一直有的，所以我们直接在created里面走一下路由，然后将vuex里面的currentGameCode也更新一下

            this.$store.dispatch('contSiderShowTrue');

            this.changeSelected = k;
            this.html = '更多游戏';
            this.$emit('child-info-for-header-bottom', msg);
            // 根据改变headerBottom的传值，通过路由改变contMains的内容,点击跳转到这个大类下面的第一个小类
            switch (msg) {
                case 'jspk10':
                    // alert('jspk10')
                    this.$store.dispatch('setCurrentGameCode', 'jspk10');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/mspk10/lmp');

                    this.$router.push({ path: '/mspk10/lmp' });
                    break;
                case 'pk10':
                    // alert('pk10')
                    this.$store.dispatch('setCurrentGameCode', 'pk10');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/pk10/lmp');

                    this.$router.push({ path: '/pk10/lmp' });

                    break;
                case 'jsft':
                    // alert('jsft')
                    this.$store.dispatch('setCurrentGameCode', 'jsft');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/msft/lmp');

                    this.$router.push({ path: '/msft/lmp' });

                    break;
                case 'jsssc':
                    // alert('jsssc')
                    this.$store.dispatch('setCurrentGameCode', 'jsssc');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/msssc/comb');

                    this.$router.push({ path: '/msssc/comb' });

                    break;
                case 'cqssc':
                    // alert('cqssc')
                    this.$store.dispatch('setCurrentGameCode', 'cqssc');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/cqssc/comb');
                    this.$router.push({ path: '/cqssc/comb' });

                    break;
                case 'lhc':
                    alert('lhc 香港六合彩还未开通');
                    this.$store.dispatch('setCurrentGameCode', 'lhc');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    // window.localStorage.setItem('vue_routes', '/lhc/tema')

                    // this.$router.push({path: '/lhc/tema'})
                    break;
                case 'xydd':
                    // alert('xydd')
                    this.$store.dispatch('setCurrentGameCode', 'xydd');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/xydd/xydd');
                    this.$router.push({ path: '/xydd/xydd' });

                    break;
                case 'xync':
                    this.$store.dispatch('setCurrentGameCode', 'xync');

                    alert('xync 幸运农场还未开通');
                    // this.$router.push({path: '/cqxync/lmp'})
                    break;
                case 'xylhc':
                    this.$store.dispatch('setCurrentGameCode', 'xylhc');
                    alert('xylhc 幸运六合彩');
                    // this.$router.push({path: '/xylhc/tema'})
                    break;
                default:
                    alert('1路由里面没有这个值，请查看routes/index');
                    break;
            }
            // this.$router.push({path: '/mspk10/lmp'})

        },


        // changeHeaderBottomToMspk10(k) {
        //     alert('changeHeaderBottomToMspk10')
        // this.changeSelected = k
        // this.html = '更多游戏'

        // this.$emit('child-info-for-header-bottom', this.msgMspk10)
        // },
        // changeHeaderBottomToBjpk10() {
        //     alert('changeHeaderBottomToBjpk10')
        //     this.$emit('child-info-for-header-bottom', this.msgBjpk10)
        // },
        // changeHeaderBottomToFtpk10() {
        //     alert('changeHeaderBottomToFtpk10')
        //     this.$emit('child-info-for-header-bottom', this.msgFtpk10)
        // },
        // changeHeaderBottomToＭsssc() {
        //     alert('changeHeaderBottomToＭsssc');
        //     this.$emit('child-info-for-header-bottom', this.msgMsssc)
        // },
        // changeHeaderBottomToCqssc() {
        //     alert('changeHeaderBottomToCqssc');
        //     this.$emit('child-info-for-header-bottom', this.msgCqssc)
        //
        // },
        // changeHeaderBottomToXydd() {
        //     alert('changeHeaderBottomToXydd');
        //     this.$emit('child-info-for-header-bottom', this.msgXydd)
        // },
        // changeHeaderBottomToXglhc() {
        //     alert('changeHeaderBottomToXglhc');
        //     this.$emit('child-info-for-header-bottom', this.msgXglhc)
        //
        // },
        // changeHeaderBottomToCqxync() {
        //     alert('changeHeaderBottomToCqxync');
        //     this.$emit('child-info-for-header-bottom', this.msgCqxync)
        //
        // },
        // changeHeaderBottomToXylhc() {
        //     alert('changeHeaderBottomToXylhc');
        //     this.$emit('child-info-for-header-bottom', this.msgXylhc)
        // },
        changeHeaderBottomMore: function changeHeaderBottomMore(msg, k) {
            var _this2 = this;

            //将active的class存入localStorage,然后每次这组件mounted的时候，就从localStorage里面取出来。然后
            window.localStorage.setItem('headerMiddleActive', k);

            window.localStorage.setItem('currentGameCode', msg);

            //为了更新顶部，这里我们将currentCode直接存入localStorage，然后更新页面的时候，走一下路由，由于headerMiddle是一直有的，所以我们直接在created里面走一下路由，然后将vuex里面的currentGameCode也更新一下


            // alert(msg)
            this.changeMore = k;
            this.orderedHeaderMiddleData.forEach(function (v, ks) {
                if (k === ks) {
                    _this2.html = v.name;
                }
            });
            switch (msg) {
                case 'xykl8':
                    // alert('xykl8')
                    this.$store.dispatch('setCurrentGameCode', 'xykl8');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/xykl8/lmp');

                    this.$router.push({ path: '/xykl8/lmp' });
                    break;
                case 'pcdd':
                    // alert('pcdd')
                    this.$store.dispatch('setCurrentGameCode', 'pcdd');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/pcdd/pcdd');

                    this.$router.push({ path: '/pcdd/pcdd' });
                    break;
                case 'gd11x5':
                    this.$store.dispatch('setCurrentGameCode', 'gd11x5');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/gd11x5/lmp');

                    alert('gd11x5 广东11选5 连码 直选 还未开通');
                    this.$router.push({ path: '/gd11x5/lmp' });
                    break;
                case 'jsk3':
                    // alert('jsk3')
                    this.$store.dispatch('setCurrentGameCode', 'jsk3');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/jstb/dxtb');

                    this.$router.push({ path: '/jstb/dxtb' });
                    break;
                case 'fc3d':
                    alert('fc3d' + '福彩3D还未开通');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    // window.localStorage.setItem('vue_routes', '/mspk10/lmp')
                    this.$store.dispatch('setCurrentGameCode', 'fc3d');

                    // this.$router.push({path: ''})
                    break;
                case 'bjkl8':
                    // alert('bjkl8')
                    this.$store.dispatch('setCurrentGameCode', 'bjkl8');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/bjkl8/zhbswx');

                    this.$router.push({ path: '/bjkl8/zhbswx' });
                    break;
                case 'gdkl10':
                    alert('gdkl10 广东快乐十分 除两面盘之外还未开通');
                    this.$store.dispatch('setCurrentGameCode', 'gdkl10');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/gdklsf/lmp');

                    this.$router.push({ path: '/gdklsf/lmp' });
                    break;
                case 'xjssc':
                    // alert('xjssc')
                    this.$store.dispatch('setCurrentGameCode', 'xjssc');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    window.localStorage.setItem('vue_routes', '/xjssc/comb');

                    this.$router.push({ path: '/xjssc/comb' });
                    break;
                case 'tjssc':
                    alert('tjssc' + '天津时时彩还未开通');
                    // 将路由存入localStorage里面，下次跟新的时候回到上次的状态
                    // window.localStorage.setItem('vue_routes', '/mspk10/lmp')
                    this.$store.dispatch('setCurrentGameCode', 'tjssc');

                    // this.$router.push({path: ''})
                    break;
                default:
                    alert('2路由里面没有这个值，请查看routes/index');
                    break;
                // case ''
            }

            this.$emit('child-info-for-header-bottom', msg);
        }
    },
    // 这里请求的时候,我们先在这里获取数据,之后优化的时候,可以把获取数据的过程放在Game.vue created的地方,再获取了数据之后,就分配到两个地方,一部分作为商品标题和input,一部分作为头部headerMiddle所需要的数据
    created: function created() {

        var vue_routes = window.localStorage.getItem('vue_routes');

        if (vue_routes === null) {
            this.$router.push({ path: vue_routes });
        }

        //　开始的时候，获取各种数据，并且将数据放入orderedHeaderMiddleData数组中
        // this.$store.dispatch('getAllGames').then(this.$store.dispatch('getGameOrder')).then(this.$store.dispatch('getOrderedHeaderMiddle')).then(this.getOrderedHeaderMiddleData())
    },
    mounted: function mounted() {
        this.getData();
        this.getHeaderMiddleActive();
    }
});

/***/ }),

/***/ 834:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-middle lotterys" }, [
    _c(
      "div",
      { staticClass: "show" },
      _vm._l(_vm.orderedHeaderMiddle, function(item, index) {
        return index <= 4
          ? _c(
              "a",
              {
                class: { selected: _vm.changeSelected === index },
                attrs: { href: "javascript:void(0)" },
                on: {
                  click: function($event) {
                    _vm.changeHeaderBottom(item.code, index)
                  }
                }
              },
              [
                _c("span", [_vm._v(_vm._s(item.name))]),
                _vm._v(" "),
                _c("i", {
                  staticClass: "editbtn",
                  staticStyle: { display: "none" }
                })
              ]
            )
          : _vm._e()
      })
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-5fca81b0", module.exports)
  }
}

/***/ }),

/***/ 835:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(836)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(838)
/* template */
var __vue_template__ = __webpack_require__(839)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-be14f754"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Mspk10.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-be14f754", Component.options)
  } else {
    hotAPI.reload("data-v-be14f754", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 836:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(837);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("01787254", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-be14f754\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Mspk10.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-be14f754\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Mspk10.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 837:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/*全局样式*/\nbody[data-v-be14f754] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.main-body[data-v-be14f754] {\n    position: absolute;\n    overflow-x: auto;\n    top: 0;\n    left: 0;\n    right: 0;\n    bottom: 30px;\n}\n.clearfix[data-v-be14f754]:after {\n    content: \"\";\n    height: 0;\n    visibility: hidden;\n    display: block;\n    clear: both;\n}\n.clearfix[data-v-be14f754] {\n    zoom: 1\n}\na[data-v-be14f754] {\n    text-decoration: none;\n}\na[data-v-be14f754]:hover {\n    text-decoration: none;\n}\n.show[data-v-be14f754]{\n    display: block;\n}\n\n\n/*与头部有关的全局性样式*/\n.header[data-v-be14f754] {\n    position: absolute;\n    color: #fff;\n    min-width: 1240px;\n    width: 100%;\n}\n.header a[data-v-be14f754] {\n    color: #fff;\n    text-align: center;\n}\n\n/*与头部有关的全局性样式结束*/\n\n/*skin_blue相关的全局性样式*/\n.skin_blue .header[data-v-be14f754] {\n    background: #3682d0;\n}\n\n\n/*skin_blue相关的全局性样式结束*/\n\n/*全局样式结束 将顶部固定在了左上角*/\n\n/*skin_blue 样式 header_bottom*/\n.skin_blue .sub[data-v-be14f754] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc;\n}\n.skin_blue .sub a[data-v-be14f754] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-be14f754],\n.skin_blue .sub a[data-v-be14f754]:hover {\n    color: #f98d5c;\n}\n\n\n/*skin_blue 样式 header_bottom 结束*/\n\n\n\n/*header_bottom相关样式*/\n.header .sub[data-v-be14f754] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px;\n}\n.header .sub a[data-v-be14f754] {\n    padding: 0 .5em;\n}\n.header .sub .selected[data-v-be14f754],\n.header .sub a[data-v-be14f754]:hover {\n    font-weight: 700;\n}\n\n\n/*header_bottom相关样式结束*/\n", ""]);

// exports


/***/ }),

/***/ 838:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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

// import { mapGetters } from 'vuex'
/* harmony default export */ __webpack_exports__["default"] = ({
    name: "header-bottom-mspk10",
    // computed: mapGetters({
    // headerBottom: 'getHeaderBottom',
    // }),
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 839:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/mspk10/lmp", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("两面盘")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/mspk10/sol", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("单号1~10")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/mspk10/com", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("冠亚组合")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-be14f754", module.exports)
  }
}

/***/ }),

/***/ 840:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(841)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(843)
/* template */
var __vue_template__ = __webpack_require__(844)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-29347e10"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Bjpk10.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-29347e10", Component.options)
  } else {
    hotAPI.reload("data-v-29347e10", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 841:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(842);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("36fd32d9", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-29347e10\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Bjpk10.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-29347e10\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Bjpk10.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 842:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-29347e10] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-29347e10] {\n    position: relative\n}\na[data-v-29347e10] {\n    text-decoration: none\n}\na[data-v-29347e10]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-29347e10] {\n    display: none\n}\n.header .more-game-drop[data-v-29347e10] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-29347e10] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-29347e10] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-29347e10] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-29347e10] {\n    display: block\n}\n.header .sub[data-v-29347e10] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-29347e10] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-29347e10],\n.header .sub a[data-v-29347e10]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-29347e10] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-29347e10] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-29347e10] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-29347e10] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-29347e10],\n.skin_blue .sub a[data-v-29347e10]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-29347e10]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-29347e10],\n.skin_blue #skinPanel:hover ul[data-v-29347e10],\n.skin_blue .skinHover[data-v-29347e10] {\n    background: #234b95\n}\n.skin_blue .header[data-v-29347e10] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-29347e10] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 843:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            this.changeSelect = k;
        }
    },
    created: function created() {
        this.$store.dispatch('contSiderShowFalse');
    }
});

/***/ }),

/***/ 844:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/pk10/lmp", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("两面盘")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/pk10/sol", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("单号1~10")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/pk10/com", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("冠亚组合")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-29347e10", module.exports)
  }
}

/***/ }),

/***/ 845:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(846)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(848)
/* template */
var __vue_template__ = __webpack_require__(849)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-f1904904"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Ftpk10.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f1904904", Component.options)
  } else {
    hotAPI.reload("data-v-f1904904", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 846:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(847);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("5bc92cfb", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f1904904\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Ftpk10.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f1904904\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Ftpk10.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 847:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/*全局样式*/\nbody[data-v-f1904904] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.main-body[data-v-f1904904] {\n    position: absolute;\n    overflow-x: auto;\n    top: 0;\n    left: 0;\n    right: 0;\n    bottom: 30px;\n}\n.clearfix[data-v-f1904904]:after {\n    content: \"\";\n    height: 0;\n    visibility: hidden;\n    display: block;\n    clear: both;\n}\n.clearfix[data-v-f1904904] {\n    zoom: 1\n}\na[data-v-f1904904] {\n    text-decoration: none;\n}\na[data-v-f1904904]:hover {\n    text-decoration: none;\n}\n.show[data-v-f1904904]{\n    display: block;\n}\n\n\n/*与头部有关的全局性样式*/\n.header[data-v-f1904904] {\n    position: absolute;\n    color: #fff;\n    min-width: 1240px;\n    width: 100%;\n}\n.header a[data-v-f1904904] {\n    color: #fff;\n    text-align: center;\n}\n\n/*与头部有关的全局性样式结束*/\n\n/*skin_blue相关的全局性样式*/\n.skin_blue .header[data-v-f1904904] {\n    background: #3682d0;\n}\n\n\n/*skin_blue相关的全局性样式结束*/\n\n/*全局样式结束 将顶部固定在了左上角*/\n\n/*skin_blue 样式 header_bottom*/\n.skin_blue .sub[data-v-f1904904] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc;\n}\n.skin_blue .sub a[data-v-f1904904] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-f1904904],\n.skin_blue .sub a[data-v-f1904904]:hover {\n    color: #f98d5c;\n}\n\n\n/*skin_blue 样式 header_bottom 结束*/\n\n\n\n/*header_bottom相关样式*/\n.header .sub[data-v-f1904904] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px;\n}\n.header .sub a[data-v-f1904904] {\n    padding: 0 .5em;\n}\n.header .sub .selected[data-v-f1904904],\n.header .sub a[data-v-f1904904]:hover {\n    font-weight: 700;\n}\n\n\n/*header_bottom相关样式结束*/\n", ""]);

// exports


/***/ }),

/***/ 848:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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

// import { mapGetters } from 'vuex'
/* harmony default export */ __webpack_exports__["default"] = ({
    name: "header-bottom-mspk10",
    // computed: mapGetters({
    // headerBottom: 'getHeaderBottom',
    // }),
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 849:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/msft/lmp", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("两面盘")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/msft/sol", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("单号1~10")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/msft/com", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("冠亚组合")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-f1904904", module.exports)
  }
}

/***/ }),

/***/ 850:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(851)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(853)
/* template */
var __vue_template__ = __webpack_require__(854)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-e4e7b172"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Msccs.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-e4e7b172", Component.options)
  } else {
    hotAPI.reload("data-v-e4e7b172", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 851:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(852);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("597c3517", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e4e7b172\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Msccs.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e4e7b172\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Msccs.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 852:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-e4e7b172] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-e4e7b172] {\n    position: relative\n}\na[data-v-e4e7b172] {\n    text-decoration: none\n}\na[data-v-e4e7b172]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-e4e7b172] {\n    display: none\n}\n.header .more-game-drop[data-v-e4e7b172] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-e4e7b172] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-e4e7b172] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-e4e7b172] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-e4e7b172] {\n    display: block\n}\n.header .sub[data-v-e4e7b172] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-e4e7b172] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-e4e7b172],\n.header .sub a[data-v-e4e7b172]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-e4e7b172] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-e4e7b172] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-e4e7b172] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-e4e7b172] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-e4e7b172],\n.skin_blue .sub a[data-v-e4e7b172]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-e4e7b172]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-e4e7b172],\n.skin_blue #skinPanel:hover ul[data-v-e4e7b172],\n.skin_blue .skinHover[data-v-e4e7b172] {\n    background: #234b95\n}\n.skin_blue .header[data-v-e4e7b172] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-e4e7b172] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 853:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 854:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/msssc/comb", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("整合")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/msssc/sol1", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("第一球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/msssc/sol2", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("第二球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 3 },
            attrs: { to: "/msssc/sol3", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(3)
              }
            }
          },
          [_vm._v("第三球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 4 },
            attrs: { to: "/msssc/sol4", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(4)
              }
            }
          },
          [_vm._v("第四球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 5 },
            attrs: { to: "/msssc/sol5", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(5)
              }
            }
          },
          [_vm._v("第五球")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-e4e7b172", module.exports)
  }
}

/***/ }),

/***/ 855:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(856)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(858)
/* template */
var __vue_template__ = __webpack_require__(859)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-5bed3d6f"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Cqssc.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5bed3d6f", Component.options)
  } else {
    hotAPI.reload("data-v-5bed3d6f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 856:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(857);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("39213eb9", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5bed3d6f\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Cqssc.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5bed3d6f\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Cqssc.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 857:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-5bed3d6f] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-5bed3d6f] {\n    position: relative\n}\na[data-v-5bed3d6f] {\n    text-decoration: none\n}\na[data-v-5bed3d6f]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-5bed3d6f] {\n    display: none\n}\n.header .more-game-drop[data-v-5bed3d6f] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-5bed3d6f] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-5bed3d6f] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-5bed3d6f] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-5bed3d6f] {\n    display: block\n}\n.header .sub[data-v-5bed3d6f] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-5bed3d6f] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-5bed3d6f],\n.header .sub a[data-v-5bed3d6f]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-5bed3d6f] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-5bed3d6f] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-5bed3d6f] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-5bed3d6f] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-5bed3d6f],\n.skin_blue .sub a[data-v-5bed3d6f]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-5bed3d6f]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-5bed3d6f],\n.skin_blue #skinPanel:hover ul[data-v-5bed3d6f],\n.skin_blue .skinHover[data-v-5bed3d6f] {\n    background: #234b95\n}\n.skin_blue .header[data-v-5bed3d6f] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-5bed3d6f] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 858:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 859:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/cqssc/comb", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("整合")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/cqssc/sol1", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("第一球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/cqssc/sol2", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("第二球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 3 },
            attrs: { to: "/cqssc/sol3", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(3)
              }
            }
          },
          [_vm._v("第三球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 4 },
            attrs: { to: "/cqssc/sol4", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(4)
              }
            }
          },
          [_vm._v("第四球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 5 },
            attrs: { to: "/cqssc/sol5", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(5)
              }
            }
          },
          [_vm._v("第五球")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-5bed3d6f", module.exports)
  }
}

/***/ }),

/***/ 860:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(861)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(863)
/* template */
var __vue_template__ = __webpack_require__(864)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-ff0d32d2"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Xydd.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-ff0d32d2", Component.options)
  } else {
    hotAPI.reload("data-v-ff0d32d2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 861:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(862);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("67953b23", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-ff0d32d2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xydd.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-ff0d32d2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xydd.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 862:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-ff0d32d2] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-ff0d32d2] {\n    position: relative\n}\na[data-v-ff0d32d2] {\n    text-decoration: none\n}\na[data-v-ff0d32d2]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-ff0d32d2] {\n    display: none\n}\n.header .more-game-drop[data-v-ff0d32d2] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-ff0d32d2] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-ff0d32d2] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-ff0d32d2] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-ff0d32d2] {\n    display: block\n}\n.header .sub[data-v-ff0d32d2] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-ff0d32d2] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-ff0d32d2],\n.header .sub a[data-v-ff0d32d2]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-ff0d32d2] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-ff0d32d2] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-ff0d32d2] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-ff0d32d2] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-ff0d32d2],\n.skin_blue .sub a[data-v-ff0d32d2]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-ff0d32d2]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-ff0d32d2],\n.skin_blue #skinPanel:hover ul[data-v-ff0d32d2],\n.skin_blue .skinHover[data-v-ff0d32d2] {\n    background: #234b95\n}\n.skin_blue .header[data-v-ff0d32d2] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-ff0d32d2] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 863:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 864:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            staticClass: "router-link-exact-active selected",
            attrs: { to: "/xydd/xydd" }
          },
          [_vm._v("幸运蛋蛋")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-ff0d32d2", module.exports)
  }
}

/***/ }),

/***/ 865:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(866)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(868)
/* template */
var __vue_template__ = __webpack_require__(869)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-1ca4ab9c"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Xglhc.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1ca4ab9c", Component.options)
  } else {
    hotAPI.reload("data-v-1ca4ab9c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 866:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(867);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("7e5d3f48", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1ca4ab9c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xglhc.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-1ca4ab9c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xglhc.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 867:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-1ca4ab9c] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-1ca4ab9c] {\n    position: relative\n}\na[data-v-1ca4ab9c] {\n    text-decoration: none\n}\na[data-v-1ca4ab9c]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-1ca4ab9c] {\n    display: none\n}\n.header .more-game-drop[data-v-1ca4ab9c] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-1ca4ab9c] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-1ca4ab9c] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-1ca4ab9c] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-1ca4ab9c] {\n    display: block\n}\n.header .sub[data-v-1ca4ab9c] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-1ca4ab9c] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-1ca4ab9c],\n.header .sub a[data-v-1ca4ab9c]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-1ca4ab9c] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-1ca4ab9c] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-1ca4ab9c] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-1ca4ab9c] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-1ca4ab9c],\n.skin_blue .sub a[data-v-1ca4ab9c]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-1ca4ab9c]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-1ca4ab9c],\n.skin_blue #skinPanel:hover ul[data-v-1ca4ab9c],\n.skin_blue .skinHover[data-v-1ca4ab9c] {\n    background: #234b95\n}\n.skin_blue .header[data-v-1ca4ab9c] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-1ca4ab9c] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 868:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 869:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/lhc/tema", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("特码")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/lhc/lmp", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("两面")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/lhc/sb", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("色波")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 3 },
            attrs: { to: "/lhc/tx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(3)
              }
            }
          },
          [_vm._v("特肖")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 4 },
            attrs: { to: "/lhc/hx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(4)
              }
            }
          },
          [_vm._v("合肖")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 5 },
            attrs: { to: "/lhc/tws", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(5)
              }
            }
          },
          [_vm._v("特码头尾数")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 6 },
            attrs: { to: "/lhc/zm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(6)
              }
            }
          },
          [_vm._v("正码")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 7 },
            attrs: { to: "/lhc/zmt", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(7)
              }
            }
          },
          [_vm._v("正码特")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 8 },
            attrs: { to: "/lhc/zm16", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(8)
              }
            }
          },
          [_vm._v("正码1~6")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 9 },
            attrs: { to: "/lhc/wx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(9)
              }
            }
          },
          [_vm._v("五行")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 10 },
            attrs: { to: "/lhc/ptyxws", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(10)
              }
            }
          },
          [_vm._v("平特一肖尾数")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 11 },
            attrs: { to: "/lhc/zx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(11)
              }
            }
          },
          [_vm._v("正肖")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 12 },
            attrs: { to: "/lhc/7sb", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(12)
              }
            }
          },
          [_vm._v("7色波")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 13 },
            attrs: { to: "/lhc/zongxiao", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(13)
              }
            }
          },
          [_vm._v("总肖")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 14 },
            attrs: { to: "/lhc/zxbz", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(14)
              }
            }
          },
          [_vm._v("自选不中")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 15 },
            attrs: { to: "/lhc/lxlw", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(15)
              }
            }
          },
          [_vm._v("连肖连尾")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 16 },
            attrs: { to: "/lhc/lm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(16)
              }
            }
          },
          [_vm._v("连码")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-1ca4ab9c", module.exports)
  }
}

/***/ }),

/***/ 870:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(871)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(873)
/* template */
var __vue_template__ = __webpack_require__(874)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-7c152c3a"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Cqxync.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7c152c3a", Component.options)
  } else {
    hotAPI.reload("data-v-7c152c3a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 871:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(872);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("4a621d37", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7c152c3a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Cqxync.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7c152c3a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Cqxync.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 872:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-7c152c3a] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-7c152c3a] {\n    position: relative\n}\na[data-v-7c152c3a] {\n    text-decoration: none\n}\na[data-v-7c152c3a]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-7c152c3a] {\n    display: none\n}\n.header .more-game-drop[data-v-7c152c3a] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-7c152c3a] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-7c152c3a] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-7c152c3a] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-7c152c3a] {\n    display: block\n}\n.header .sub[data-v-7c152c3a] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-7c152c3a] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-7c152c3a],\n.header .sub a[data-v-7c152c3a]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-7c152c3a] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-7c152c3a] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-7c152c3a] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-7c152c3a] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-7c152c3a],\n.skin_blue .sub a[data-v-7c152c3a]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-7c152c3a]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-7c152c3a],\n.skin_blue #skinPanel:hover ul[data-v-7c152c3a],\n.skin_blue .skinHover[data-v-7c152c3a] {\n    background: #234b95\n}\n.skin_blue .header[data-v-7c152c3a] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-7c152c3a] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 873:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 874:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/cqxync/lmp", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("cq两面盘")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/cqxync/sol", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("单号1~8")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/cqxync/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("第一球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 3 },
            attrs: { to: "/cqxync/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(3)
              }
            }
          },
          [_vm._v("第二球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 4 },
            attrs: { to: "/cqxync/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(4)
              }
            }
          },
          [_vm._v("第三球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 5 },
            attrs: { to: "/cqxync/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(5)
              }
            }
          },
          [_vm._v("第四球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 6 },
            attrs: { to: "/cqxync/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(6)
              }
            }
          },
          [_vm._v("第五球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 7 },
            attrs: { to: "/cqxync/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(7)
              }
            }
          },
          [_vm._v("第六球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 8 },
            attrs: { to: "/cqxync/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(8)
              }
            }
          },
          [_vm._v("第七球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 9 },
            attrs: { to: "/cqxync/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(9)
              }
            }
          },
          [_vm._v("第八球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 10 },
            attrs: { to: "/cqxync/zm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(10)
              }
            }
          },
          [_vm._v("正码")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 11 },
            attrs: { to: "/cqxync/lm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(11)
              }
            }
          },
          [_vm._v("连码")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7c152c3a", module.exports)
  }
}

/***/ }),

/***/ 875:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(876)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(878)
/* template */
var __vue_template__ = __webpack_require__(879)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3f82d1e0"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Xylhc.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3f82d1e0", Component.options)
  } else {
    hotAPI.reload("data-v-3f82d1e0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 876:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(877);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("219a4071", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3f82d1e0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xylhc.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3f82d1e0\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xylhc.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 877:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-3f82d1e0] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-3f82d1e0] {\n    position: relative\n}\na[data-v-3f82d1e0] {\n    text-decoration: none\n}\na[data-v-3f82d1e0]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-3f82d1e0] {\n    display: none\n}\n.header .more-game-drop[data-v-3f82d1e0] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-3f82d1e0] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-3f82d1e0] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-3f82d1e0] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-3f82d1e0] {\n    display: block\n}\n.header .sub[data-v-3f82d1e0] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-3f82d1e0] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-3f82d1e0],\n.header .sub a[data-v-3f82d1e0]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-3f82d1e0] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-3f82d1e0] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-3f82d1e0] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-3f82d1e0] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-3f82d1e0],\n.skin_blue .sub a[data-v-3f82d1e0]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-3f82d1e0]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-3f82d1e0],\n.skin_blue #skinPanel:hover ul[data-v-3f82d1e0],\n.skin_blue .skinHover[data-v-3f82d1e0] {\n    background: #234b95\n}\n.skin_blue .header[data-v-3f82d1e0] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-3f82d1e0] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 878:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 879:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/lhc/tema", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("特码")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/lhc/lmp", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("两面")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/lhc/sb", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("色波")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 3 },
            attrs: { to: "/lhc/tx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(3)
              }
            }
          },
          [_vm._v("特肖")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 4 },
            attrs: { to: "/lhc/hx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(4)
              }
            }
          },
          [_vm._v("合肖")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 5 },
            attrs: { to: "/lhc/tws", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(5)
              }
            }
          },
          [_vm._v("特码头尾数")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 6 },
            attrs: { to: "/lhc/zm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(6)
              }
            }
          },
          [_vm._v("正码")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 7 },
            attrs: { to: "/lhc/zmt", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(7)
              }
            }
          },
          [_vm._v("正码特")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 8 },
            attrs: { to: "/lhc/zm16", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(8)
              }
            }
          },
          [_vm._v("正码1~6")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 9 },
            attrs: { to: "/lhc/wx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(9)
              }
            }
          },
          [_vm._v("五行")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 10 },
            attrs: { to: "/lhc/ptyxws", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(10)
              }
            }
          },
          [_vm._v("平特一肖尾数")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 11 },
            attrs: { to: "/lhc/zx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(11)
              }
            }
          },
          [_vm._v("正肖")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 12 },
            attrs: { to: "/lhc/7sb", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(12)
              }
            }
          },
          [_vm._v("7色波")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 13 },
            attrs: { to: "/lhc/zongxiao", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(13)
              }
            }
          },
          [_vm._v("总肖")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 14 },
            attrs: { to: "/lhc/zxbz", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(14)
              }
            }
          },
          [_vm._v("自选不中")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 15 },
            attrs: { to: "/lhc/lxlw", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(15)
              }
            }
          },
          [_vm._v("连肖连尾")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 16 },
            attrs: { to: "/lhc/lm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(16)
              }
            }
          },
          [_vm._v("连码")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3f82d1e0", module.exports)
  }
}

/***/ }),

/***/ 880:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(881)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(883)
/* template */
var __vue_template__ = __webpack_require__(884)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-0f120670"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Xykl8.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-0f120670", Component.options)
  } else {
    hotAPI.reload("data-v-0f120670", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 881:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(882);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("9609423c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0f120670\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xykl8.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-0f120670\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xykl8.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 882:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-0f120670] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-0f120670] {\n    position: relative\n}\na[data-v-0f120670] {\n    text-decoration: none\n}\na[data-v-0f120670]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-0f120670] {\n    display: none\n}\n.header .more-game-drop[data-v-0f120670] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-0f120670] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-0f120670] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-0f120670] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-0f120670] {\n    display: block\n}\n.header .sub[data-v-0f120670] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-0f120670] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-0f120670],\n.header .sub a[data-v-0f120670]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-0f120670] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-0f120670] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-0f120670] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-0f120670] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-0f120670],\n.skin_blue .sub a[data-v-0f120670]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-0f120670]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-0f120670],\n.skin_blue #skinPanel:hover ul[data-v-0f120670],\n.skin_blue .skinHover[data-v-0f120670] {\n    background: #234b95\n}\n.skin_blue .header[data-v-0f120670] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-0f120670] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 883:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 884:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/xykl8/lmp", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("两面盘")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/xykl8/zhbswx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("总和、比数、五行")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/xykl8/zm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("正码")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-0f120670", module.exports)
  }
}

/***/ }),

/***/ 885:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(886)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(888)
/* template */
var __vue_template__ = __webpack_require__(889)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-94b22fee"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Pcdd.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-94b22fee", Component.options)
  } else {
    hotAPI.reload("data-v-94b22fee", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 886:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(887);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("387a3db6", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-94b22fee\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Pcdd.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-94b22fee\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Pcdd.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 887:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-94b22fee] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-94b22fee] {\n    position: relative\n}\na[data-v-94b22fee] {\n    text-decoration: none\n}\na[data-v-94b22fee]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-94b22fee] {\n    display: none\n}\n.header .more-game-drop[data-v-94b22fee] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-94b22fee] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-94b22fee] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-94b22fee] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-94b22fee] {\n    display: block\n}\n.header .sub[data-v-94b22fee] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-94b22fee] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-94b22fee],\n.header .sub a[data-v-94b22fee]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-94b22fee] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-94b22fee] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-94b22fee] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-94b22fee] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-94b22fee],\n.skin_blue .sub a[data-v-94b22fee]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-94b22fee]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-94b22fee],\n.skin_blue #skinPanel:hover ul[data-v-94b22fee],\n.skin_blue .skinHover[data-v-94b22fee] {\n    background: #234b95\n}\n.skin_blue .header[data-v-94b22fee] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-94b22fee] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 888:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 889:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            staticClass: "router-link-exact-active selected",
            attrs: { to: "/pcdd/pcdd" }
          },
          [_vm._v("PC蛋蛋")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-94b22fee", module.exports)
  }
}

/***/ }),

/***/ 890:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(891)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(893)
/* template */
var __vue_template__ = __webpack_require__(894)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-24156e90"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Gd11x5.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-24156e90", Component.options)
  } else {
    hotAPI.reload("data-v-24156e90", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 891:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(892);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("711a3540", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-24156e90\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Gd11x5.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-24156e90\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Gd11x5.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 892:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-24156e90] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-24156e90] {\n    position: relative\n}\na[data-v-24156e90] {\n    text-decoration: none\n}\na[data-v-24156e90]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-24156e90] {\n    display: none\n}\n.header .more-game-drop[data-v-24156e90] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-24156e90] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-24156e90] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-24156e90] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-24156e90] {\n    display: block\n}\n.header .sub[data-v-24156e90] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-24156e90] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-24156e90],\n.header .sub a[data-v-24156e90]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-24156e90] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-24156e90] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-24156e90] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-24156e90] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-24156e90],\n.skin_blue .sub a[data-v-24156e90]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-24156e90]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-24156e90],\n.skin_blue #skinPanel:hover ul[data-v-24156e90],\n.skin_blue .skinHover[data-v-24156e90] {\n    background: #234b95\n}\n.skin_blue .header[data-v-24156e90] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-24156e90] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 893:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 894:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/gd11x5/lmp", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("两面")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/gd11x5/sol", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("单号")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/gd11x5/lm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("连码")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 3 },
            attrs: { to: "/gd11x5/zx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(3)
              }
            }
          },
          [_vm._v("直选")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-24156e90", module.exports)
  }
}

/***/ }),

/***/ 895:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(896)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(898)
/* template */
var __vue_template__ = __webpack_require__(899)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-a37fdda4"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Jssb.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a37fdda4", Component.options)
  } else {
    hotAPI.reload("data-v-a37fdda4", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 896:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(897);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("4c871538", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a37fdda4\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Jssb.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a37fdda4\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Jssb.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 897:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-a37fdda4] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-a37fdda4] {\n    position: relative\n}\na[data-v-a37fdda4] {\n    text-decoration: none\n}\na[data-v-a37fdda4]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-a37fdda4] {\n    display: none\n}\n.header .more-game-drop[data-v-a37fdda4] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-a37fdda4] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-a37fdda4] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-a37fdda4] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-a37fdda4] {\n    display: block\n}\n.header .sub[data-v-a37fdda4] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-a37fdda4] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-a37fdda4],\n.header .sub a[data-v-a37fdda4]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-a37fdda4] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-a37fdda4] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-a37fdda4] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-a37fdda4] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-a37fdda4],\n.skin_blue .sub a[data-v-a37fdda4]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-a37fdda4]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-a37fdda4],\n.skin_blue #skinPanel:hover ul[data-v-a37fdda4],\n.skin_blue .skinHover[data-v-a37fdda4] {\n    background: #234b95\n}\n.skin_blue .header[data-v-a37fdda4] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-a37fdda4] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 898:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 899:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            staticClass: "router-link-exact-active selected",
            attrs: { to: "/jsk3/dxtb" }
          },
          [_vm._v("大小骰宝")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-a37fdda4", module.exports)
  }
}

/***/ }),

/***/ 900:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(901)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(903)
/* template */
var __vue_template__ = __webpack_require__(904)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3afedb49"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Bjkl8.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3afedb49", Component.options)
  } else {
    hotAPI.reload("data-v-3afedb49", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 901:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(902);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("599c2c5c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3afedb49\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Bjkl8.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3afedb49\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Bjkl8.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 902:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-3afedb49] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-3afedb49] {\n    position: relative\n}\na[data-v-3afedb49] {\n    text-decoration: none\n}\na[data-v-3afedb49]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-3afedb49] {\n    display: none\n}\n.header .more-game-drop[data-v-3afedb49] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-3afedb49] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-3afedb49] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-3afedb49] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-3afedb49] {\n    display: block\n}\n.header .sub[data-v-3afedb49] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-3afedb49] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-3afedb49],\n.header .sub a[data-v-3afedb49]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-3afedb49] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-3afedb49] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-3afedb49] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-3afedb49] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-3afedb49],\n.skin_blue .sub a[data-v-3afedb49]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-3afedb49]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-3afedb49],\n.skin_blue #skinPanel:hover ul[data-v-3afedb49],\n.skin_blue .skinHover[data-v-3afedb49] {\n    background: #234b95\n}\n.skin_blue .header[data-v-3afedb49] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-3afedb49] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 903:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 904:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/bjkl8/zhbswx", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("总和、比数、五行")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/bjkl8/zm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("正码")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3afedb49", module.exports)
  }
}

/***/ }),

/***/ 905:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(906)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(908)
/* template */
var __vue_template__ = __webpack_require__(909)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-4f58f4b2"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Gdklsf.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4f58f4b2", Component.options)
  } else {
    hotAPI.reload("data-v-4f58f4b2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 906:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(907);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("63e21415", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4f58f4b2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Gdklsf.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4f58f4b2\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Gdklsf.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 907:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-4f58f4b2] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-4f58f4b2] {\n    position: relative\n}\na[data-v-4f58f4b2] {\n    text-decoration: none\n}\na[data-v-4f58f4b2]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-4f58f4b2] {\n    display: none\n}\n.header .more-game-drop[data-v-4f58f4b2] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-4f58f4b2] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-4f58f4b2] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-4f58f4b2] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-4f58f4b2] {\n    display: block\n}\n.header .sub[data-v-4f58f4b2] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-4f58f4b2] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-4f58f4b2],\n.header .sub a[data-v-4f58f4b2]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-4f58f4b2] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-4f58f4b2] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-4f58f4b2] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-4f58f4b2] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-4f58f4b2],\n.skin_blue .sub a[data-v-4f58f4b2]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-4f58f4b2]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-4f58f4b2],\n.skin_blue #skinPanel:hover ul[data-v-4f58f4b2],\n.skin_blue .skinHover[data-v-4f58f4b2] {\n    background: #234b95\n}\n.skin_blue .header[data-v-4f58f4b2] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-4f58f4b2] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 908:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 909:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/gdklsf/lmp", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("两面盘")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/gdklsf/sol", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("单号1~8")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/gdklsf/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("第一球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 3 },
            attrs: { to: "/gdklsf/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(3)
              }
            }
          },
          [_vm._v("第二球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 4 },
            attrs: { to: "/gdklsf/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(4)
              }
            }
          },
          [_vm._v("第三球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 5 },
            attrs: { to: "/gdklsf/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(5)
              }
            }
          },
          [_vm._v("第四球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 6 },
            attrs: { to: "/gdklsf/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(6)
              }
            }
          },
          [_vm._v("第五球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 7 },
            attrs: { to: "/gdklsf/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(7)
              }
            }
          },
          [_vm._v("第六球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 8 },
            attrs: { to: "/gdklsf/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(8)
              }
            }
          },
          [_vm._v("第七球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 9 },
            attrs: { to: "/gdklsf/qiu", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(9)
              }
            }
          },
          [_vm._v("第八球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 10 },
            attrs: { to: "/gdklsf/zm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(10)
              }
            }
          },
          [_vm._v("正码")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 11 },
            attrs: { to: "/gdklsf/lm", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(11)
              }
            }
          },
          [_vm._v("连码")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4f58f4b2", module.exports)
  }
}

/***/ }),

/***/ 910:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(911)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(913)
/* template */
var __vue_template__ = __webpack_require__(914)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-a33bc32a"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/header/headerBottom/headerBottom_Xjssc.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-a33bc32a", Component.options)
  } else {
    hotAPI.reload("data-v-a33bc32a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 911:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(912);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("7d6eb328", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a33bc32a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xjssc.vue", function() {
     var newContent = require("!!../../../../../../../../node_modules/css-loader/index.js!../../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-a33bc32a\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./headerBottom_Xjssc.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 912:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\nbody[data-v-a33bc32a] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.wrap[data-v-a33bc32a] {\n    position: relative\n}\na[data-v-a33bc32a] {\n    text-decoration: none\n}\na[data-v-a33bc32a]:hover {\n    text-decoration: none\n}\n.trial-cls[data-v-a33bc32a] {\n    display: none\n}\n.header .more-game-drop[data-v-a33bc32a] {\n    position: absolute;\n    right: -1px;\n    top: 38px;\n    width: 480px;\n    height: auto;\n    padding: 0 15px 8px 15px;\n    overflow: hidden;\n    text-align: left;\n    font-weight: 400;\n    color: #333\n}\n.header .more-game-drop .actions[data-v-a33bc32a] {\n    position: absolute;\n    right: 17px;\n    bottom: 6px\n}\n.header .more-game-drop .actionBtn[data-v-a33bc32a] {\n    display: inline-block;\n    border-radius: 4px;\n    color: #fff;\n    padding: 10px 18px;\n    line-height: 1em;\n    font-weight: 400\n}\n.header .more-game-drop .actionBtn.action-cancel[data-v-a33bc32a] {\n    background: #bbb;\n    display: none\n}\n.header .lotterys.menu-editMode .editbtn[data-v-a33bc32a] {\n    display: block\n}\n.header .sub[data-v-a33bc32a] {\n    height: 31px;\n    overflow: hidden;\n    line-height: 32px;\n    padding-left: 200px\n}\n.header .sub a[data-v-a33bc32a] {\n    padding: 0 .5em\n}\n.header .sub .selected[data-v-a33bc32a],\n.header .sub a[data-v-a33bc32a]:hover {\n    font-weight: 700\n}\n.header .icon-new[data-v-a33bc32a] {\n    position: relative;\n    right: -19px;\n    top: -63px\n}\n.skin_red .notice-wrap .bg[data-v-a33bc32a] {\n    background: #1e5799;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(30, 87, 153, 1)), color-stop(0, rgba(252, 92, 68, 1)), to(rgba(252, 49, 104, 1)));\n    background: linear-gradient(to bottom, rgba(30, 87, 153, 1) 0, rgba(252, 92, 68, 1) 0, rgba(252, 49, 104, 1) 100%)\n}\n.skin_blue .sub[data-v-a33bc32a] {\n    color: #666;\n    background: #e6e6e6;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(230, 230, 230, 1)), to(rgba(231, 231, 231, 1)));\n    background: linear-gradient(to bottom, rgba(230, 230, 230, 1) 0, rgba(231, 231, 231, 1) 100%);\n    border-bottom: 1px solid #ccc\n}\n.skin_blue .sub a[data-v-a33bc32a] {\n    color: #666\n}\n.skin_blue .sub .selected[data-v-a33bc32a],\n.skin_blue .sub a[data-v-a33bc32a]:hover {\n    color: #f98d5c\n}\n.skin_blue .lotterys.menu-editMode .show > a[data-v-a33bc32a]:hover {\n    background: 0 0;\n    color: #fff\n}\n.skin_blue #skinPanel:hover .skin_blue .skinHover ul[data-v-a33bc32a],\n.skin_blue #skinPanel:hover ul[data-v-a33bc32a],\n.skin_blue .skinHover[data-v-a33bc32a] {\n    background: #234b95\n}\n.skin_blue .header[data-v-a33bc32a] {\n    background: #3682d0\n}\n.skin_blue .header .lotterys[data-v-a33bc32a] {\n    background: #2161b3\n}\n\n", ""]);

// exports


/***/ }),

/***/ 913:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
    name: "header-bottom",
    data: function data() {
        return {
            // game: [
            //     { 'name': 'ms两面盘' },
            //     { 'name': '单号1~10' },
            //     { 'name': '冠亚组合' }
            // ],
            changeSelect: 0
        };
    },

    methods: {
        changeSelected: function changeSelected(k) {
            this.$store.dispatch('contSiderShowTrue');
            // alert(k);
            this.changeSelect = k;
        }
    }
});

/***/ }),

/***/ 914:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "header-bottom sub" }, [
    _c(
      "div",
      { staticClass: "show cate_menu" },
      [
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 0 },
            attrs: { to: "/xjssc/comb", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(0)
              }
            }
          },
          [_vm._v("整合")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 1 },
            attrs: { to: "/xjssc/sol1", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(1)
              }
            }
          },
          [_vm._v("第一球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 2 },
            attrs: { to: "/xjssc/sol2", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(2)
              }
            }
          },
          [_vm._v("第二球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 3 },
            attrs: { to: "/xjssc/sol3", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(3)
              }
            }
          },
          [_vm._v("第三球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 4 },
            attrs: { to: "/xjssc/sol4", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(4)
              }
            }
          },
          [_vm._v("第四球")]
        ),
        _vm._v(" |\n        "),
        _c(
          "router-link",
          {
            class: { selected: _vm.changeSelect === 5 },
            attrs: { to: "/xjssc/sol5", exact: "" },
            nativeOn: {
              click: function($event) {
                _vm.changeSelected(5)
              }
            }
          },
          [_vm._v("第五球")]
        )
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-a33bc32a", module.exports)
  }
}

/***/ }),

/***/ 915:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(916)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(918)
/* template */
var __vue_template__ = __webpack_require__(919)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-2e575349"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/user/parts/mainWrap/contSider.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2e575349", Component.options)
  } else {
    hotAPI.reload("data-v-2e575349", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 916:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(917);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("30192eb0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2e575349\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./contSider.vue", function() {
     var newContent = require("!!../../../../../../../node_modules/css-loader/index.js!../../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2e575349\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./contSider.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 917:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/*全局样式*/\nbody[data-v-2e575349] {\n    font: 12px/1.5 '\\5FAE\\8F6F\\96C5\\9ED1', '\\5B8B\\4F53', Arial, Helvetica, sans-serif;\n    overflow-y: hidden\n}\n.main-body[data-v-2e575349] {\n    position: absolute;\n    overflow-x: auto;\n    top: 0;\n    left: 0;\n    right: 0;\n    bottom: 30px;\n}\n.clearfix[data-v-2e575349]:after {\n    content: \"\";\n    height: 0;\n    visibility: hidden;\n    display: block;\n    clear: both;\n}\n.clearfix[data-v-2e575349] {\n    zoom: 1\n}\na[data-v-2e575349] {\n    text-decoration: none;\n}\na[data-v-2e575349]:hover {\n    text-decoration: none;\n}\n.show[data-v-2e575349]{\n    display: block;\n}\ntable[data-v-2e575349] {\n    border-collapse: collapse;\n    border-spacing: 0\n}\n\n/*与cont-sider有关的全局性样式*/\n\n\n\n/*与cont-sider有关的全局性样式结束*/\n\n/*skin_blue相关的全局性样式*/\n.skin_blue .u-table2 .hover[data-v-2e575349] {\n    background: none repeat 0 0 #c3d9f1;\n}\n.skin_blue .u-table5 td[data-v-2e575349],\n.skin_blue .u-table5 th[data-v-2e575349] {\n    border: solid 1px #b9c2cb;\n}\n.skin_blue .u-tb5-tr1[data-v-2e575349] {\n    background: #fff;\n}\n.skin_blue .nowrap2[data-v-2e575349] {\n    border: solid 1px #f4521b;\n    background: #ff9461;\n    background: -webkit-gradient(linear, left top, left bottom, color-stop(0, rgba(255, 148, 97, 1)), to(rgba(255, 104, 53, 1)));\n    background: linear-gradient(to bottom, rgba(255, 148, 97, 1) 0, rgba(255, 104, 53, 1) 100%)\n}\n.skin_blue .u-table2 th[data-v-2e575349] {\n    color: #4F4D4D;\n    border: solid 1px #b9c2cb;\n    background-color: #edf4fe;\n}\n.skin_blue .cont-sider thead th[data-v-2e575349] {\n    background: #2161b3;\n    color: #fff;\n}\n\n\n/*skin_blue相关的全局性样式结束*/\n\n/*全局样式结束 将顶部固定在了左上角*/\n\n/*skin_blue 样式 sidebar*/\n.skin_blue .cont-sider thead th[data-v-2e575349] {\n    background: #2161b3;\n    color: #fff;\n}\n\n\n/*skin_blue 样式 siderbar 结束*/\n\n/*与中间有关的样式*/\n\n\n/*与中间有关的样式结束*/\n\n/*与中间右边有关的样式*/\n.content-wrap[data-v-2e575349] {\n    min-width: 1038px;\n    overflow: hidden;\n    font-size: 12px;\n    position: absolute;\n    top: 0;\n    right: 0;\n    height: 100%;\n    overflow-y: auto;\n    left: 201px;\n}\n\n\n\n/*与中间右边有关的样式结束*/\n\n\n/*cont_sider 相关样式*/\n.cont-sider[data-v-2e575349] {\n    float: left;\n    width: 180px;\n}\n.cont-sider .u-table2 thead th[data-v-2e575349] {\n    height: 30px;\n    border-top-left-radius: 3px;\n    border-top-right-radius: 3px;\n    border: none;\n    font-size: 13px;\n    letter-spacing: 1px;\n}\n\n\n/*cont_sider 相关样式结束*/\n\n/*与table有关的全局样式*/\n.u-table2[data-v-2e575349] {\n    width: 100%;\n    text-align: center;\n}\n.u-table2 th[data-v-2e575349] {\n    font-weight: 700;\n    height: 23px;\n}\n.u-table2 thead th.select[data-v-2e575349] {\n    background-position: 0 -59px;\n}\n.u-table2 td[data-v-2e575349] {\n    height: 28px;\n    background: #fff;\n    cursor: pointer;\n}\n.u-table2 .name[data-v-2e575349] {\n    width: 60px;\n    min-width: 40px;\n    font-weight: 700;\n}\n.u-table2.sevenrow .name[data-v-2e575349]{\n    width: auto;\n    min-width: auto;\n}\n.u-table2 .amount[data-v-2e575349] {\n    width: 65px;\n}\n.u-table2.sevenrow .amount[data-v-2e575349] {\n    width: 60px;\n}\n.u-table2 .odds[data-v-2e575349] {\n    width: 50px;\n    font-weight: 700;\n}\n.u-table5[data-v-2e575349] {\n    width: 100%;\n}\n.u-table5 .statFont[data-v-2e575349] {\n    color: red;\n}\n.u-table5 td[data-v-2e575349],\n.u-table5 th[data-v-2e575349] {\n    height: 23px;\n    padding: 0 5px;\n    text-align: left;\n    font-size: 12px;\n    border: solid 1px #daa4a3;\n    font-weight: 400;\n    color: #4f4d4d;\n}\n.mt5[data-v-2e575349] {\n    margin-top: 4px;\n}\n\n/*与table有关的全局样式*/\n", ""]);

// exports


/***/ }),

/***/ 918:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    name: "cont-sider"
});

/***/ }),

/***/ 919:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "cont-sider" }, [
      _c("div", { staticClass: "sider-box1 mt5" }, [
        _c("table", { staticClass: "u-table2" }, [
          _c("thead", [
            _c("tr", [
              _c("th", { attrs: { id: "stat_play_list_desc" } }, [
                _vm._v("长龙排行榜")
              ])
            ])
          ])
        ]),
        _vm._v(" "),
        _c("table", { staticClass: "u-table5" }, [
          _c("tbody", { attrs: { id: "stat_play_list" } }, [
            _c("tr", { staticClass: "u-tb5-tr1" }, [
              _c("th", [_vm._v("冠、亚军和 - 冠亚小")]),
              _vm._v(" "),
              _c("td", { staticClass: "statFont" }, [_vm._v("5期")])
            ]),
            _vm._v(" "),
            _c("tr", { staticClass: "u-tb5-tr2" }, [
              _c("th", [_vm._v("亚军 - 小")]),
              _vm._v(" "),
              _c("td", { staticClass: "statFont" }, [_vm._v("5期")])
            ]),
            _vm._v(" "),
            _c("tr", { staticClass: "u-tb5-tr1" }, [
              _c("th", [_vm._v("第五名 - 双")]),
              _vm._v(" "),
              _c("td", { staticClass: "statFont" }, [_vm._v("4期")])
            ]),
            _vm._v(" "),
            _c("tr", { staticClass: "u-tb5-tr2" }, [
              _c("th", [_vm._v("冠军 - 虎")]),
              _vm._v(" "),
              _c("td", { staticClass: "statFont" }, [_vm._v("3期")])
            ]),
            _vm._v(" "),
            _c("tr", { staticClass: "u-tb5-tr1" }, [
              _c("th", [_vm._v("第四名 - 单")]),
              _vm._v(" "),
              _c("td", { staticClass: "statFont" }, [_vm._v("3期")])
            ]),
            _vm._v(" "),
            _c("tr", { staticClass: "u-tb5-tr2" }, [
              _c("th", [_vm._v("第七名 - 单")]),
              _vm._v(" "),
              _c("td", { staticClass: "statFont" }, [_vm._v("3期")])
            ]),
            _vm._v(" "),
            _c("tr", { staticClass: "u-tb5-tr1" }, [
              _c("th", [_vm._v("第八名 - 双")]),
              _vm._v(" "),
              _c("td", { staticClass: "statFont" }, [_vm._v("3期")])
            ]),
            _vm._v(" "),
            _c("tr", { staticClass: "u-tb5-tr2" }, [
              _c("th", [_vm._v("第十名 - 大")]),
              _vm._v(" "),
              _c("td", { staticClass: "statFont" }, [_vm._v("3期")])
            ])
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-2e575349", module.exports)
  }
}

/***/ }),

/***/ 920:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(921)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(923)
/* template */
var __vue_template__ = __webpack_require__(924)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-7007d6fc"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/common/footer/footer.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7007d6fc", Component.options)
  } else {
    hotAPI.reload("data-v-7007d6fc", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 921:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(922);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("9210ae3a", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7007d6fc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./footer.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7007d6fc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./footer.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 922:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n@-webkit-keyframes identifier-data-v-7007d6fc {\n0%{\n    -webkit-transform: translateY(25px);\n            transform: translateY(25px)\n}\n20%{\n    -webkit-transform: translateY(0px);\n            transform: translateY(0px)\n}\n80%{\n    -webkit-transform: translateY(0px);\n            transform: translateY(0px)\n}\n100%{\n    -webkit-transform: translateY(-25px);\n            transform: translateY(-25px)\n}\n}\n@keyframes identifier-data-v-7007d6fc {\n0%{\n    -webkit-transform: translateY(25px);\n            transform: translateY(25px)\n}\n20%{\n    -webkit-transform: translateY(0px);\n            transform: translateY(0px)\n}\n80%{\n    -webkit-transform: translateY(0px);\n            transform: translateY(0px)\n}\n100%{\n    -webkit-transform: translateY(-25px);\n            transform: translateY(-25px)\n}\n}\n.footer[data-v-7007d6fc] {\n  width: 100%;\n  height: 30px;\n  position: fixed;\n  bottom: 0;\n}\n.skin_blue .footer h3[data-v-7007d6fc] {\n  margin: 0;\n  float: left;\n  width: 80px;\n  background: url(\"/static/game/images/footer/announce-bg.png\");\n  height: 30px;\n}\n.skin_blue .footer .foottxt_box[data-v-7007d6fc] {\n  background: url(\"/static/game/images/footer/announce-bg.png\") repeat-x 0 -30px;\n  overflow: hidden;\n}\n.footer .foottxt_box p[data-v-7007d6fc] {\n  margin: 0;\n  -webkit-animation: identifier-data-v-7007d6fc 5s linear infinite;\n          animation: identifier-data-v-7007d6fc 5s linear infinite;\n}\n.footer .foottxt_box a[data-v-7007d6fc] {\n  font-size: 14px;\n  padding-left: 10px;\n  line-height: 30px;\n  width: auto;\n  overflow: hidden;\n  white-space: nowrap;\n  text-overflow: ellipsis;\n  color: #fff;\n}\n.footer .foottxt_box a[data-v-7007d6fc]:hover {\n  color: #fee77d;\n}\n.skin_red .footer .foottxt_box[data-v-7007d6fc] {\n  background: url(\"/static/game/images/footer/redannounce-bg.png\") repeat-x 0 -30px;\n  overflow: hidden;\n}\n.skin_red .footer h3[data-v-7007d6fc] {\n  margin: 0;\n  float: left;\n  width: 80px;\n  background: url(\"/static/game/images/footer/redannounce-bg.png\");\n  height: 30px;\n}\n@-webkit-keyframes notice-data-v-7007d6fc {\n}\n@keyframes notice-data-v-7007d6fc {\n}\n  /*更多消息css*/\n/* 公用样式和模态框样式 */\n*[data-v-7007d6fc] {\n  margin: 0;\n  padding: 0;\n}\nbody[data-v-7007d6fc] {\n  font: 12px/1.5 \"\\5FAE\\8F6F\\96C5\\9ED1\", \"\\5B8B\\4F53\", Arial, Helvetica,\n  sans-serif;\n  overflow-y: hidden;\n}\n.main-body[data-v-7007d6fc] {\n  position: absolute;\n  overflow-x: auto;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 30px;\n}\na[data-v-7007d6fc] {\n  text-decoration: none;\n}\n.notice-wrap[data-v-7007d6fc] {\n  position: fixed;\n  width: 100%;\n  height: 100%;\n  z-index: 101;\n}\n.notice-wrap .bg[data-v-7007d6fc] {\n  position: absolute;\n  left: 50%;\n  top: 50%;\n  border-radius: 5px;\n  z-index: 999;\n}\n.notice-wrap .mask[data-v-7007d6fc] {\n  background: #000;\n  opacity: 0.5;\n  position: absolute;\n  top: 0;\n  left: 0;\n  width: 100%;\n  height: 100%;\n  display: block;\n}\n.notice-wrap .notice-icon[data-v-7007d6fc] {\n  display: block;\n  width: 155px;\n  height: 137px;\n  background: url(\"/static/game/images/modalbox/notice_icon.png\");\n  background-position: -161px -14px;\n  padding-bottom: 8px;\n}\n.notice-wrap .more-btn[data-v-7007d6fc],\n.notice-wrap .notice-btn[data-v-7007d6fc] {\n  display: block;\n  border-radius: 3px;\n  font-size: 14px;\n  text-align: center;\n  transition: all 0.1s;\n  -webkit-transition: all 0.1s;\n}\n.notice-wrap .more-btn[data-v-7007d6fc]:active,\n.notice-wrap .notice-btn[data-v-7007d6fc]:active {\n  border-bottom: none;\n  transform: translate(0, 3px);\n  -webkit-transform: translate(0, 3px);\n}\n.notice-wrap .notice-btn[data-v-7007d6fc] {\n  display: block;\n  color: #fff;\n  padding: 10px 6px;\n  border-bottom: 5px solid #d18922;\n  background-color: #fec436;\n}\n.notice-wrap .more-btn[data-v-7007d6fc] {\n  display: inline-block;\n  color: red;\n  padding: 0 8px;\n  border-bottom: 3px solid #ccc;\n  font-size: 12px;\n  background-color: #fff;\n}\n.notice-wrap .notice-pager[data-v-7007d6fc] {\n  text-align: center;\n  font-size: 14px;\n  color: #fff;\n}\n.notice-wrap .notice-pager a[data-v-7007d6fc] {\n  color: #fff;\n}\n.notice-wrap .notice-pager .indicator[data-v-7007d6fc] {\n  display: inline-block;\n  padding: 2px 15px;\n}\n.notice-wrap .notice-content[data-v-7007d6fc] {\n  line-height: 1.6;\n  color: #fff;\n  font-size: 13px;\n  max-height: 300px;\n  overflow-y: scroll;\n}\n.notice-wrap .notice-content[data-v-7007d6fc]::-webkit-scrollbar {\n  width: 10px;\n}\n.notice-wrap .notice-content p[data-v-7007d6fc] {\n  white-space: pre-wrap;\n  word-break: break-all;\n  text-align: left;\n}\n.notice-wrap .lay-important[data-v-7007d6fc] {\n  width: 300px;\n  min-height: 300px;\n  margin: -210px 0 0 -200px;\n}\n.notice-wrap .lay-important .lay-content[data-v-7007d6fc] {\n  padding: 10px 20px;\n  margin: 0 10px;\n  text-align: center;\n}\n.notice-wrap .lay-important .lay-notice-icon[data-v-7007d6fc] {\n  width: 155px;\n  padding-top: 20px;\n  margin: 0 auto;\n  position: relative;\n}\n.notice-wrap .lay-important .more-btn[data-v-7007d6fc] {\n  position: absolute;\n  right: -28px;\n  top: 105px;\n}\n.notice-wrap .lay-notice-btn[data-v-7007d6fc] {\n  width: 150px;\n  margin: 20px auto 0;\n  padding-bottom: 20px;\n}\n.notice-wrap .close-btn[data-v-7007d6fc] {\n  width: 14px;\n  height: 16px;\n  position: absolute;\n  right: 8px;\n  top: 0;\n  color: #fff;\n  font-weight: 700;\n  cursor: pointer;\n}\n.notice-wrap .close-btn a[data-v-7007d6fc] {\n  display: block;\n  color: #fff;\n  padding: 5px;\n}\n.skin_blue .notice-wrap .bg[data-v-7007d6fc] {\n  background: #1e5799;\n  background: -webkit-gradient(\n          linear,\n          left top, left bottom,\n          color-stop(0, rgba(30, 87, 153, 1)),\n          color-stop(0, rgba(0, 219, 255, 1)),\n          to(rgba(0, 165, 255, 1))\n  );\n  background: linear-gradient(\n          to bottom,\n          rgba(30, 87, 153, 1) 0,\n          rgba(0, 219, 255, 1) 0,\n          rgba(0, 165, 255, 1) 100%\n  );\n}\n\n/* 更多信息样式 */\n.notice-wrap li[data-v-7007d6fc]:not(:last-child) {\n  border-bottom: 1px solid rgba(255,255,255,.71);\n}\n.notice-wrap li[data-v-7007d6fc] {\n  padding: 10px 0;\n  font-size: 14px;\n}\nh3[data-v-7007d6fc] {\n  display: block;\n  font-size: 1.17em;\n  -webkit-margin-before: 1em;\n  -webkit-margin-after: 1em;\n  -webkit-margin-start: 0px;\n  -webkit-margin-end: 0px;\n  font-weight: bold;\n  font-size: 100%;\n}\np[data-v-7007d6fc] {\n  display: block;\n  -webkit-margin-before: 1em;\n  -webkit-margin-after: 1em;\n  -webkit-margin-start: 0px;\n  -webkit-margin-end: 0px;\n}\n.notice-wrap .lay-list[data-v-7007d6fc] {\n  width: 600px;\n  height: 330px;\n  margin: -180px 0 0 -300px\n}\n.notice-wrap .lay-list .notice-icon[data-v-7007d6fc] {\n  background-position: -5px 0;\n  height: 142px\n}\n.notice-wrap .lay-list .lay-notice-icon[data-v-7007d6fc] {\n  width: 155px;\n  padding-top: 60px;\n  margin-right: 20px;\n  float: left;\n  margin-left: 20px\n}\n.notice-wrap .lay-list .lay-content[data-v-7007d6fc] {\n  overflow-y: auto;\n  overflow-x: hidden;\n  height: 280px;\n  margin-top: 26px;\n  margin-right: 20px\n}\n\n", ""]);

// exports


/***/ }),

/***/ 923:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            // msg : ['尊敬的会员您好！【万象更新;年年如意。岁岁平安;财源广进。富贵吉祥;幸福安康。福禄满门;喜气洋洋】值此新春佳节到来之际、爱彩娱乐团队祝您在新的一年里：鸿运当头、一路长虹、2018[發][發][發]！','尊敬的会员您好！支付宝扫码入款【财付通 *晓】通道已经开启，扫码付款时需要备注支付宝认证姓名以便财务核实入款，感谢您的支持，谢谢！','【通知】：如需人工微信入款请添加最新收款微信号：【we238665】谢谢！','尊敬的会员：您好！近期由于微信在线支付渠道不稳定，推荐您优先使用在线支付宝/QQ钱包或微信加好友充值，银行卡快捷支付进行充值，快速上分，祝您游戏愉快，更多充值问题，请联系【在线客服】或客服微信【by55661】客服QQ （188662222）（384208888）'],
            curPage: 0,
            maxPage: 3,
            FooterBoole: true,
            isTrue: false,
            footerMessage: {
                messageArr: []
            }
        };
    },

    computed: {
        footerMessageArrComputed: function footerMessageArrComputed() {
            var emptyArr = [];
            for (var item in this.footerMessage.messageArr) {
                emptyArr.push(this.footerMessage.messageArr[item].message);
            }
            return emptyArr;
        }
    },
    mounted: function mounted() {
        var _this2 = this;

        this.getFooterMessageFromStatic();

        setInterval(function () {
            if (_this2.curPage === _this2.maxPage - 1) {
                _this2.curPage = 0;
            } else {
                _this2.curPage++;
            }
        }, 5000);
    },

    methods: {
        showFooterMore: function showFooterMore() {
            this.isTrue = !this.isTrue;
            this.FooterBoole = !this.FooterBoole;
        },
        gb: function gb() {
            this.isTrue = !this.isTrue;
            this.FooterBoole = false;
        },

        // 获取底部公告数据同时算出公告的个数
        getFooterMessageFromStatic: function getFooterMessageFromStatic() {
            var count = 0;
            var _this = this;
            window.axios.get('/static/messages.js').then(function (response) {
                // 获取数据,要用双引号将数据包起来，才能
                var str = response.data;
                var FooterMessageArr = JSON.parse(str.slice(15, -1));
                var step = 0;

                // 将第四种消息压入数据
                if (step === 0) {
                    for (var item in FooterMessageArr.type_4) {
                        count++;
                        _this.footerMessage.messageArr.push(FooterMessageArr.type_4[item]);
                    }
                    step++;
                }
                // 将第一种消息压入有数据
                if (step === 1) {
                    for (var _item in FooterMessageArr.type_1) {
                        count++;
                        _this.footerMessage.messageArr.push(FooterMessageArr.type_1[_item]);
                    }
                    step++;
                }
                if (step === 2) {
                    _this.maxPage = count;
                }
            });
        }
    }
});

/***/ }),

/***/ 924:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "footer clearfix" }, [
      _c("h3"),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "foottxt_box",
          on: {
            click: function($event) {
              _vm.showFooterMore()
            }
          }
        },
        [
          _c("p", [
            _c("a", { attrs: { href: "#" } }, [
              _vm._v(_vm._s(_vm.footerMessageArrComputed[_vm.curPage]))
            ])
          ])
        ]
      )
    ]),
    _vm._v(" "),
    _vm.isTrue
      ? _c("div", { staticClass: "notice-wrap" }, [
          _c("div", { staticClass: "mask" }),
          _vm._v(" "),
          !_vm.ModelBoole
            ? _c("div", { staticClass: "bg lay-list" }, [
                _c("div", { staticClass: "close-btn" }, [
                  _c(
                    "a",
                    {
                      attrs: { href: "javascript:void(0)" },
                      on: {
                        click: function($event) {
                          _vm.gb()
                        }
                      }
                    },
                    [_vm._v("X")]
                  )
                ]),
                _vm._v(" "),
                _vm._m(0),
                _vm._v(" "),
                _c("div", { staticClass: "notice-content lay-content" }, [
                  _c(
                    "ul",
                    _vm._l(_vm.footerMessage.messageArr, function(item) {
                      return _c("li", [
                        _c("h3", [_vm._v(_vm._s(item.title))]),
                        _vm._v(" "),
                        _c("p", [_vm._v(_vm._s(item.updateTime))]),
                        _vm._v(" "),
                        _c("p", [_vm._v(_vm._s(item.message))])
                      ])
                    })
                  )
                ])
              ])
            : _vm._e()
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "lay-notice-icon" }, [
      _c("i", { staticClass: "notice-icon" })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7007d6fc", module.exports)
  }
}

/***/ }),

/***/ 925:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(926)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(928)
/* template */
var __vue_template__ = __webpack_require__(944)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-98f7d2cc"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/common/chatbar/chatbar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-98f7d2cc", Component.options)
  } else {
    hotAPI.reload("data-v-98f7d2cc", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 926:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(927);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("d1649ed4", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-98f7d2cc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./chatbar.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-98f7d2cc\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./chatbar.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 927:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n.chatbar[data-v-98f7d2cc] {\n    position: fixed;\n    right: 0;\n    top: 0;\n    height: calc(100% - 30px);\n    max-height: 1080px;\n    padding-left: 6px;\n    z-index: 200;\n}\n\n/* 聊天室外部样式 */\n.chatbar .guide[data-v-98f7d2cc] {\n    position: absolute;\n    top: 38%;\n    right: 2px;\n    padding-left: 6px;\n}\n.skin_blue .chatbar .guide .lnk-min[data-v-98f7d2cc] {\n    width: 40px;\n    height: 152px;\n    margin-top: 20px;\n    background: url('/static/game/images/chatbar/chat_float_blue.png') no-repeat;\n    background-size: 100% auto;\n    display: block;\n    cursor: pointer;\n}\n.skin_red .chatbar .guide .lnk-min[data-v-98f7d2cc] {\n    width: 40px;\n    height: 152px;\n    margin-top: 20px;\n    background: url('/static/game/images/chatbar/chat_float_red.png') no-repeat;\n    background-size: 100% auto;\n    display: block;\n    cursor: pointer;\n}\n/* 聊天室内部样式 */\n.chatbar .chatwin.type-normal[data-v-98f7d2cc] {\n    width: 310px;\n    padding-left: 2px;\n}\n.chatWin[data-v-98f7d2cc] {\n    width: 400px !important;\n    padding-left: 0px;\n    background-color: #2161b3;\n}\n.left_5[data-v-98f7d2cc]{\n    left: 5px !important;\n}\n.chatbar .chatwin[data-v-98f7d2cc] {\n    height: 100%;\n    background: #2161b3;\n}\n.chatbar .chatwin.type-normal[data-v-98f7d2cc] {\n    width: 310px;\n}\n.skin_blue .chatbar .chatwin[data-v-98f7d2cc] {\n    height: 100%;\n    background: #2161b3;\n}\n.skin_red .chatbar .chatwin[data-v-98f7d2cc] {\n    height: 100%;\n    background: #bb445a;\n}\n\n\n/***el*/\n/*\n.el-notification {\ndisplay: flex;\nwidth: 330px;\npadding: 14px 26px 14px 13px;\nborder-radius: 8px;\nbox-sizing: border-box;\nborder: 1px solid #ebeef5;\nposition: fixed;\nbackground-color: #fff;\nbox-shadow: 0 2px 12px 0 rgba(0,0,0,.1);\ntransition: opacity .3s,transform .3s,left .3s,right .3s,top .4s,bottom .3s;\noverflow: hidden;\n}\n.el-notification__content {\nfont-size: 14px;\nline-height: 21px;\nmargin: 6px 0 0;\ncolor: #606266;\ntext-align: justify;\n}\n.el-notification__group {\nmargin-left: 13px;\n}\n.el-notification.right {\nright: 16px;\n}\n*/\n.el-notification[data-v-98f7d2cc]{\n    top:90px ! important;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    width: 150px;\n    padding: 2px;\n    border: 1px solid #f44336;\n    position: fixed;\n    border-radius: 0px;\n    /*transition: opacity .3s,transform .3s,left .3s,right .3s,top .4s,bottom .3s;*/\n    overflow: hidden;\n    background:#f44336;\n    background:-webkit-gradient(linear,left top, right top,from(#f44336),to(#f97619));\n    background:linear-gradient(to right,#f44336,#f97619);\n    opacity:.75;\n    text-align:right;\n    z-index:100;\n}\n.el-notification__group[data-v-98f7d2cc] {\n    margin-left: 10px;\n}\n.el-notification.right[data-v-98f7d2cc] {\n    right: 0;\n}\n.el-notification__content[data-v-98f7d2cc] {\n    font-size: 12px;\n    line-height: 16px;\n    margin: 6px 0 4px 0;\n    color: #fff;\n    text-align: justify;\n}\n\n/*body{*/\n/*font-family: \"Helvetica Neue\",Helvetica,\"PingFang SC\",\"Hiragino Sans GB\",\"Microsoft YaHei\",\"微软雅黑\",Arial,sans-serif;*/\n/*overflow-y: hidden;*/\n/*margin:0;*/\n/*padding:0;*/\n/*height:100%;*/\n/*}*/\np[data-v-98f7d2cc]{\n    margin: 0;\n}\na[data-v-98f7d2cc]:-webkit-any-link {\n    cursor: pointer;\n    text-decoration: none;\n}\n[data-v-98f7d2cc]::-webkit-scrollbar {\n    width: 5px;\n}\n[data-v-98f7d2cc]::-webkit-scrollbar-thumb {\n    border-radius: 5px;\n    background-color: #9d9d9d;\n}\nol ul[data-v-98f7d2cc]{\n    list-style: none;\n}\nli[data-v-98f7d2cc]{\n    display: list-item;\n    text-align: -webkit-match-parent;\n    line-height: 20px;\n    font-size: 12px;\n    color: black;\n}\n.chat-header[data-v-98f7d2cc] {\n    width: 100%;\n    min-height: 38px;\n    background-color: #2161b3;\n    /*background: #bb445a;*/\n    padding: 0 14px;\n}\n.chat-header span a[data-v-98f7d2cc]{\n    color: white;\n}\n.title[data-v-98f7d2cc]{\n    display: inline-block;\n    color: #fff;\n    font-size: 15px;\n    line-height: 38px;\n    padding: 0 14px;\n}\n.center[data-v-98f7d2cc]{\n    width:100%;\n    height: 100%;\n    overflow: hidden;\n}\n.center .compose .typing .txtinput[data-v-98f7d2cc] {\n    display: block;\n    width: auto;\n    margin-right: 58px;\n}\n#content[data-v-98f7d2cc] {\n    width:100%;\n    overflow: hidden;\n    overflow-y: auto;\n    background: url(\"/chat/imgs/bg.jpg\") no-repeat right bottom ;\n    background-size: 100% auto !important;\n    -webkit-box-sizing: border-box;\n            box-sizing: border-box;\n    background-attachment: fixed;\n    background-color: #fffef9;\n    border-left: 3px solid #2161b3;\n    border-bottom: 1px solid #2161b3;\n    position: absolute;\n    bottom: 99px;\n    top: 38px;\n}\n.center .item[data-v-98f7d2cc]{\n    margin-top: 30px;\n    margin-bottom: 10px;\n    padding: 5px 10px;\n}\n.center .avatar[data-v-98f7d2cc]{\n    width: 42px;\n    height: 42px;\n    margin-top: 6px;\n    float: left;\n}\n.center .type-right .avatar[data-v-98f7d2cc]{\n    float: right;\n}\n.center .item .avatar img[data-v-98f7d2cc]{\n    display: block;\n    width: 100%;\n    height: 100%;\n    border-radius: 7px;\n}\n.center .type-left .msg-content[data-v-98f7d2cc]{\n    margin-left: 57px;\n    width: 77%;\n}\n.type-right[data-v-98f7d2cc] {\n    overflow: hidden;\n}\n.center .type-right .msg-content[data-v-98f7d2cc]{\n    width: 77%;\n    margin-right:15px;\n    float:right;\n}\n.center .item .msg-content .content-header[data-v-98f7d2cc]{\n    display: block;\n    margin-bottom:-6px;\n    margin-top:-8px;\n}\n.center .type-right .msg-content .content-header[data-v-98f7d2cc]{\n    display: block;\n    margin-bottom:-6px;\n    margin-top:-8px;\n    overflow: hidden;\n}\n.center .item .msg-content .content-header h4[data-v-98f7d2cc]{\n    font-size: 12px;\n    color: #4f77ab;\n    display: inline-block;\n    font-weight: 400;\n    cursor: pointer;\n}\n.center .type-right .msg-content .content-header h4[data-v-98f7d2cc]{\n    float: right;\n}\n.center .item .msg-content .content-header span[data-v-98f7d2cc]{\n    display: inline-block;\n    margin: 0 2px;\n}\n.center .type-right .msg-content .content-header span[data-v-98f7d2cc]{\n    float: right;\n}\n.center .item .msg-content .content-header img[data-v-98f7d2cc]{\n    vertical-align: middle;\n}\n.center .type-right .msg-content .content-header img[data-v-98f7d2cc]{\n    vertical-align: -moz-middle-with-baseline;\n    margin: 0px 2px;\n}\n.content-time[data-v-98f7d2cc]{\n    display: inline-block;\n    background: rgba(70,70,70,.12);\n    color: #a0a0a0;\n    padding: 0 6px;\n    border-radius: 10px;\n    font-weight: 400;\n    font-size: 10px;\n}\n.center .type-right .msg-content .content-time[data-v-98f7d2cc]{\n    margin-top: 8px !important;\n}\n.Bubble.type-system[data-v-98f7d2cc] {\n    background: #ab47bc;\n    background: -webkit-gradient(linear,left top, right top,from(#ab47bc),to(#5169DE));\n    background: linear-gradient(to right,#ab47bc,#5169DE);\n    border-left-color: #5169de;\n    border-right-color: #ab47bc;\n}\n.Bubble[data-v-98f7d2cc] {\n    position: relative;\n    color: #fff;\n    background: #199ed8;\n    border-left-color: #199ed8;\n    border-right-color: #199ed8;\n    border-radius: 5px;\n    padding: 6px 9px;\n    font-size: 13px;\n    line-height: 1.2;\n    display: inline-block;\n    text-shadow: 0 0 1px #35406d;\n}\n.Bubble[data-v-98f7d2cc]:after {\n    content: '';\n    position: absolute;\n    top: 14px;\n    width: 0;\n    height: 0;\n    border: 9px solid transparent;\n    border-top: 0;\n    margin-top: -7px;\n}\n.type-left .Bubble[data-v-98f7d2cc]:after {\n    left: 0;\n    border-left: 0;\n    margin-left: -9px;\n    border-right-color: inherit;\n}\n.type-right .Bubble[data-v-98f7d2cc]{\n    float: right;\n}\n.type-right .Bubble[data-v-98f7d2cc]:after {\n    right: 0;\n    border-right: 0;\n    margin-right: -9px;\n    border-left-color: inherit;\n}\n.RedPack[data-v-98f7d2cc] {\n    position: relative;\n    -webkit-box-sizing: border-box;\n            box-sizing: border-box;\n}\n.RedPack .txt-t5[data-v-98f7d2cc] {\n    font-size: 14px;\n}\n.RBtn[data-v-98f7d2cc] {\n    display: inline-block;\n    border-radius: 3px;\n    padding: 2px 5px;\n    background: #f5c91f;\n    background: -webkit-gradient(linear,left top, left bottom,color-stop(0, #f5c91f),to(#f5a61b));\n    background: linear-gradient(to bottom,#f5c91f 0,#f5a61b 100%);\n    font-size: 12px;\n    color: #553216;\n    border-radius: 5px;\n    padding: 3px 10px;\n    text-decoration: none!important;\n}\n.Bubble a[data-v-98f7d2cc] {\n    color: inherit;\n    text-decoration: underline;\n}\n.center .controls[data-v-98f7d2cc]{\n    position: absolute;\n    top: 3px;\n    left: 0;\n    width: 100%;\n    text-align: center;\n}\n.controls[data-v-98f7d2cc] {\n    position: absolute;\n    right: 0;\n    top: 0;\n    z-index: 200;\n}\n.center .controls a[data-v-98f7d2cc]{\n    text-decoration: none;\n}\n.center .controls .ListCtrl[data-v-98f7d2cc]{\n    margin:0 5px;\n}\n.ListCtrl[data-v-98f7d2cc]{\n    display: inline-block;\n    background: #fff;\n    border: 1px solid #e2e2e2;\n    padding: 1px 9px;\n    padding-left: 7px;\n    border-radius: 15px;\n    color: #a5a5a5;\n    height: 22px;\n    font-size: 14px;\n}\n.center .controls .ListCtrl.active[data-v-98f7d2cc] {\n    color: #ff9d6d;\n}\n.center .announce[data-v-98f7d2cc]{\n    position: absolute;\n    top: 41px;\n    left: 15px;\n    right: 5px;\n    background: rgba(237,244,254,.91);\n    border: 1px solid #c2cfe2;\n    border-radius: 5px;\n    padding-right: 10px;\n    height: 29px;\n    overflow: hidden;\n}\n.center .announce .ttl[data-v-98f7d2cc]{\n    display: block;\n    float: left;\n    width: 60px;\n    background: #e1edfd;\n    color: red;\n    padding: 6px 2px 5px 6px;\n    font-size: 12px;\n}\n.center .announce .scroll[data-v-98f7d2cc]{\n    display: block;\n    margin-left: 72px;\n    padding-top: 5px;\n    overflow: hidden;\n}\n.center .announce .scroll li[data-v-98f7d2cc]{\n    display: inline;\n    margin-right: 10px;\n}\nmarquee[data-v-98f7d2cc] {\n    display: inline-block;\n    width: -webkit-fill-available;\n}\n.compose[data-v-98f7d2cc]{\n    background: #fffef9;\n    position: absolute;\n    width: 100%;\n    bottom: 0;\n    left: 11px;\n}\n.center .compose .control-bar[data-v-98f7d2cc] {\n    height: 36px;\n    background: #f0f0f0;\n    border: 1px solid #adadad;\n    border-left: 0;\n    border-right: 0;\n    position: relative;\n    z-index: 100;\n}\n.el-popover[data-v-98f7d2cc] {\n    position: absolute;\n    background: #fff;\n    min-width: 150px;\n    border-radius: 2px;\n    border: 1px solid #d1dbe5;\n    padding: 10px;\n    z-index: 2000;\n    font-size: 12px;\n    -webkit-box-shadow: 0 2px 4px 0 rgba(0,0,0,.12), 0 0 6px 0 rgba(0,0,0,.04);\n            box-shadow: 0 2px 4px 0 rgba(0,0,0,.12), 0 0 6px 0 rgba(0,0,0,.04);\n}\n.center .compose .typing[data-v-98f7d2cc] {\n    position: relative;\n    padding: 5px;\n}\n.el-textarea__inner[data-v-98f7d2cc] {\n    display: block;\n    resize: vertical;\n    padding: 5px 7px;\n    line-height: 1.5;\n    width: 100%;\n    font-size: 14px;\n    color: #1f2d3d;\n    background-color: #fff;\n    border: 1px solid #bfcbd9;\n    border-radius: 4px;\n    -webkit-transition: border-color .2s cubic-bezier(.645,.045,.355,1);\n    transition: border-color .2s cubic-bezier(.645,.045,.355,1);\n}\n.el-input__inner[data-v-98f7d2cc], .el-textarea__inner[data-v-98f7d2cc] {\n    -webkit-box-sizing: border-box;\n            box-sizing: border-box;\n    background-image: none;\n}\n.el-textarea__inner[data-v-98f7d2cc] {\n    display: block;\n    resize: vertical;\n    padding: 5px 7px;\n    line-height: 1.5;\n    width: 100%;\n    font-size: 14px;\n    color: #1f2d3d;\n    background-color: #fff;\n    border: 1px solid #bfcbd9;\n    border-radius: 4px;\n    -webkit-transition: border-color .2s cubic-bezier(.645,.045,.355,1);\n    transition: border-color .2s cubic-bezier(.645,.045,.355,1);\n}\n.el-input__inner[data-v-98f7d2cc], .el-textarea__inner[data-v-98f7d2cc] {\n    -webkit-box-sizing: border-box;\n            box-sizing: border-box;\n    background-image: none;\n}\ninput[data-v-98f7d2cc], select[data-v-98f7d2cc], textarea[data-v-98f7d2cc] {\n    font-family: Arial,Helvetica,sans-serif;\n}\n.center .compose .typing .sendbtn[data-v-98f7d2cc] {\n    position: absolute;\n    right: 5px;\n    bottom: 5px;\n}\n.center .compose .typing .sendbtn .u-btn1[data-v-98f7d2cc] {\n    width: 53px;\n    height: 53px;\n    font-size: 14px;\n    line-height: 53px;\n    color: #fff;\n}\n.center .compose .typing .sendbtn a[data-v-98f7d2cc]{\n    text-decoration: none;\n}\n.sendbtn .u-btn1[data-v-98f7d2cc] {\n    color: #fff;\n}\n.sendbtn a[data-v-98f7d2cc]:hover{\n    color: #F98D5C;\n    text-decoration:none;\n}\n.center .compose .typing .sendbtn a[data-v-98f7d2cc]:hover{\n    color: #F98D5C;\n    text-decoration:none;\n}\n.u-btn1[data-v-98f7d2cc] {\n    display: inline-block;\n    width: 56px;\n    height: 20px;\n    line-height: 20px;\n    text-align: center;\n    vertical-align: bottom;\n    border-radius: 3px;\n    font-size: 12px;\n    margin-left: 3px;\n    background: #5b8ac7;\n    background: -webkit-gradient(linear,left top, left bottom,color-stop(0, #5b8ac7),to(#2765b5));\n    background: linear-gradient(to bottom,#5b8ac7 0,#2765b5 100%);\n    border: 1px solid #1e57a0;\n    color: #fff;\n    /*background: #aa3748;*/\n    /*background: -moz-linear-gradient(top,#d87c86 0,#6a1f2d 100%);*/\n    /*background: -webkit-linear-gradient(top,#d87c86 0,#6a1f2d 100%);*/\n    /*background: linear-gradient(to bottom,#d87c86 0,#6a1f2d 100%);*/\n    /*border: 1px solid #ab374a;*/\n    /*color: #fff;*/\n}\n.u-btn1[data-v-98f7d2cc]:hover{\n    color: #F98D5C;\n    text-decoration:none;\n}\n.dialog img[data-v-98f7d2cc]{\n    max-height: 300px;\n    max-width: 300px;\n}\n.tc[data-v-98f7d2cc]{\n    text-align: center;\n}\n.SysMsg[data-v-98f7d2cc] {\n    text-align: center;\n    margin-bottom: 10px;\n}\n.SysMsg .inner[data-v-98f7d2cc] {\n    display: inline-block;\n    background: #efefef;\n    border-radius: 8px;\n    border: 1px solid #dddddc;\n    padding: 5px 10px;\n}\n.Txt.type-warning[data-v-98f7d2cc] {\n    color: #f60;\n}\n\n/***icon style***/\n.zhishikuguanli[data-v-98f7d2cc]{\n    font-size: 13px !important;\n    vertical-align: 0 !important;\n}\n.icon-img[data-v-98f7d2cc]{\n    line-height: 36px;\n}\n.icon-lajitong[data-v-98f7d2cc]{\n    font-size: 16px !important;\n    vertical-align: 0px !important;\n}\n.icon-gonggao[data-v-98f7d2cc]{\n    font-size: 20px !important;\n    vertical-align: -2px !important;\n}\n.center .compose .btn-control[data-v-98f7d2cc] {\n    /*height: 100%;*/\n    display: block;\n    line-height: 32px;\n    padding: 0 12px 2px 12px;\n    background: #e5e5e5;\n    color: #717171;\n    margin-right: 1px;\n    float: left;\n    cursor: pointer;\n    border-radius: 0 !important;\n    border: 1px solid #e5e5e5;\n}\n.center .compose .btn-control[data-v-98f7d2cc]:hover{\n    background: #ffd9c7;\n}\n.iconfont[data-v-98f7d2cc] {\n    font-family: iconfont!important;\n    font-size: 20px;\n    line-height: 0px;\n    vertical-align: -4px;\n}\n.icon-home-2[data-v-98f7d2cc] {\n    color: #fff;\n    font-weight: 700;\n    vertical-align: 0!important;\n}\n/***icon style end***/\n\n/***packet style start***/\n.money[data-v-98f7d2cc] {\n    position: fixed;\n    width: 514px;\n    height: 350px;\n    background: url('/chat/imgs/red.png') no-repeat;\n    margin: auto;\n    top: 200px;\n    left: 0;\n    right: 0;\n    -webkit-animation: money-data-v-98f7d2cc 1.5s;\n            animation: money-data-v-98f7d2cc 1.5s;\n}\n@-webkit-keyframes money-data-v-98f7d2cc {\n0% {\n        -webkit-transform: scale(0);\n                transform: scale(0)\n}\n100% {\n        -webkit-transform: scale(1);\n                transform: scale(1)\n}\n}\n@keyframes money-data-v-98f7d2cc {\n0% {\n        -webkit-transform: scale(0);\n                transform: scale(0)\n}\n100% {\n        -webkit-transform: scale(1);\n                transform: scale(1)\n}\n}\n.redPack[data-v-98f7d2cc] {\n    position: fixed;\n    width: 220px;\n    height: 250px;\n    background: #cc453b;\n    border-radius: 10px;\n    margin: auto;\n    left: 0;\n    right: 0;\n    -webkit-animation: redPack-data-v-98f7d2cc 1.5s;\n            animation: redPack-data-v-98f7d2cc 1.5s;\n    top: 300px;\n    z-index: 5;\n}\n.redPack .cover[data-v-98f7d2cc] {\n    height: 140px;\n    border: 1px solid #bd503a;\n    background-color: #de5c42;\n    border-top-left-radius: 10px;\n    border-top-right-radius: 10px;\n    border-bottom-right-radius: 50% 15%;\n    border-bottom-left-radius: 50% 15%;\n    -webkit-box-shadow: 0 4px 0 -1px rgba(0, 0, 0, .2);\n            box-shadow: 0 4px 0 -1px rgba(0, 0, 0, .2);\n    color: #fff;\n}\n.redPack .cover p[data-v-98f7d2cc] {\n    text-align: center;\n    font-size: 18px;\n    line-height: 100px;\n}\n.redPack .sticker[data-v-98f7d2cc] {\n    width: 100px;\n    height: 100px;\n    border: 1px solid #ffa73a;\n    background-color: #ffa73a;\n    border-radius: 50%;\n    color: #fff;\n    font-size: 26px;\n    display: inline-block;\n    position: relative;\n    left: 55px;\n    top: -50px;\n    -webkit-box-shadow: 0 4px 0 0 rgba(0, 0, 0, .2);\n            box-shadow: 0 4px 0 0 rgba(0, 0, 0, .2);\n    cursor: pointer;\n    text-align: center;\n    line-height: 100px;\n}\n@-webkit-keyframes redPack-data-v-98f7d2cc {\n0% {\n        -webkit-transform: scale(0);\n                transform: scale(0);\n        top: 0;\n}\n40% {\n        top: 318px;\n}\n60% {\n        top: 290px;\n}\n80% {\n        top: 306px;\n}\n100% {\n        top: 300px;\n        -webkit-transform: scale(1);\n                transform: scale(1)\n}\n}\n@keyframes redPack-data-v-98f7d2cc {\n0% {\n        -webkit-transform: scale(0);\n                transform: scale(0);\n        top: 0;\n}\n40% {\n        top: 318px;\n}\n60% {\n        top: 290px;\n}\n80% {\n        top: 306px;\n}\n100% {\n        top: 300px;\n        -webkit-transform: scale(1);\n                transform: scale(1)\n}\n}\n.open[data-v-98f7d2cc] {\n    position: fixed;\n    width: 224px;\n    height: 316px;\n    background: url(\"/chat/imgs/red.png\") no-repeat -290px -360px;\n    margin: auto;\n    left: 0;\n    right: 0;\n    top: 280px;\n    opacity: 0;\n    -webkit-transition: all 1s;\n    transition: all 1s;\n}\n.open p[data-v-98f7d2cc] {\n    text-align: center;\n    margin: 0;\n    color: #fff;\n    font-size: 16px;\n    line-height: 380px;\n}\n.disnone[data-v-98f7d2cc] {\n    display: none;\n}\n.disblo[data-v-98f7d2cc] {\n    opacity: 1;\n}\n\n/***packet style end***/\n/***emoji  style***/\n.emoji_box[data-v-98f7d2cc]{\n    background: #fff;\n    width: 185px;\n    height: 120px;\n    border-radius: 2px;\n    -webkit-box-sizing: content-box;\n            box-sizing: content-box;\n    border: 1px solid #d1dbe5;\n    padding: 14px 2px 14px 14px;\n    z-index: 2000;\n    -webkit-box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .12), 0 0 6px 0 rgba(0, 0, 0, .04);\n            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .12), 0 0 6px 0 rgba(0, 0, 0, .04);\n    font-size: 0px;\n    position: fixed;\n    bottom: 110px;\n    left:5px;\n}\n.emoji_box .emoji-container[data-v-98f7d2cc] {\n    width: 180px;\n}\n.emoji[data-v-98f7d2cc] {\n    position: relative;\n    margin-bottom: 5px;\n    margin-right: 5px;\n    display: inline-block;\n    width: 25px;\n    height: 25px;\n    cursor: pointer;\n    background: url('/chat/imgs/emoji@2x.png') no-repeat;\n    background-size: 25px auto\n}\n.emoji[data-v-98f7d2cc]:hover:after {\n    -webkit-box-sizing: content-box;\n            box-sizing: content-box;\n    content: '';\n    position: absolute;\n    width: 25px;\n    height: 25px;\n    padding: 2px;\n    left: -5px;\n    top: -5px;\n    border: 2px solid #f60;\n}\n.Bubble .emoji[data-v-98f7d2cc]:hover:after{\n    border: none ! important;\n}\n.emoji-container .emoji.emoji-smile[data-v-98f7d2cc] {\n    background-position: 0 0\n}\n.emoji-container .emoji.emoji-laughing[data-v-98f7d2cc] {\n    background-position: 0 -25px\n}\n.emoji-container .emoji.emoji-blush[data-v-98f7d2cc] {\n    background-position: 0 -50px\n}\n.emoji-container .emoji.emoji-heart_eyes[data-v-98f7d2cc] {\n    background-position: 0 -75px\n}\n.emoji.emoji-smirk[data-v-98f7d2cc] {\n    background-position: 0 -100px\n}\n.emoji.emoji-flushed[data-v-98f7d2cc] {\n    background-position: 0 -125px\n}\n.emoji.emoji-grin[data-v-98f7d2cc] {\n    background-position: 0 -150px\n}\n.emoji.emoji-kissing_smiling_eyes[data-v-98f7d2cc] {\n    background-position: 0 -175px\n}\n.emoji.emoji-wink[data-v-98f7d2cc] {\n    background-position: 0 -200px\n}\n.emoji.emoji-kissing_closed_eyes[data-v-98f7d2cc] {\n    background-position: 0 -225px\n}\n.emoji.emoji-stuck_out_tongue_winking_eye[data-v-98f7d2cc] {\n    background-position: 0 -250px\n}\n.emoji.emoji-sleeping[data-v-98f7d2cc] {\n    background-position: 0 -275px\n}\n.emoji.emoji-worried[data-v-98f7d2cc] {\n    background-position: 0 -300px\n}\n.emoji.emoji-sweat_smile[data-v-98f7d2cc] {\n    background-position: 0 -325px\n}\n.emoji.emoji-cold_sweat[data-v-98f7d2cc] {\n    background-position: 0 -350px\n}\n.emoji.emoji-joy[data-v-98f7d2cc] {\n    background-position: 0 -375px\n}\n.emoji.emoji-sob[data-v-98f7d2cc] {\n    background-position: 0 -400px\n}\n.emoji.emoji-angry[data-v-98f7d2cc] {\n    background-position: 0 -425px\n}\n.emoji.emoji-mask[data-v-98f7d2cc] {\n    background-position: 0 -450px\n}\n.emoji.emoji-scream[data-v-98f7d2cc] {\n    background-position: 0 -475px\n}\n.emoji.emoji-sunglasses[data-v-98f7d2cc] {\n    background-position: 0 -500px\n}\n.emoji.emoji-thumbsup[data-v-98f7d2cc] {\n    background-position: 0 -525px\n}\n.emoji.emoji-clap[data-v-98f7d2cc] {\n    background-position: 0 -550px\n}\n.emoji.emoji-ok_hand[data-v-98f7d2cc] {\n    background-position: 0 -575px\n}\n.popper__arrow[data-v-98f7d2cc] {\n    width: 15px;\n    height: 12px;\n    background: url('/chat/imgs/sj.png') no-repeat -8px -10px;\n    margin: 10px 0 0 -5px;\n}\n.chatBox[data-v-98f7d2cc]{\n    padding: 5px;\n    width: 297px;\n    height: 54px;\n}\n.h[data-v-98f7d2cc]{\n    float: left;\n    width: 25px;\n    height: 25px;\n    background-color: red;\n}\n/***emoji style end**/\n\n/***profile style***/\n.profile[data-v-98f7d2cc] {\n    width: 100%;\n    height: 100%;\n    position: relative;\n    top: 0;\n    left: 0;\n    z-index: 300;\n    font-size: 14px;\n    color: #4f77ab;\n}\n.profile .inner[data-v-98f7d2cc] {\n    max-width: 310px;\n    border-radius: 5px;\n    background: rgba(255,255,255,.93);\n    margin: 50px auto 0;\n    position: relative;\n    min-height: 200px;\n    border: 1px solid #c8d4e4;\n    text-align: center;\n    padding: 20px 0;\n    width: 90%;\n}\n.profile .avatar[data-v-98f7d2cc] {\n    display: inline-block;\n    border-radius: 50%;\n    width: 90px;\n    height: 90px;\n    border: 1px solid #c8d4e4;\n    overflow: hidden;\n    cursor: pointer;\n}\n.profile .avatar img[data-v-98f7d2cc] {\n    display: block;\n    width: 100%;\n    height: 100%;\n}\n.profile .avatar label[data-v-98f7d2cc] {\n    /*display: none;*/\n    position: absolute;\n    top: 22px;\n    left: 8px;\n    width: 100%;\n    text-align: center;\n    font-size: 50px;\n    color: #909090;\n    cursor: pointer;\n}\n.profile p[data-v-98f7d2cc] {\n    margin-top: 5px;\n}\n.profile .txt-nick[data-v-98f7d2cc] {\n    font-size: 20px;\n}\n/***profile style***/\n", ""]);

// exports


/***/ }),

/***/ 928:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_element_ui__ = __webpack_require__(87);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_element_ui___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_element_ui__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue_image_crop_upload__ = __webpack_require__(929);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_vue_image_crop_upload___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_vue_image_crop_upload__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_lightbox2_dist_css_lightbox_min_css__ = __webpack_require__(938);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_lightbox2_dist_css_lightbox_min_css___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_lightbox2_dist_css_lightbox_min_css__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_lightbox2__ = __webpack_require__(339);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_lightbox2___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_lightbox2__);
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
//
//
//
//


var $ = __webpack_require__(88)
// io = require('this.socket.io-client'),
// this.socket = io(':6003'),
;

// const  user = parseInt(Math.random()*10000);




/**lightbox2  js and css **/


// lightbox.option({
//     'resizeDuration': 200,
//     'wrapAround': true,
//     'positionFromTop':'30%',
//     'maxWidth':'60%',
//     'maxHeight':'60%',
//     'fadeDuration':700,
//     'showImageNumberLabel':false,
//     'alwaysShowNavOnTouchDevices':true,
// });
/**lightbox2  js and css end**/

/* harmony default export */ __webpack_exports__["default"] = ({
    components: {
        avatarUpload: __WEBPACK_IMPORTED_MODULE_1_vue_image_crop_upload___default.a
    },
    data: function data() {
        return {
            isChatWin: false, //调节聊天室宽度
            chatUser: {
                username: '',
                avatar: '',
                chatRole: ''
            },
            chatIsTrue: true,
            // avatar_img:'chat/imgs/avatar.png',
            chat_system: true,
            checkedSchedule: [],
            schedules: [],
            schedule_type: {
                schedule_pk10: true,
                schedule_mssc: true,
                schedule_cqssc: true
            },
            items: [], //消息记录
            message: '', //消息
            packet_id: '',
            packet_money: '',
            text_disables: '',
            bullets: {},
            sendImgVisible: false,
            emojiVisible: false,
            showPacketDialog: false,
            setTimeoutHandler: null,
            redPackDisNone: false,
            emojis: [{ 'class': 'emoji-smile', 'emoji_u': '😄' }, { 'class': 'emoji-laughing', 'emoji_u': '😆' }, { 'class': 'emoji-blush', 'emoji_u': '😊' }, { 'class': 'emoji-heart_eyes', 'emoji_u': '😍' }, { 'class': 'emoji-smirk', 'emoji_u': '😏' }, { 'class': 'emoji-flushed', 'emoji_u': '😳' }, { 'class': 'emoji-grin', 'emoji_u': '😁' }, { 'class': 'emoji-kissing_smiling_eyes', 'emoji_u': '😚' }, { 'class': 'emoji-wink', 'emoji_u': '😉' }, { 'class': 'emoji-kissing_closed_eyes', 'emoji_u': '😘' }, { 'class': 'emoji-stuck_out_tongue_winking_eye', 'emoji_u': '😜' }, { 'class': 'emoji-sleeping', 'emoji_u': '😪' }, { 'class': 'emoji-worried', 'emoji_u': '😔' }, { 'class': 'emoji-sweat_smile', 'emoji_u': '😅' }, { 'class': 'emoji-cold_sweat', 'emoji_u': '😰' }, { 'class': 'emoji-joy', 'emoji_u': '😂' }, { 'class': 'emoji-sob', 'emoji_u': '😭' }, { 'class': 'emoji-angry', 'emoji_u': '😠' }, { 'class': 'emoji-mask', 'emoji_u': '😷' }, { 'class': 'emoji-scream', 'emoji_u': '😱' }, { 'class': 'emoji-sunglasses', 'emoji_u': '😎' }, { 'class': 'emoji-thumbsup', 'emoji_u': '👍' }, { 'class': 'emoji-clap', 'emoji_u': '👏' }, { 'class': 'emoji-ok_hand', 'emoji_u': '👌' }],
            emojiReg: "😄|😆|😊|😍|😏|😳|😁|😚|😉|😘|😜|😪|😔|😅|😰|😂|😭|😠|😷|😱|😎|👍|👏|👌",
            emojiMap: { "😄": "emoji-smile", "😆": "emoji-laughing", "😊": "emoji-blush", "😍": "emoji-heart_eyes", "😏": "emoji-smirk", "😳": "emoji-flushed", "😁": "emoji-grin",
                "😚": "emoji-kissing_smiling_eyes", "😉": "emoji-wink", "😘": "emoji-kissing_closed_eyes", "😜": "emoji-stuck_out_tongue_winking_eye", "😪": "emoji-sleeping", "😔": "emoji-worried",
                "😅": "emoji-sweat_smile", "😰": "emoji-cold_sweat", "😂": "emoji-joy", "😭": "emoji-sob", "😠": "emoji-angry", "😷": "emoji-mask", "😱": "emoji-scream", "😎": "emoji-sunglasses",
                "👍": "emoji-thumbsup", "👏": "emoji-clap", "👌": "emoji-ok_hand" },
            form: {
                imgUrl: '',
                note: '',
                file: {}
            },
            platcfg: {
                is_open: true
            },
            profile: {
                show: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                avatarHover: false,
                profileDialog: false
            }
        };
    },

    methods: {
        login: function login() {
            var _this = this;
            _this.chatIsTrue = !_this.chatIsTrue;
            window.axios.post('chat/login').then(function (response) {
                var res = response.data;
                if (res.is_auto === "1") {
                    //是否自动展开聊天室  false 为自动展开
                    /**判断下注最低推送额**/
                    _this.chatIsTrue = false;
                }
                if (res.code === -1) {
                    //聊天室已关闭
                    _this.platcfg.is_open = false;
                    _this.$message.error(res.msg);
                    return;
                }

                /**用户信息**/
                _this.chatUser.username = res.user.username;
                _this.chatUser.avatar = res.user.avatar;
                _this.chatUser.chatRole = res.user.chatRole;

                // _this.text_disables = eval('/'+res.disables+'/gi');
                _this.text_disables = new RegExp(res.disables, 'gi'); //违禁词
                _this.bullets = res.bullets; //公告
                _this.schedules = res.schedules;
                _this.checkedSchedule = res.schedules;
                for (var i = 0; i < res.messages.length; i++) {
                    _this.items.push(JSON.parse(res.messages[i]));
                }
                if (_this.items.length > 0) {
                    _this.items.push({ type: 'SysMsg' });
                }
                _this.items.push({ type: 'UserNickSysMsg' });
                _this.items.push({ type: 'UserAvatarSysMsg' });
            }).catch(function (error) {
                console.log(error);
            });

            this.socket.on('welcome', function (data) {
                if (this.chatUser.username != data) {
                    Object(__WEBPACK_IMPORTED_MODULE_0_element_ui__["Notification"])({
                        message: '欢迎游客' + data + '进入聊天室',
                        showClose: false,
                        duration: 1000
                    });
                }
            });

            /*message channel*/
            this.socket.on('message', function (data) {
                var msg = {
                    name: this.chatUser.username,
                    imgSrc: this.chatUser.avatar,
                    levelSrc: '/chat/imgs/icon_member03.gif',
                    sendSrc: data.imgUrl,
                    date: data.date,
                    type: data.type,
                    content: data.message
                };
                if (this.chatUser.username == data.uid) {
                    msg.type_right = true;
                    msg.type_left = false;
                } else {
                    msg.type_right = false;
                    msg.type_left = true;
                }
                this.items.push(msg);
            });

            /**redis channel**/
            this.socket.on('chat-room', function (data) {
                console.log(data);
            });
            this.socket.on('chat-packet', function (data) {
                this.items.push({
                    type: 'chat-packet',
                    date: data.date,
                    id: data.data
                });
            });
            this.socket.on('chat-system', function (data) {
                this.items.push({
                    type: 'chat-system',
                    date: data.date,
                    schedule: data.schedule,
                    content: data.content
                });
            });
        },
        send: function send() {
            var _this = this;
            //_this.message = _this.message.replace(/(\r\n)|(\n)/g, "");    //过滤换行
            if (_this.message.replace(/(^\s*)|(\s*$)|(\r\n)|(\n)/g, "") == '') {
                // /(^\s*)|(\s*$)/g    // 过滤空格 ,过滤换行
                return false;
            }
            var _m = _this.message.replace(new RegExp(_this.emojiReg, 'gi'), function (index) {
                return "<i class='emoji " + _this.emojiMap[index] + " '></i>";
            });
            var data = {
                message: _m.replace(_this.text_disables, function (sMatch) {
                    return sMatch.replace(/./g, "*");
                }),
                uid: _this.chatUser.username
            };
            this.socket.emit('message', data);
            _this.message = '';
        },
        enterSend: function enterSend(e) {
            var _this = this;
            if (e.keyCode === 13) {
                e.cancelBubble = true;
                e.preventDefault();
                e.stopPropagation();
                _this.send();
            }
        },
        clean: function clean() {
            this.items = [];
        },
        scroll: function scroll() {
            this.$nextTick(function () {
                document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
            });
        },
        paste: function paste(e) {
            var _this = this;
            if ((e.clipboardData || e.originalEvent) && e.clipboardData.items) {
                if (e.clipboardData.items[0].kind == 'file') {
                    //  e.clipboardData.items[0].type =  image/png
                    _this.form.file = e.clipboardData.items[0].getAsFile();
                    _this.form.imgUrl = _this.createObjURL(_this.form.file);
                    _this.sendImgVisible = true;
                }
            }
        },
        emoji: function emoji(index) {
            var _this = this;
            _this.message += index;
            _this.emojiVisible = false;
            $('textarea').focus();
        },
        upload: function upload(e) {
            var _this = this,
                files = e.target.files || e.dataTransfer.files;
            _this.form.file = files[0];
            _this.form.imgUrl = _this.createObjURL(files[0]);
            _this.sendImgVisible = true;
        },
        dialogHandleClose: function dialogHandleClose(done) {
            var _this = this;
            _this.form.imgUrl = '';
            _this.form.note = '';
            done();
        },
        createObjURL: function createObjURL(obj) {
            var blobUrl = null;
            if (window.createObjectURL != undefined) {
                // basic
                blobUrl = window.createObjectURL(obj);
            } else if (window.URL != undefined) {
                // mozilla(firefox)
                blobUrl = window.URL.createObjectURL(obj);
            } else if (window.webkitURL != undefined) {
                // webkit or chrome
                blobUrl = window.webkitURL.createObjectURL(obj);
            }
            return blobUrl;
        },
        sendImg: function sendImg() {
            var _this = this;
            var _form = new FormData();
            _form.append("file", _this.form.file);
            _form.append("note", _this.form.note);
            if (_this.form.imgUrl != '') {
                window.axios.post('chat/upload', _form).then(function (response) {
                    var data = response.data;
                    var _data = {
                        message: data.message,
                        imgUrl: data.imgUrl,
                        uid: user
                    };
                    this.socket.emit('message', _data);
                    _this.form.imgUrl = '';
                    _this.form.note = '';
                    _this.sendImgVisible = false;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        showPacket: function showPacket(id) {
            var _this = this;
            _this.packet_id = id;
            _this.redPackDisNone = false;
            _this.showPacketDialog = true;
            _this.setTimeoutHandler = _this.setTimeout();
        },
        setTimeout: function (_setTimeout) {
            function setTimeout() {
                return _setTimeout.apply(this, arguments);
            }

            setTimeout.toString = function () {
                return _setTimeout.toString();
            };

            return setTimeout;
        }(function () {
            var _this2 = this;

            setTimeout(function () {
                _this2.showPacketDialog = false;
            }, 5000);
        }),
        getPacket: function getPacket() {
            var _this = this;
            window.axios.post('chat/getPacket', { packet: _this.packet_id }).then(function (response) {
                var res = response.data;
                if (res.code === 0) {
                    _this.redPackDisNone = true;
                    _this.packet_money = res.money;
                }
            }).catch(function (error) {
                console.log(error);
            });
        },
        emojiClass: function emojiClass(index) {
            return 'emoji ' + index;
        },
        handleCheckedScheduleChange: function handleCheckedScheduleChange(val) {
            var diff = this.schedules.filter(function (key) {
                return !val.includes(key);
            });
            for (var i = 0; i < diff.length; i++) {
                if (diff[i] === '北京赛车') {
                    this.schedule_type.schedule_pk10 = false;
                }
                if (diff[i] === '秒速赛车') {
                    this.schedule_type.schedule_mssc = false;
                }
                if (diff[i] === '重庆时时彩') {
                    this.schedule_type.schedule_cqssc = false;
                }
            }
            for (var j = 0; j < val.length; j++) {
                if (val[j] === '北京赛车') {
                    this.schedule_type.schedule_pk10 = true;
                }
                if (val[j] === '秒速赛车') {
                    this.schedule_type.schedule_mssc = true;
                }
                if (val[j] === '重庆时时彩') {
                    this.schedule_type.schedule_cqssc = true;
                }
            }
        },
        userNick: function userNick() {
            this.$prompt('请输入昵称, 昵称设置后将无法更改', '修改昵称', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                inputPattern: /^\S+$/,
                inputErrorMessage: '昵称格式不正确'
            }).then(function (_ref) {
                var value = _ref.value;

                window.axios.post('chat/updateUserNick', { nick: value }).then(function (response) {
                    var res = response.data;
                    if (res.code === 0) {
                        Object(__WEBPACK_IMPORTED_MODULE_0_element_ui__["Message"])({
                            message: '修改成功！',
                            type: 'success'
                        });
                    } else {
                        Object(__WEBPACK_IMPORTED_MODULE_0_element_ui__["Message"])({
                            message: '修改失败！',
                            type: 'error'
                        });
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }).catch(function () {});
        },
        userAvatarUpload: function userAvatarUpload(e) {
            var _this = this,
                files = e.target.files || e.dataTransfer.files;
            _this.$refs.avatarUpload.setSourceImg(files[0]);
            _this.profile.show = true;
        },

        userAvatarHover: function userAvatarHover() {
            this.profile.avatarHover = !this.profile.avatarHover;
        },
        /* crop success  [param] imgDataUrl   [param] field */
        cropSuccess: function cropSuccess(imgDataUrl, field) {
            // this.aUpload.imgDataUrl = imgDataUrl;
        },

        /* upload success [param] jsonData   服务器返回数据，已进行json转码  [param] field */
        cropUploadSuccess: function cropUploadSuccess(jsonData, field) {
            _this.$refs.avatarUpload.off();
            // off() {
            //     setTimeout(()=> {
            //         this.$emit('input', false);
            //         if(this.step == 3 && this.loading == 2){
            //             this.setStep(1);
            //         }
            //     }, 200);
            // },
        },

        /* upload fail [param] status    server api return error status, like 500  [param] field */
        cropUploadFail: function cropUploadFail(status, field) {
            _this.$refs.avatarUpload.off();
        },
        changeChat: function changeChat() {
            this.chatIsTrue = !this.chatIsTrue;
            this.isChatWin = false;
        }
    },
    mounted: function mounted() {},

    watch: {
        items: function items() {

            this.$nextTick(function () {
                document.getElementById('content').scrollTop = document.getElementById('content').scrollHeight;
            });
        }
    }
});

/***/ }),

/***/ 929:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(930)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(932)
/* template */
var __vue_template__ = __webpack_require__(937)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "node_modules/vue-image-crop-upload/upload-2.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-25292217", Component.options)
  } else {
    hotAPI.reload("data-v-25292217", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 930:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(931);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("19b213fa", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../css-loader/index.js!../vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-25292217\",\"scoped\":false,\"hasInlineConfig\":true}!../vue-loader/lib/selector.js?type=styles&index=0!./upload-2.vue", function() {
     var newContent = require("!!../css-loader/index.js!../vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-25292217\",\"scoped\":false,\"hasInlineConfig\":true}!../vue-loader/lib/selector.js?type=styles&index=0!./upload-2.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 931:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n@charset \"UTF-8\";\n@-webkit-keyframes vicp_progress {\n0% {\r\n    background-position-y: 0;\n}\n100% {\r\n    background-position-y: 40px;\n}\n}\n@keyframes vicp_progress {\n0% {\r\n    background-position-y: 0;\n}\n100% {\r\n    background-position-y: 40px;\n}\n}\n@-webkit-keyframes vicp {\n0% {\r\n    opacity: 0;\r\n    -webkit-transform: scale(0) translatey(-60px);\r\n            transform: scale(0) translatey(-60px);\n}\n100% {\r\n    opacity: 1;\r\n    -webkit-transform: scale(1) translatey(0);\r\n            transform: scale(1) translatey(0);\n}\n}\n@keyframes vicp {\n0% {\r\n    opacity: 0;\r\n    -webkit-transform: scale(0) translatey(-60px);\r\n            transform: scale(0) translatey(-60px);\n}\n100% {\r\n    opacity: 1;\r\n    -webkit-transform: scale(1) translatey(0);\r\n            transform: scale(1) translatey(0);\n}\n}\n.vue-image-crop-upload {\r\n  position: fixed;\r\n  display: block;\r\n  -webkit-box-sizing: border-box;\r\n          box-sizing: border-box;\r\n  z-index: 10000;\r\n  top: 0;\r\n  bottom: 0;\r\n  left: 0;\r\n  right: 0;\r\n  width: 100%;\r\n  height: 100%;\r\n  background-color: rgba(0, 0, 0, 0.65);\r\n  -webkit-tap-highlight-color: transparent;\r\n  -moz-tap-highlight-color: transparent;\n}\n.vue-image-crop-upload .vicp-wrap {\r\n    -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);\r\n            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);\r\n    position: fixed;\r\n    display: block;\r\n    -webkit-box-sizing: border-box;\r\n            box-sizing: border-box;\r\n    z-index: 10000;\r\n    top: 0;\r\n    bottom: 0;\r\n    left: 0;\r\n    right: 0;\r\n    margin: auto;\r\n    width: 600px;\r\n    height: 330px;\r\n    padding: 25px;\r\n    background-color: #fff;\r\n    border-radius: 2px;\r\n    -webkit-animation: vicp 0.12s ease-in;\r\n            animation: vicp 0.12s ease-in;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-close {\r\n      position: absolute;\r\n      right: -30px;\r\n      top: -30px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-close .vicp-icon4 {\r\n        position: relative;\r\n        display: block;\r\n        width: 30px;\r\n        height: 30px;\r\n        cursor: pointer;\r\n        -webkit-transition: -webkit-transform 0.18s;\r\n        transition: -webkit-transform 0.18s;\r\n        transition: transform 0.18s;\r\n        transition: transform 0.18s, -webkit-transform 0.18s;\r\n        -webkit-transform: rotate(0);\r\n                transform: rotate(0);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-close .vicp-icon4::after, .vue-image-crop-upload .vicp-wrap .vicp-close .vicp-icon4::before {\r\n          -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);\r\n                  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);\r\n          content: '';\r\n          position: absolute;\r\n          top: 12px;\r\n          left: 4px;\r\n          width: 20px;\r\n          height: 3px;\r\n          -webkit-transform: rotate(45deg);\r\n                  transform: rotate(45deg);\r\n          background-color: #fff;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-close .vicp-icon4::after {\r\n          -webkit-transform: rotate(-45deg);\r\n                  transform: rotate(-45deg);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-close .vicp-icon4:hover {\r\n          -webkit-transform: rotate(90deg);\r\n                  transform: rotate(90deg);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step1 .vicp-drop-area {\r\n      position: relative;\r\n      -webkit-box-sizing: border-box;\r\n              box-sizing: border-box;\r\n      padding: 35px;\r\n      height: 170px;\r\n      background-color: rgba(0, 0, 0, 0.03);\r\n      text-align: center;\r\n      border: 1px dashed rgba(0, 0, 0, 0.08);\r\n      overflow: hidden;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step1 .vicp-drop-area .vicp-icon1 {\r\n        display: block;\r\n        margin: 0 auto 6px;\r\n        width: 42px;\r\n        height: 42px;\r\n        overflow: hidden;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step1 .vicp-drop-area .vicp-icon1 .vicp-icon1-arrow {\r\n          display: block;\r\n          margin: 0 auto;\r\n          width: 0;\r\n          height: 0;\r\n          border-bottom: 14.7px solid rgba(0, 0, 0, 0.3);\r\n          border-left: 14.7px solid transparent;\r\n          border-right: 14.7px solid transparent;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step1 .vicp-drop-area .vicp-icon1 .vicp-icon1-body {\r\n          display: block;\r\n          width: 12.6px;\r\n          height: 14.7px;\r\n          margin: 0 auto;\r\n          background-color: rgba(0, 0, 0, 0.3);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step1 .vicp-drop-area .vicp-icon1 .vicp-icon1-bottom {\r\n          -webkit-box-sizing: border-box;\r\n                  box-sizing: border-box;\r\n          display: block;\r\n          height: 12.6px;\r\n          border: 6px solid rgba(0, 0, 0, 0.3);\r\n          border-top: none;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step1 .vicp-drop-area .vicp-hint {\r\n        display: block;\r\n        padding: 15px;\r\n        font-size: 14px;\r\n        color: #666;\r\n        line-height: 30px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step1 .vicp-drop-area .vicp-no-supported-hint {\r\n        display: block;\r\n        position: absolute;\r\n        top: 0;\r\n        left: 0;\r\n        padding: 30px;\r\n        width: 100%;\r\n        height: 60px;\r\n        line-height: 30px;\r\n        background-color: #eee;\r\n        text-align: center;\r\n        color: #666;\r\n        font-size: 14px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step1 .vicp-drop-area:hover {\r\n        cursor: pointer;\r\n        border-color: rgba(0, 0, 0, 0.1);\r\n        background-color: rgba(0, 0, 0, 0.05);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop {\r\n      overflow: hidden;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left {\r\n        float: left;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-img-container {\r\n          position: relative;\r\n          display: block;\r\n          width: 240px;\r\n          height: 180px;\r\n          background-color: #e5e5e0;\r\n          overflow: hidden;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-img-container .vicp-img {\r\n            position: absolute;\r\n            display: block;\r\n            cursor: move;\r\n            -webkit-user-select: none;\r\n               -moz-user-select: none;\r\n                -ms-user-select: none;\r\n                    user-select: none;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-img-container .vicp-img-shade {\r\n            -webkit-box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.18);\r\n                    box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.18);\r\n            position: absolute;\r\n            background-color: rgba(241, 242, 243, 0.8);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-img-container .vicp-img-shade.vicp-img-shade-1 {\r\n              top: 0;\r\n              left: 0;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-img-container .vicp-img-shade.vicp-img-shade-2 {\r\n              bottom: 0;\r\n              right: 0;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-rotate {\r\n          position: relative;\r\n          width: 240px;\r\n          height: 18px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-rotate i {\r\n            display: block;\r\n            width: 18px;\r\n            height: 18px;\r\n            border-radius: 100%;\r\n            line-height: 18px;\r\n            text-align: center;\r\n            font-size: 12px;\r\n            font-weight: bold;\r\n            background-color: rgba(0, 0, 0, 0.08);\r\n            color: #fff;\r\n            overflow: hidden;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-rotate i:hover {\r\n              -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12);\r\n                      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12);\r\n              cursor: pointer;\r\n              background-color: rgba(0, 0, 0, 0.14);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-rotate i:first-child {\r\n              float: left;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-rotate i:last-child {\r\n              float: right;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range {\r\n          position: relative;\r\n          margin: 30px 0 10px 0;\r\n          width: 240px;\r\n          height: 18px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range .vicp-icon5,\r\n          .vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range .vicp-icon6 {\r\n            position: absolute;\r\n            top: 0;\r\n            width: 18px;\r\n            height: 18px;\r\n            border-radius: 100%;\r\n            background-color: rgba(0, 0, 0, 0.08);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range .vicp-icon5:hover,\r\n            .vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range .vicp-icon6:hover {\r\n              -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12);\r\n                      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12);\r\n              cursor: pointer;\r\n              background-color: rgba(0, 0, 0, 0.14);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range .vicp-icon5 {\r\n            left: 0;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range .vicp-icon5::before {\r\n              position: absolute;\r\n              content: '';\r\n              display: block;\r\n              left: 3px;\r\n              top: 8px;\r\n              width: 12px;\r\n              height: 2px;\r\n              background-color: #fff;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range .vicp-icon6 {\r\n            right: 0;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range .vicp-icon6::before {\r\n              position: absolute;\r\n              content: '';\r\n              display: block;\r\n              left: 3px;\r\n              top: 8px;\r\n              width: 12px;\r\n              height: 2px;\r\n              background-color: #fff;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range .vicp-icon6::after {\r\n              position: absolute;\r\n              content: '';\r\n              display: block;\r\n              top: 3px;\r\n              left: 8px;\r\n              width: 2px;\r\n              height: 12px;\r\n              background-color: #fff;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range] {\r\n            display: block;\r\n            padding-top: 5px;\r\n            margin: 0 auto;\r\n            width: 180px;\r\n            height: 8px;\r\n            vertical-align: top;\r\n            background: transparent;\r\n            -webkit-appearance: none;\r\n               -moz-appearance: none;\r\n                    appearance: none;\r\n            cursor: pointer;\r\n            /* 滑块\r\n\t\t\t\t\t\t\t ---------------------------------------------------------------*/\r\n            /* 轨道\r\n\t\t\t\t\t\t\t ---------------------------------------------------------------*/\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]:focus {\r\n              outline: none;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]::-webkit-slider-thumb {\r\n              -webkit-box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.18);\r\n                      box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.18);\r\n              -webkit-appearance: none;\r\n                      appearance: none;\r\n              margin-top: -3px;\r\n              width: 12px;\r\n              height: 12px;\r\n              background-color: #61c091;\r\n              border-radius: 100%;\r\n              border: none;\r\n              -webkit-transition: 0.2s;\r\n              transition: 0.2s;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]::-moz-range-thumb {\r\n              box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.18);\r\n              -moz-appearance: none;\r\n                   appearance: none;\r\n              width: 12px;\r\n              height: 12px;\r\n              background-color: #61c091;\r\n              border-radius: 100%;\r\n              border: none;\r\n              -webkit-transition: 0.2s;\r\n              transition: 0.2s;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]::-ms-thumb {\r\n              box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.18);\r\n              appearance: none;\r\n              width: 12px;\r\n              height: 12px;\r\n              background-color: #61c091;\r\n              border: none;\r\n              border-radius: 100%;\r\n              -webkit-transition: 0.2s;\r\n              transition: 0.2s;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]:active::-moz-range-thumb {\r\n              box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);\r\n              width: 14px;\r\n              height: 14px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]:active::-ms-thumb {\r\n              box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);\r\n              width: 14px;\r\n              height: 14px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]:active::-webkit-slider-thumb {\r\n              -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);\r\n                      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.23);\r\n              margin-top: -4px;\r\n              width: 14px;\r\n              height: 14px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]::-webkit-slider-runnable-track {\r\n              -webkit-box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12);\r\n                      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12);\r\n              width: 100%;\r\n              height: 6px;\r\n              cursor: pointer;\r\n              border-radius: 2px;\r\n              border: none;\r\n              background-color: rgba(68, 170, 119, 0.3);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]::-moz-range-track {\r\n              box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12);\r\n              width: 100%;\r\n              height: 6px;\r\n              cursor: pointer;\r\n              border-radius: 2px;\r\n              border: none;\r\n              background-color: rgba(68, 170, 119, 0.3);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]::-ms-track {\r\n              box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.12);\r\n              width: 100%;\r\n              cursor: pointer;\r\n              background: transparent;\r\n              border-color: transparent;\r\n              color: transparent;\r\n              height: 6px;\r\n              border-radius: 2px;\r\n              border: none;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]::-ms-fill-lower {\r\n              background-color: rgba(68, 170, 119, 0.3);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]::-ms-fill-upper {\r\n              background-color: rgba(68, 170, 119, 0.15);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]:focus::-webkit-slider-runnable-track {\r\n              background-color: rgba(68, 170, 119, 0.5);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]:focus::-moz-range-track {\r\n              background-color: rgba(68, 170, 119, 0.5);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]:focus::-ms-fill-lower {\r\n              background-color: rgba(68, 170, 119, 0.45);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-left .vicp-range input[type=range]:focus::-ms-fill-upper {\r\n              background-color: rgba(68, 170, 119, 0.25);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-right {\r\n        float: right;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-right .vicp-preview {\r\n          height: 150px;\r\n          overflow: hidden;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-right .vicp-preview .vicp-preview-item {\r\n            position: relative;\r\n            padding: 5px;\r\n            width: 100px;\r\n            height: 100px;\r\n            float: left;\r\n            margin-right: 16px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-right .vicp-preview .vicp-preview-item span {\r\n              position: absolute;\r\n              bottom: -30px;\r\n              width: 100%;\r\n              font-size: 14px;\r\n              color: #bbb;\r\n              display: block;\r\n              text-align: center;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-right .vicp-preview .vicp-preview-item img {\r\n              position: absolute;\r\n              display: block;\r\n              top: 0;\r\n              bottom: 0;\r\n              left: 0;\r\n              right: 0;\r\n              margin: auto;\r\n              padding: 3px;\r\n              background-color: #fff;\r\n              border: 1px solid rgba(0, 0, 0, 0.15);\r\n              overflow: hidden;\r\n              -webkit-user-select: none;\r\n                 -moz-user-select: none;\r\n                  -ms-user-select: none;\r\n                      user-select: none;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-right .vicp-preview .vicp-preview-item.vicp-preview-item-circle {\r\n              margin-right: 0;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step2 .vicp-crop .vicp-crop-right .vicp-preview .vicp-preview-item.vicp-preview-item-circle img {\r\n                border-radius: 100%;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step3 .vicp-upload {\r\n      position: relative;\r\n      -webkit-box-sizing: border-box;\r\n              box-sizing: border-box;\r\n      padding: 35px;\r\n      height: 170px;\r\n      background-color: rgba(0, 0, 0, 0.03);\r\n      text-align: center;\r\n      border: 1px dashed #ddd;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step3 .vicp-upload .vicp-loading {\r\n        display: block;\r\n        padding: 15px;\r\n        font-size: 16px;\r\n        color: #999;\r\n        line-height: 30px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step3 .vicp-upload .vicp-progress-wrap {\r\n        margin-top: 12px;\r\n        background-color: rgba(0, 0, 0, 0.08);\r\n        border-radius: 3px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step3 .vicp-upload .vicp-progress-wrap .vicp-progress {\r\n          position: relative;\r\n          display: block;\r\n          height: 5px;\r\n          border-radius: 3px;\r\n          background-color: #4a7;\r\n          -webkit-box-shadow: 0 2px 6px 0 rgba(68, 170, 119, 0.3);\r\n                  box-shadow: 0 2px 6px 0 rgba(68, 170, 119, 0.3);\r\n          -webkit-transition: width 0.15s linear;\r\n          transition: width 0.15s linear;\r\n          background-image: linear-gradient(-45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent);\r\n          background-size: 40px 40px;\r\n          -webkit-animation: vicp_progress 0.5s linear infinite;\r\n                  animation: vicp_progress 0.5s linear infinite;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step3 .vicp-upload .vicp-progress-wrap .vicp-progress::after {\r\n            content: '';\r\n            position: absolute;\r\n            display: block;\r\n            top: -3px;\r\n            right: -3px;\r\n            width: 9px;\r\n            height: 9px;\r\n            border: 1px solid rgba(245, 246, 247, 0.7);\r\n            -webkit-box-shadow: 0 1px 4px 0 rgba(68, 170, 119, 0.7);\r\n                    box-shadow: 0 1px 4px 0 rgba(68, 170, 119, 0.7);\r\n            border-radius: 100%;\r\n            background-color: #4a7;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-step3 .vicp-upload .vicp-error,\r\n      .vue-image-crop-upload .vicp-wrap .vicp-step3 .vicp-upload .vicp-success {\r\n        height: 100px;\r\n        line-height: 100px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-operate {\r\n      position: absolute;\r\n      right: 20px;\r\n      bottom: 20px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-operate a {\r\n        position: relative;\r\n        float: left;\r\n        display: block;\r\n        margin-left: 10px;\r\n        width: 100px;\r\n        height: 36px;\r\n        line-height: 36px;\r\n        text-align: center;\r\n        cursor: pointer;\r\n        font-size: 14px;\r\n        color: #4a7;\r\n        border-radius: 2px;\r\n        overflow: hidden;\r\n        -webkit-user-select: none;\r\n           -moz-user-select: none;\r\n            -ms-user-select: none;\r\n                user-select: none;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-operate a:hover {\r\n          background-color: rgba(0, 0, 0, 0.03);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-error,\r\n    .vue-image-crop-upload .vicp-wrap .vicp-success {\r\n      display: block;\r\n      font-size: 14px;\r\n      line-height: 24px;\r\n      height: 24px;\r\n      color: #d10;\r\n      text-align: center;\r\n      vertical-align: top;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-success {\r\n      color: #4a7;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-icon3 {\r\n      position: relative;\r\n      display: inline-block;\r\n      width: 20px;\r\n      height: 20px;\r\n      top: 4px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-icon3::after {\r\n        position: absolute;\r\n        top: 3px;\r\n        left: 6px;\r\n        width: 6px;\r\n        height: 10px;\r\n        border-width: 0 2px 2px 0;\r\n        border-color: #4a7;\r\n        border-style: solid;\r\n        -webkit-transform: rotate(45deg);\r\n                transform: rotate(45deg);\r\n        content: '';\n}\n.vue-image-crop-upload .vicp-wrap .vicp-icon2 {\r\n      position: relative;\r\n      display: inline-block;\r\n      width: 20px;\r\n      height: 20px;\r\n      top: 4px;\n}\n.vue-image-crop-upload .vicp-wrap .vicp-icon2::after, .vue-image-crop-upload .vicp-wrap .vicp-icon2::before {\r\n        content: '';\r\n        position: absolute;\r\n        top: 9px;\r\n        left: 4px;\r\n        width: 13px;\r\n        height: 2px;\r\n        background-color: #d10;\r\n        -webkit-transform: rotate(45deg);\r\n                transform: rotate(45deg);\n}\n.vue-image-crop-upload .vicp-wrap .vicp-icon2::after {\r\n        -webkit-transform: rotate(-45deg);\r\n                transform: rotate(-45deg);\n}\n.e-ripple {\r\n  position: absolute;\r\n  border-radius: 100%;\r\n  background-color: rgba(0, 0, 0, 0.15);\r\n  background-clip: padding-box;\r\n  pointer-events: none;\r\n  -webkit-user-select: none;\r\n     -moz-user-select: none;\r\n      -ms-user-select: none;\r\n          user-select: none;\r\n  -webkit-transform: scale(0);\r\n          transform: scale(0);\r\n  opacity: 1;\n}\n.e-ripple.z-active {\r\n    opacity: 0;\r\n    -webkit-transform: scale(2);\r\n            transform: scale(2);\r\n    -webkit-transition: opacity 1.2s ease-out, -webkit-transform 0.6s ease-out;\r\n    transition: opacity 1.2s ease-out, -webkit-transform 0.6s ease-out;\r\n    transition: opacity 1.2s ease-out, transform 0.6s ease-out;\r\n    transition: opacity 1.2s ease-out, transform 0.6s ease-out, -webkit-transform 0.6s ease-out;\n}\r\n\r\n", ""]);

// exports


/***/ }),

/***/ 932:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__utils_language_js__ = __webpack_require__(933);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__utils_mimes_js__ = __webpack_require__(934);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__utils_data2blob_js__ = __webpack_require__(935);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__utils_effectRipple_js__ = __webpack_require__(936);
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



var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };






/* harmony default export */ __webpack_exports__["default"] = ({
	props: {
		// 域，上传文件name，触发事件会带上（如果一个页面多个图片上传控件，可以做区分
		field: {
			type: String,
			'default': 'avatar'
		},
		// 原名key，类似于id，触发事件会带上（如果一个页面多个图片上传控件，可以做区分
		ki: {
			'default': 0
		},
		// 显示该控件与否
		value: {
			'default': true
		},
		// 上传地址
		url: {
			type: String,
			'default': ''
		},
		// 其他要上传文件附带的数据，对象格式
		params: {
			type: Object,
			'default': null
		},
		//Add custom headers
		headers: {
			type: Object,
			'default': null
		},
		// 剪裁图片的宽
		width: {
			type: Number,
			default: 200
		},
		// 剪裁图片的高
		height: {
			type: Number,
			default: 200
		},
		// 不显示旋转功能
		noRotate: {
			type: Boolean,
			default: true
		},
		// 不预览圆形图片
		noCircle: {
			type: Boolean,
			default: false
		},
		// 不预览方形图片
		noSquare: {
			type: Boolean,
			default: false
		},
		// 单文件大小限制
		maxSize: {
			type: Number,
			'default': 10240
		},
		// 语言类型
		langType: {
			type: String,
			'default': 'zh'
		},
		// 语言包
		langExt: {
			type: Object,
			'default': null
		},
		// 图片上传格式
		imgFormat: {
			type: String,
			'default': 'png'
		},
		// 是否支持跨域
		withCredentials: {
			type: Boolean,
			'default': false
		}
	},
	data: function data() {
		var that = this,
		    imgFormat = that.imgFormat,
		    langType = that.langType,
		    langExt = that.langExt,
		    width = that.width,
		    height = that.height,
		    isSupported = true,
		    allowImgFormat = ['jpg', 'png'],
		    tempImgFormat = allowImgFormat.indexOf(imgFormat) === -1 ? 'jpg' : imgFormat,
		    lang = __WEBPACK_IMPORTED_MODULE_0__utils_language_js__["a" /* default */][langType] ? __WEBPACK_IMPORTED_MODULE_0__utils_language_js__["a" /* default */][langType] : __WEBPACK_IMPORTED_MODULE_0__utils_language_js__["a" /* default */]['en'],
		    mime = __WEBPACK_IMPORTED_MODULE_1__utils_mimes_js__["a" /* default */][tempImgFormat];
		// 规范图片格式
		that.imgFormat = tempImgFormat;

		if (langExt) {
			Object.assign(lang, langExt);
		}
		if (typeof FormData != 'function') {
			isSupported = false;
		}
		return {
			// 图片的mime
			mime: mime,

			// 语言包
			lang: lang,

			// 浏览器是否支持该控件
			isSupported: isSupported,
			// 浏览器是否支持触屏事件
			isSupportTouch: document.hasOwnProperty("ontouchstart"),

			// 步骤
			step: 1, //1选择文件 2剪裁 3上传

			// 上传状态及进度
			loading: 0, //0未开始 1正在 2成功 3错误
			progress: 0,

			// 是否有错误及错误信息
			hasError: false,
			errorMsg: '',

			// 需求图宽高比
			ratio: width / height,

			// 原图地址、生成图片地址
			sourceImg: null,
			sourceImgUrl: '',
			createImgUrl: '',

			// 原图片拖动事件初始值
			sourceImgMouseDown: {
				on: false,
				mX: 0, //鼠标按下的坐标
				mY: 0,
				x: 0, //scale原图坐标
				y: 0
			},

			// 生成图片预览的容器大小
			previewContainer: {
				width: 100,
				height: 100
			},

			// 原图容器宽高
			sourceImgContainer: { // sic
				width: 240,
				height: 184 // 如果生成图比例与此一致会出现bug，先改成特殊的格式吧，哈哈哈
			},

			// 原图展示属性
			scale: {
				zoomAddOn: false, //按钮缩放事件开启
				zoomSubOn: false, //按钮缩放事件开启
				range: 1, //最大100

				rotateLeft: false, //按钮向左旋转事件开启
				rotateRight: false, //按钮向右旋转事件开启
				degree: 0, // 旋转度数

				x: 0,
				y: 0,
				width: 0,
				height: 0,
				maxWidth: 0,
				maxHeight: 0,
				minWidth: 0, //最宽
				minHeight: 0,
				naturalWidth: 0, //原宽
				naturalHeight: 0
			}
		};
	},

	computed: {
		// 进度条样式
		progressStyle: function progressStyle() {
			var progress = this.progress;

			return {
				width: progress + '%'
			};
		},

		// 原图样式
		sourceImgStyle: function sourceImgStyle() {
			var scale = this.scale,
			    sourceImgMasking = this.sourceImgMasking,
			    top = scale.y + sourceImgMasking.y + 'px',
			    left = scale.x + sourceImgMasking.x + 'px';

			return {
				top: top,
				left: left,
				width: scale.width + 'px',
				height: scale.height + 'px',
				transform: 'rotate(' + scale.degree + 'deg)', // 旋转时 左侧原始图旋转样式
				'-ms-transform': 'rotate(' + scale.degree + 'deg)', // 兼容IE9
				'-moz-transform': 'rotate(' + scale.degree + 'deg)', // 兼容FireFox
				'-webkit-transform': 'rotate(' + scale.degree + 'deg)', // 兼容Safari 和 chrome
				'-o-transform': 'rotate(' + scale.degree + 'deg)' // 兼容 Opera
			};
		},

		// 原图蒙版属性
		sourceImgMasking: function sourceImgMasking() {
			var width = this.width,
			    height = this.height,
			    ratio = this.ratio,
			    sourceImgContainer = this.sourceImgContainer,
			    sic = sourceImgContainer,
			    sicRatio = sic.width / sic.height,
			    x = 0,
			    y = 0,
			    w = sic.width,
			    h = sic.height,
			    scale = 1;

			if (ratio < sicRatio) {
				scale = sic.height / height;
				w = sic.height * ratio;
				x = (sic.width - w) / 2;
			}
			if (ratio > sicRatio) {
				scale = sic.width / width;
				h = sic.width / ratio;
				y = (sic.height - h) / 2;
			}
			return {
				scale: scale, // 蒙版相对需求宽高的缩放
				x: x,
				y: y,
				width: w,
				height: h
			};
		},

		// 原图遮罩样式
		sourceImgShadeStyle: function sourceImgShadeStyle() {
			var sourceImgMasking = this.sourceImgMasking,
			    sourceImgContainer = this.sourceImgContainer,
			    sic = sourceImgContainer,
			    sim = sourceImgMasking,
			    w = sim.width == sic.width ? sim.width : (sic.width - sim.width) / 2,
			    h = sim.height == sic.height ? sim.height : (sic.height - sim.height) / 2;

			return {
				width: w + 'px',
				height: h + 'px'
			};
		},
		previewStyle: function previewStyle() {
			var width = this.width,
			    height = this.height,
			    ratio = this.ratio,
			    previewContainer = this.previewContainer,
			    pc = previewContainer,
			    w = pc.width,
			    h = pc.height,
			    pcRatio = w / h;

			if (ratio < pcRatio) {
				w = pc.height * ratio;
			}
			if (ratio > pcRatio) {
				h = pc.width / ratio;
			}
			return {
				width: w + 'px',
				height: h + 'px'
			};
		}
	},
	watch: {
		value: function value(newValue) {
			if (newValue && this.loading != 1) {
				this.reset();
			}
		}
	},
	methods: {
		// 点击波纹效果
		ripple: function ripple(e) {
			Object(__WEBPACK_IMPORTED_MODULE_3__utils_effectRipple_js__["a" /* default */])(e);
		},

		// 关闭控件
		off: function off() {
			var _this = this;

			setTimeout(function () {
				_this.$emit('input', false);
				if (_this.step == 3 && _this.loading == 2) {
					_this.setStep(1);
				}
			}, 200);
		},

		// 设置步骤
		setStep: function setStep(no) {
			var _this2 = this;

			// 延时是为了显示动画效果呢，哈哈哈
			setTimeout(function () {
				_this2.step = no;
			}, 200);
		},


		/* 图片选择区域函数绑定
   ---------------------------------------------------------------*/
		preventDefault: function preventDefault(e) {
			e.preventDefault();
			return false;
		},
		handleClick: function handleClick(e) {
			if (this.loading !== 1) {
				if (e.target !== this.$refs.fileinput) {
					e.preventDefault();
					if (document.activeElement !== this.$refs) {
						this.$refs.fileinput.click();
					}
				}
			}
		},
		handleChange: function handleChange(e) {
			e.preventDefault();
			if (this.loading !== 1) {
				var files = e.target.files || e.dataTransfer.files;
				this.reset();
				if (this.checkFile(files[0])) {
					this.setSourceImg(files[0]);
				}
			}
		},

		/* ---------------------------------------------------------------*/

		// 检测选择的文件是否合适
		checkFile: function checkFile(file) {
			var that = this,
			    lang = that.lang,
			    maxSize = that.maxSize;
			// 仅限图片
			if (file.type.indexOf('image') === -1) {
				that.hasError = true;
				that.errorMsg = lang.error.onlyImg;
				return false;
			}

			// 超出大小
			if (file.size / 1024 > maxSize) {
				that.hasError = true;
				that.errorMsg = lang.error.outOfSize + maxSize + 'kb';
				return false;
			}
			return true;
		},

		// 重置控件
		reset: function reset() {
			var that = this;
			that.loading = 0;
			that.hasError = false;
			that.errorMsg = '';
			that.progress = 0;
		},

		// 设置图片源
		setSourceImg: function setSourceImg(file) {
			var that = this,
			    fr = new FileReader();
			fr.onload = function (e) {
				that.sourceImgUrl = fr.result;
				that.startCrop();
			};
			fr.readAsDataURL(file);
		},

		// 剪裁前准备工作
		startCrop: function startCrop() {
			var that = this,
			    width = that.width,
			    height = that.height,
			    ratio = that.ratio,
			    scale = that.scale,
			    sourceImgUrl = that.sourceImgUrl,
			    sourceImgMasking = that.sourceImgMasking,
			    lang = that.lang,
			    sim = sourceImgMasking,
			    img = new Image();

			img.src = sourceImgUrl;
			img.onload = function () {
				var nWidth = img.naturalWidth,
				    nHeight = img.naturalHeight,
				    nRatio = nWidth / nHeight,
				    w = sim.width,
				    h = sim.height,
				    x = 0,
				    y = 0;
				// 图片像素不达标
				if (nWidth < width || nHeight < height) {
					that.hasError = true;
					that.errorMsg = lang.error.lowestPx + width + '*' + height;
					return false;
				}
				if (ratio > nRatio) {
					h = w / nRatio;
					y = (sim.height - h) / 2;
				}
				if (ratio < nRatio) {
					w = h * nRatio;
					x = (sim.width - w) / 2;
				}
				scale.range = 0;
				scale.x = x;
				scale.y = y;
				scale.width = w;
				scale.height = h;
				scale.degree = 0;
				scale.minWidth = w;
				scale.minHeight = h;
				scale.maxWidth = nWidth * sim.scale;
				scale.maxHeight = nHeight * sim.scale;
				scale.naturalWidth = nWidth;
				scale.naturalHeight = nHeight;
				that.sourceImg = img;
				that.createImg();
				that.setStep(2);
			};
		},

		// 鼠标按下图片准备移动
		imgStartMove: function imgStartMove(e) {
			e.preventDefault();
			// 支持触摸事件，则鼠标事件无效
			if (this.isSupportTouch && !e.targetTouches) {
				return false;
			}
			var et = e.targetTouches ? e.targetTouches[0] : e,
			    sourceImgMouseDown = this.sourceImgMouseDown,
			    scale = this.scale,
			    simd = sourceImgMouseDown;

			simd.mX = et.screenX;
			simd.mY = et.screenY;
			simd.x = scale.x;
			simd.y = scale.y;
			simd.on = true;
		},

		// 鼠标按下状态下移动，图片移动
		imgMove: function imgMove(e) {
			e.preventDefault();
			// 支持触摸事件，则鼠标事件无效
			if (this.isSupportTouch && !e.targetTouches) {
				return false;
			}
			var et = e.targetTouches ? e.targetTouches[0] : e,
			    _sourceImgMouseDown = this.sourceImgMouseDown,
			    on = _sourceImgMouseDown.on,
			    mX = _sourceImgMouseDown.mX,
			    mY = _sourceImgMouseDown.mY,
			    x = _sourceImgMouseDown.x,
			    y = _sourceImgMouseDown.y,
			    scale = this.scale,
			    sourceImgMasking = this.sourceImgMasking,
			    sim = sourceImgMasking,
			    nX = et.screenX,
			    nY = et.screenY,
			    dX = nX - mX,
			    dY = nY - mY,
			    rX = x + dX,
			    rY = y + dY;

			if (!on) return;
			if (rX > 0) {
				rX = 0;
			}
			if (rY > 0) {
				rY = 0;
			}
			if (rX < sim.width - scale.width) {
				rX = sim.width - scale.width;
			}
			if (rY < sim.height - scale.height) {
				rY = sim.height - scale.height;
			}
			scale.x = rX;
			scale.y = rY;
		},

		// 按钮按下开始向右旋转
		startRotateRight: function startRotateRight(e) {
			var that = this,
			    scale = that.scale;

			scale.rotateRight = true;
			function rotate() {
				if (scale.rotateRight) {
					var degree = ++scale.degree;
					that.createImg(degree);
					setTimeout(function () {
						rotate();
					}, 60);
				}
			}
			rotate();
		},

		// 按钮按下开始向右旋转
		startRotateLeft: function startRotateLeft(e) {
			var that = this,
			    scale = that.scale;

			scale.rotateLeft = true;
			function rotate() {
				if (scale.rotateLeft) {
					var degree = --scale.degree;
					that.createImg(degree);
					setTimeout(function () {
						rotate();
					}, 60);
				}
			}
			rotate();
		},

		// 停止旋转
		endRotate: function endRotate() {
			var scale = this.scale;

			scale.rotateLeft = false;
			scale.rotateRight = false;
		},

		// 按钮按下开始放大
		startZoomAdd: function startZoomAdd(e) {
			var that = this,
			    scale = that.scale;

			scale.zoomAddOn = true;

			function zoom() {
				if (scale.zoomAddOn) {
					var range = scale.range >= 100 ? 100 : ++scale.range;
					that.zoomImg(range);
					setTimeout(function () {
						zoom();
					}, 60);
				}
			}
			zoom();
		},

		// 按钮松开或移开取消放大
		endZoomAdd: function endZoomAdd(e) {
			this.scale.zoomAddOn = false;
		},

		// 按钮按下开始缩小
		startZoomSub: function startZoomSub(e) {
			var that = this,
			    scale = that.scale;

			scale.zoomSubOn = true;

			function zoom() {
				if (scale.zoomSubOn) {
					var range = scale.range <= 0 ? 0 : --scale.range;
					that.zoomImg(range);
					setTimeout(function () {
						zoom();
					}, 60);
				}
			}
			zoom();
		},

		// 按钮松开或移开取消缩小
		endZoomSub: function endZoomSub(e) {
			var scale = this.scale;

			scale.zoomSubOn = false;
		},
		zoomChange: function zoomChange(e) {
			this.zoomImg(e.target.value);
		},

		// 缩放原图
		zoomImg: function zoomImg(newRange) {
			var that = this,
			    sourceImgMasking = this.sourceImgMasking,
			    sourceImgMouseDown = this.sourceImgMouseDown,
			    scale = this.scale,
			    maxWidth = scale.maxWidth,
			    maxHeight = scale.maxHeight,
			    minWidth = scale.minWidth,
			    minHeight = scale.minHeight,
			    width = scale.width,
			    height = scale.height,
			    x = scale.x,
			    y = scale.y,
			    range = scale.range,
			    sim = sourceImgMasking,
			    sWidth = sim.width,
			    sHeight = sim.height,
			    nWidth = minWidth + (maxWidth - minWidth) * newRange / 100,
			    nHeight = minHeight + (maxHeight - minHeight) * newRange / 100,
			    nX = sWidth / 2 - nWidth / width * (sWidth / 2 - x),
			    nY = sHeight / 2 - nHeight / height * (sHeight / 2 - y);

			// 判断新坐标是否超过蒙版限制
			if (nX > 0) {
				nX = 0;
			}
			if (nY > 0) {
				nY = 0;
			}
			if (nX < sWidth - nWidth) {
				nX = sWidth - nWidth;
			}
			if (nY < sHeight - nHeight) {
				nY = sHeight - nHeight;
			}

			// 赋值处理
			scale.x = nX;
			scale.y = nY;
			scale.width = nWidth;
			scale.height = nHeight;
			scale.range = newRange;
			setTimeout(function () {
				if (scale.range == newRange) {
					that.createImg();
				}
			}, 300);
		},

		// 生成需求图片
		createImg: function createImg(e) {
			var that = this,
			    mime = that.mime,
			    sourceImg = that.sourceImg,
			    _that$scale = that.scale,
			    x = _that$scale.x,
			    y = _that$scale.y,
			    width = _that$scale.width,
			    height = _that$scale.height,
			    degree = _that$scale.degree,
			    scale = that.sourceImgMasking.scale,
			    canvas = that.$refs.canvas,
			    ctx = canvas.getContext('2d');

			if (e) {
				// 取消鼠标按下移动状态
				that.sourceImgMouseDown.on = false;
			}
			canvas.width = that.width;
			canvas.height = that.height;
			ctx.clearRect(0, 0, that.width, that.height);

			// 将透明区域设置为白色底边
			ctx.fillStyle = "#fff";
			ctx.fillRect(0, 0, that.width, that.height);

			ctx.translate(that.width * 0.5, that.height * 0.5);
			ctx.rotate(Math.PI * degree / 180);
			ctx.translate(-that.width * 0.5, -that.height * 0.5);

			ctx.drawImage(sourceImg, x / scale, y / scale, width / scale, height / scale);
			that.createImgUrl = canvas.toDataURL(mime);
		},
		prepareUpload: function prepareUpload() {
			var url = this.url,
			    createImgUrl = this.createImgUrl,
			    field = this.field,
			    ki = this.ki;

			this.$emit('crop-success', createImgUrl, field, ki);
			if (typeof url == 'string' && url) {
				this.upload();
			} else {
				this.off();
			}
		},

		// 上传图片
		upload: function upload() {
			var that = this,
			    lang = this.lang,
			    imgFormat = this.imgFormat,
			    mime = this.mime,
			    url = this.url,
			    params = this.params,
			    headers = this.headers,
			    field = this.field,
			    ki = this.ki,
			    createImgUrl = this.createImgUrl,
			    withCredentials = this.withCredentials,
			    fmData = new FormData();

			fmData.append(field, Object(__WEBPACK_IMPORTED_MODULE_2__utils_data2blob_js__["a" /* default */])(createImgUrl, mime), field + '.' + imgFormat);

			// 添加其他参数
			if ((typeof params === 'undefined' ? 'undefined' : _typeof(params)) == 'object' && params) {
				Object.keys(params).forEach(function (k) {
					fmData.append(k, params[k]);
				});
			}

			// 监听进度回调
			var uploadProgress = function uploadProgress(event) {
				if (event.lengthComputable) {
					that.progress = 100 * Math.round(event.loaded) / event.total;
				}
			};

			// 上传文件
			that.reset();
			that.loading = 1;
			that.setStep(3);
			new Promise(function (resolve, reject) {
				var client = new XMLHttpRequest();
				client.open('POST', url, true);
				client.withCredentials = withCredentials;
				client.onreadystatechange = function () {
					if (this.readyState !== 4) {
						return;
					}
					if (this.status === 200 || this.status === 201) {
						resolve(JSON.parse(this.responseText));
					} else {
						reject(this.status);
					}
				};
				client.upload.addEventListener("progress", uploadProgress, false); //监听进度
				// 设置header
				if ((typeof headers === 'undefined' ? 'undefined' : _typeof(headers)) == 'object' && headers) {
					Object.keys(headers).forEach(function (k) {
						client.setRequestHeader(k, headers[k]);
					});
				}
				client.send(fmData);
			}).then(
			// 上传成功
			function (resData) {
				if (that.value) {
					that.loading = 2;
					that.$emit('crop-upload-success', resData, field, ki);
				}
			},
			// 上传失败
			function (sts) {
				if (that.value) {
					that.loading = 3;
					that.hasError = true;
					that.errorMsg = lang.fail;
					that.$emit('crop-upload-fail', sts, field, ki);
				}
			});
		}
	},
	created: function created() {
		var _this3 = this;

		// 绑定按键esc隐藏此插件事件
		document.addEventListener('keyup', function (e) {
			if (_this3.value && (e.key == 'Escape' || e.keyCode == 27)) {
				_this3.off();
			}
		});
	}
});

/***/ }),

/***/ 933:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony default export */ __webpack_exports__["a"] = ({
	zh: {
		hint: '点击，或拖动图片至此处',
		loading: '正在上传……',
		noSupported: '浏览器不支持该功能，请使用IE10以上或其他现在浏览器！',
		success: '上传成功',
		fail: '图片上传失败',
		preview: '头像预览',
		btn: {
			off: '取消',
			close: '关闭',
			back: '上一步',
			save: '保存'
		},
		error: {
			onlyImg: '仅限图片格式',
			outOfSize: '单文件大小不能超过 ',
			lowestPx: '图片最低像素为（宽*高）：'
		}
	},
	'zh-tw': {
		hint: '點擊，或拖動圖片至此處',
		loading: '正在上傳……',
		noSupported: '瀏覽器不支持該功能，請使用IE10以上或其他現代瀏覽器！',
		success: '上傳成功',
		fail: '圖片上傳失敗',
		preview: '頭像預覽',
		btn: {
			off: '取消',
			close: '關閉',
			back: '上一步',
			save: '保存'
		},
		error: {
			onlyImg: '僅限圖片格式',
			outOfSize: '單文件大小不能超過 ',
			lowestPx: '圖片最低像素為（寬*高）：'
		}
	},
	en: {
		hint: 'Click or drag the file here to upload',
		loading: 'Uploading…',
		noSupported: 'Browser is not supported, please use IE10+ or other browsers',
		success: 'Upload success',
		fail: 'Upload failed',
		preview: 'Preview',
		btn: {
			off: 'Cancel',
			close: 'Close',
			back: 'Back',
			save: 'Save'
		},
		error: {
			onlyImg: 'Image only',
			outOfSize: 'Image exceeds size limit: ',
			lowestPx: 'Image\'s size is too low. Expected at least: '
		}
	},
	ro: {
		hint: 'Atinge sau trage fișierul aici',
		loading: 'Se încarcă',
		noSupported: 'Browser-ul tău nu suportă acest feature. Te rugăm încearcă cu alt browser.',
		success: 'S-a încărcat cu succes',
		fail: 'A apărut o problemă la încărcare',
		preview: 'Previzualizează',

		btn: {
			off: 'Anulează',
			close: 'Închide',
			back: 'Înapoi',
			save: 'Salvează'
		},

		error: {
			onlyImg: 'Doar imagini',
			outOfSize: 'Imaginea depășește limita de: ',
			loewstPx: 'Imaginea este prea mică; Minim: '
		}
	},
	ru: {
		hint: 'Нажмите, или перетащите файл в это окно',
		loading: 'Загружаю……',
		noSupported: 'Ваш браузер не поддерживается, пожалуйста, используйте IE10 + или другие браузеры',
		success: 'Загрузка выполнена успешно',
		fail: 'Ошибка загрузки',
		preview: 'Предпросмотр',
		btn: {
			off: 'Отменить',
			close: 'Закрыть',
			back: 'Назад',
			save: 'Сохранить'
		},
		error: {
			onlyImg: 'Только изображения',
			outOfSize: 'Изображение превышает предельный размер: ',
			lowestPx: 'Минимальный размер изображения: '
		}
	},
	'pt-br': {
		hint: 'Clique ou arraste o arquivo aqui para carregar',
		loading: 'Carregando…',
		noSupported: 'Browser não suportado, use o IE10+ ou outro browser',
		success: 'Sucesso ao carregar imagem',
		fail: 'Falha ao carregar imagem',
		preview: 'Pré-visualizar',
		btn: {
			off: 'Cancelar',
			close: 'Fechar',
			back: 'Voltar',
			save: 'Salvar'
		},
		error: {
			onlyImg: 'Apenas imagens',
			outOfSize: 'A imagem excede o limite de tamanho: ',
			lowestPx: 'O tamanho da imagem é muito pequeno. Tamanho mínimo: '
		}
	},
	fr: {
		hint: 'Cliquez ou glissez le fichier ici.',
		loading: 'Téléchargement…',
		noSupported: 'Votre navigateur n\'est pas supporté. Utilisez IE10 + ou un autre navigateur s\'il vous plaît.',
		success: 'Téléchargement réussit',
		fail: 'Téléchargement echoué',
		preview: 'Aperçu',
		btn: {
			off: 'Annuler',
			close: 'Fermer',
			back: 'Retour',
			save: 'Enregistrer'
		},
		error: {
			onlyImg: 'Image uniquement',
			outOfSize: 'L\'image sélectionnée dépasse la taille maximum: ',
			lowestPx: 'L\'image sélectionnée est trop petite. Dimensions attendues: '
		}
	},
	nl: {
		hint: 'Klik hier of sleep een afbeelding in dit vlak',
		loading: 'Uploaden…',
		noSupported: 'Je browser wordt helaas niet ondersteund. Gebruik IE10+ of een andere browser.',
		success: 'Upload succesvol',
		fail: 'Upload mislukt',
		preview: 'Voorbeeld',
		btn: {
			off: 'Annuleren',
			close: 'Sluiten',
			back: 'Terug',
			save: 'Opslaan'
		},
		error: {
			onlyImg: 'Alleen afbeeldingen',
			outOfSize: 'De afbeelding is groter dan: ',
			lowestPx: 'De afbeelding is te klein! Minimale afmetingen: '
		}
	},
	tr: {
		hint: 'Tıkla veya yüklemek istediğini buraya sürükle',
		loading: 'Yükleniyor…',
		noSupported: 'Tarayıcı desteklenmiyor, lütfen IE10+ veya farklı tarayıcı kullanın',
		success: 'Yükleme başarılı',
		fail: 'Yüklemede hata oluştu',
		preview: 'Önizle',
		btn: {
			off: 'İptal',
			close: 'Kapat',
			back: 'Geri',
			save: 'Kaydet'
		},
		error: {
			onlyImg: 'Sadece resim',
			outOfSize: 'Resim yükleme limitini aşıyor: ',
			lowestPx: 'Resmin boyutu çok küçük. En az olması gereken: '
		}
	},
	'es-MX': {
		hint:'Selecciona o arrastra una imagen',
		loading:'Subiendo...',
		noSupported:'Tu navegador no es soportado, porfavor usa IE10+ u otros navegadores mas recientes',
		success:'Subido exitosamente',
		fail:'Sucedió un error',
		preview:'Vista previa',
		btn:{
			off:'Cancelar',
			close:'Cerrar',
			back:'Atras',
			save:'Guardar'
		},
		error:{
			onlyImg:'Unicamente imagenes',
			outOfSize:'La imagen excede el tamaño maximo:',
			lowestPx:'La imagen es demasiado pequeño. Se espera por lo menos:'
		}
	},
	de: {
		hint: 'Klick hier oder zieh eine Datei hier rein zum Hochladen',
		loading: 'Hochladen…',
		noSupported: 'Browser wird nicht unterstützt, bitte verwende IE10+ oder andere Browser',
		success: 'Upload erfolgreich',
		fail: 'Upload fehlgeschlagen',
		preview: 'Vorschau',
		btn: {
			off: 'Abbrechen',
			close: 'Schließen',
			back: 'Zurück',
			save: 'Speichern'
		},
		error: {
			onlyImg: 'Nur Bilder',
			outOfSize: 'Das Bild ist zu groß: ',
			lowestPx: 'Das Bild ist zu klein. Mindestens: '
		}
	},
	ja: {
		hint: 'クリック・ドラッグしてファイルをアップロード',
		loading: 'アップロード中...',
		noSupported: 'このブラウザは対応されていません。IE10+かその他の主要ブラウザをお使いください。',
		success: 'アップロード成功',
		fail: 'アップロード失敗',
		preview: 'プレビュー',
		btn: {
			off: 'キャンセル',
			close: '閉じる',
			back: '戻る',
			save: '保存'
		},
		error: {
			onlyImg: '画像のみ',
			outOfSize: '画像サイズが上限を超えています。上限: ',
			lowestPx: '画像が小さすぎます。最小サイズ: '
		}
	}
});


/***/ }),

/***/ 934:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony default export */ __webpack_exports__["a"] = ({
    'jpg': 'image/jpeg',
    'png': 'image/png',
    'gif': 'image/gif',
    'svg': 'image/svg+xml',
    'psd': 'image/photoshop'
});


/***/ }),

/***/ 935:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/**
 * database64文件格式转换为2进制
 *
 * @param  {[String]} data dataURL 的格式为 “data:image/png;base64,****”,逗号之前都是一些说明性的文字，我们只需要逗号之后的就行了
 * @param  {[String]} mime [description]
 * @return {[blob]}      [description]
 */
/* harmony default export */ __webpack_exports__["a"] = (function(data, mime) {
	data = data.split(',')[1];
	data = window.atob(data);
	var ia = new Uint8Array(data.length);
	for (var i = 0; i < data.length; i++) {
		ia[i] = data.charCodeAt(i);
	};
	// canvas.toDataURL 返回的默认格式就是 image/png
	return new Blob([ia], {
		type: mime
	});
});;


/***/ }),

/***/ 936:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/**
 * 点击波纹效果
 *
 * @param  {[event]} e        [description]
 * @param  {[Object]} arg_opts [description]
 * @return {[bollean]}          [description]
 */
/* harmony default export */ __webpack_exports__["a"] = (function(e, arg_opts) {
	var opts = Object.assign({
			ele: e.target, // 波纹作用元素
			type: 'hit', // hit点击位置扩散　center中心点扩展
			bgc: 'rgba(0, 0, 0, 0.15)' // 波纹颜色
		}, arg_opts),
		target = opts.ele;
	if (target) {
		var rect = target.getBoundingClientRect(),
			ripple = target.querySelector('.e-ripple');
		if (!ripple) {
			ripple = document.createElement('span');
			ripple.className = 'e-ripple';
			ripple.style.height = ripple.style.width = Math.max(rect.width, rect.height) + 'px';
			target.appendChild(ripple);
		} else {
			ripple.className = 'e-ripple';
		}
		switch (opts.type) {
			case 'center':
				ripple.style.top = (rect.height / 2 - ripple.offsetHeight / 2) + 'px';
				ripple.style.left = (rect.width / 2 - ripple.offsetWidth / 2) + 'px';
				break;
			default:
				ripple.style.top = (e.pageY - rect.top - ripple.offsetHeight / 2 - document.body.scrollTop) + 'px';
				ripple.style.left = (e.pageX - rect.left - ripple.offsetWidth / 2 - document.body.scrollLeft) + 'px';
		}
		ripple.style.backgroundColor = opts.bgc;
		ripple.className = 'e-ripple z-active';
		return false;
	}
});;


/***/ }),

/***/ 937:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      directives: [
        {
          name: "show",
          rawName: "v-show",
          value: _vm.value,
          expression: "value"
        }
      ],
      staticClass: "vue-image-crop-upload"
    },
    [
      _c("div", { staticClass: "vicp-wrap" }, [
        _c("div", { staticClass: "vicp-close", on: { click: _vm.off } }, [
          _c("i", { staticClass: "vicp-icon4" })
        ]),
        _vm._v(" "),
        _c(
          "div",
          {
            directives: [
              {
                name: "show",
                rawName: "v-show",
                value: _vm.step == 1,
                expression: "step == 1"
              }
            ],
            staticClass: "vicp-step1"
          },
          [
            _c(
              "div",
              {
                staticClass: "vicp-drop-area",
                on: {
                  dragleave: _vm.preventDefault,
                  dragover: _vm.preventDefault,
                  dragenter: _vm.preventDefault,
                  click: _vm.handleClick,
                  drop: _vm.handleChange
                }
              },
              [
                _c(
                  "i",
                  {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: _vm.loading != 1,
                        expression: "loading != 1"
                      }
                    ],
                    staticClass: "vicp-icon1"
                  },
                  [
                    _c("i", { staticClass: "vicp-icon1-arrow" }),
                    _vm._v(" "),
                    _c("i", { staticClass: "vicp-icon1-body" }),
                    _vm._v(" "),
                    _c("i", { staticClass: "vicp-icon1-bottom" })
                  ]
                ),
                _vm._v(" "),
                _c(
                  "span",
                  {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: _vm.loading !== 1,
                        expression: "loading !== 1"
                      }
                    ],
                    staticClass: "vicp-hint"
                  },
                  [_vm._v(_vm._s(_vm.lang.hint))]
                ),
                _vm._v(" "),
                _c(
                  "span",
                  {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: !_vm.isSupported,
                        expression: "!isSupported"
                      }
                    ],
                    staticClass: "vicp-no-supported-hint"
                  },
                  [_vm._v(_vm._s(_vm.lang.noSupported))]
                ),
                _vm._v(" "),
                _vm.step == 1
                  ? _c("input", {
                      directives: [
                        {
                          name: "show",
                          rawName: "v-show",
                          value: false,
                          expression: "false"
                        }
                      ],
                      ref: "fileinput",
                      attrs: { type: "file" },
                      on: { change: _vm.handleChange }
                    })
                  : _vm._e()
              ]
            ),
            _vm._v(" "),
            _c(
              "div",
              {
                directives: [
                  {
                    name: "show",
                    rawName: "v-show",
                    value: _vm.hasError,
                    expression: "hasError"
                  }
                ],
                staticClass: "vicp-error"
              },
              [
                _c("i", { staticClass: "vicp-icon2" }),
                _vm._v(" " + _vm._s(_vm.errorMsg) + "\r\n\t\t\t")
              ]
            ),
            _vm._v(" "),
            _c("div", { staticClass: "vicp-operate" }, [
              _c("a", { on: { click: _vm.off, mousedown: _vm.ripple } }, [
                _vm._v(_vm._s(_vm.lang.btn.off))
              ])
            ])
          ]
        ),
        _vm._v(" "),
        _vm.step == 2
          ? _c("div", { staticClass: "vicp-step2" }, [
              _c("div", { staticClass: "vicp-crop" }, [
                _c(
                  "div",
                  {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: true,
                        expression: "true"
                      }
                    ],
                    staticClass: "vicp-crop-left"
                  },
                  [
                    _c("div", { staticClass: "vicp-img-container" }, [
                      _c("img", {
                        ref: "img",
                        staticClass: "vicp-img",
                        style: _vm.sourceImgStyle,
                        attrs: { src: _vm.sourceImgUrl, draggable: "false" },
                        on: {
                          drag: _vm.preventDefault,
                          dragstart: _vm.preventDefault,
                          dragend: _vm.preventDefault,
                          dragleave: _vm.preventDefault,
                          dragover: _vm.preventDefault,
                          dragenter: _vm.preventDefault,
                          drop: _vm.preventDefault,
                          touchstart: _vm.imgStartMove,
                          touchmove: _vm.imgMove,
                          touchend: _vm.createImg,
                          touchcancel: _vm.createImg,
                          mousedown: _vm.imgStartMove,
                          mousemove: _vm.imgMove,
                          mouseup: _vm.createImg,
                          mouseout: _vm.createImg
                        }
                      }),
                      _vm._v(" "),
                      _c("div", {
                        staticClass: "vicp-img-shade vicp-img-shade-1",
                        style: _vm.sourceImgShadeStyle
                      }),
                      _vm._v(" "),
                      _c("div", {
                        staticClass: "vicp-img-shade vicp-img-shade-2",
                        style: _vm.sourceImgShadeStyle
                      })
                    ]),
                    _vm._v(" "),
                    _c("div", { staticClass: "vicp-range" }, [
                      _c("input", {
                        attrs: {
                          type: "range",
                          step: "1",
                          min: "0",
                          max: "100"
                        },
                        domProps: { value: _vm.scale.range },
                        on: { input: _vm.zoomChange }
                      }),
                      _vm._v(" "),
                      _c("i", {
                        staticClass: "vicp-icon5",
                        on: {
                          mousedown: _vm.startZoomSub,
                          mouseout: _vm.endZoomSub,
                          mouseup: _vm.endZoomSub
                        }
                      }),
                      _vm._v(" "),
                      _c("i", {
                        staticClass: "vicp-icon6",
                        on: {
                          mousedown: _vm.startZoomAdd,
                          mouseout: _vm.endZoomAdd,
                          mouseup: _vm.endZoomAdd
                        }
                      })
                    ]),
                    _vm._v(" "),
                    !_vm.noRotate
                      ? _c("div", { staticClass: "vicp-rotate" }, [
                          _c(
                            "i",
                            {
                              on: {
                                mousedown: _vm.startRotateLeft,
                                mouseout: _vm.endRotate,
                                mouseup: _vm.endRotate
                              }
                            },
                            [_vm._v("↺")]
                          ),
                          _vm._v(" "),
                          _c(
                            "i",
                            {
                              on: {
                                mousedown: _vm.startRotateRight,
                                mouseout: _vm.endRotate,
                                mouseup: _vm.endRotate
                              }
                            },
                            [_vm._v("↻")]
                          )
                        ])
                      : _vm._e()
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: true,
                        expression: "true"
                      }
                    ],
                    staticClass: "vicp-crop-right"
                  },
                  [
                    _c("div", { staticClass: "vicp-preview" }, [
                      !_vm.noSquare
                        ? _c("div", { staticClass: "vicp-preview-item" }, [
                            _c("img", {
                              style: _vm.previewStyle,
                              attrs: { src: _vm.createImgUrl }
                            }),
                            _vm._v(" "),
                            _c("span", [_vm._v(_vm._s(_vm.lang.preview))])
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      !_vm.noCircle
                        ? _c(
                            "div",
                            {
                              staticClass:
                                "vicp-preview-item vicp-preview-item-circle"
                            },
                            [
                              _c("img", {
                                style: _vm.previewStyle,
                                attrs: { src: _vm.createImgUrl }
                              }),
                              _vm._v(" "),
                              _c("span", [_vm._v(_vm._s(_vm.lang.preview))])
                            ]
                          )
                        : _vm._e()
                    ])
                  ]
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "vicp-operate" }, [
                _c(
                  "a",
                  {
                    on: {
                      click: function($event) {
                        _vm.setStep(1)
                      },
                      mousedown: _vm.ripple
                    }
                  },
                  [_vm._v(_vm._s(_vm.lang.btn.back))]
                ),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    staticClass: "vicp-operate-btn",
                    on: { click: _vm.prepareUpload, mousedown: _vm.ripple }
                  },
                  [_vm._v(_vm._s(_vm.lang.btn.save))]
                )
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _vm.step == 3
          ? _c("div", { staticClass: "vicp-step3" }, [
              _c("div", { staticClass: "vicp-upload" }, [
                _c(
                  "span",
                  {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: _vm.loading === 1,
                        expression: "loading === 1"
                      }
                    ],
                    staticClass: "vicp-loading"
                  },
                  [_vm._v(_vm._s(_vm.lang.loading))]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "vicp-progress-wrap" }, [
                  _c("span", {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: _vm.loading === 1,
                        expression: "loading === 1"
                      }
                    ],
                    staticClass: "vicp-progress",
                    style: _vm.progressStyle
                  })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: _vm.hasError,
                        expression: "hasError"
                      }
                    ],
                    staticClass: "vicp-error"
                  },
                  [
                    _c("i", { staticClass: "vicp-icon2" }),
                    _vm._v(" " + _vm._s(_vm.errorMsg) + "\r\n\t\t\t\t")
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: _vm.loading === 2,
                        expression: "loading === 2"
                      }
                    ],
                    staticClass: "vicp-success"
                  },
                  [
                    _c("i", { staticClass: "vicp-icon3" }),
                    _vm._v(" " + _vm._s(_vm.lang.success) + "\r\n\t\t\t\t")
                  ]
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "vicp-operate" }, [
                _c(
                  "a",
                  {
                    on: {
                      click: function($event) {
                        _vm.setStep(2)
                      },
                      mousedown: _vm.ripple
                    }
                  },
                  [_vm._v(_vm._s(_vm.lang.btn.back))]
                ),
                _vm._v(" "),
                _c("a", { on: { click: _vm.off, mousedown: _vm.ripple } }, [
                  _vm._v(_vm._s(_vm.lang.btn.close))
                ])
              ])
            ])
          : _vm._e(),
        _vm._v(" "),
        _c("canvas", {
          directives: [
            {
              name: "show",
              rawName: "v-show",
              value: false,
              expression: "false"
            }
          ],
          ref: "canvas",
          attrs: { width: _vm.width, height: _vm.height }
        })
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-25292217", module.exports)
  }
}

/***/ }),

/***/ 938:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(939);
if(typeof content === 'string') content = [[module.i, content, '']];
// Prepare cssTransformation
var transform;

var options = {}
options.transform = transform
// add the styles to the DOM
var update = __webpack_require__(50)(content, options);
if(content.locals) module.exports = content.locals;
// Hot Module Replacement
if(false) {
	// When the styles change, update the <style> tags
	if(!content.locals) {
		module.hot.accept("!!../../../css-loader/index.js!./lightbox.min.css", function() {
			var newContent = require("!!../../../css-loader/index.js!./lightbox.min.css");
			if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
			update(newContent);
		});
	}
	// When the module is disposed, remove the <style> tags
	module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 939:
/***/ (function(module, exports, __webpack_require__) {

var escape = __webpack_require__(81);
exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, ".lb-loader,.lightbox{text-align:center;line-height:0}.lb-dataContainer:after,.lb-outerContainer:after{content:\"\";clear:both}html.lb-disable-scrolling{overflow:hidden;position:fixed;height:100vh;width:100vw}.lightboxOverlay{position:absolute;top:0;left:0;z-index:9999;background-color:#000;filter:alpha(Opacity=80);opacity:.8;display:none}.lightbox{position:absolute;left:0;width:100%;z-index:10000;font-weight:400}.lightbox .lb-image{display:block;height:auto;max-width:inherit;max-height:none;border-radius:3px;border:4px solid #fff}.lightbox a img{border:none}.lb-outerContainer{position:relative;width:250px;height:250px;margin:0 auto;border-radius:4px;background-color:#fff}.lb-loader,.lb-nav{position:absolute;left:0}.lb-outerContainer:after{display:table}.lb-loader{top:43%;height:25%;width:100%}.lb-cancel{display:block;width:32px;height:32px;margin:0 auto;background:url(" + escape(__webpack_require__(940)) + ") no-repeat}.lb-nav{top:0;height:100%;width:100%;z-index:10}.lb-container>.nav{left:0}.lb-nav a{outline:0;background-image:url(data:image/gif;base64,R0lGODlhAQABAPAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==)}.lb-next,.lb-prev{height:100%;cursor:pointer;display:block}.lb-nav a.lb-prev{width:34%;left:0;float:left;background:url(" + escape(__webpack_require__(941)) + ") left 48% no-repeat;filter:alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-prev:hover{filter:alpha(Opacity=100);opacity:1}.lb-nav a.lb-next{width:64%;right:0;float:right;background:url(" + escape(__webpack_require__(942)) + ") right 48% no-repeat;filter:alpha(Opacity=0);opacity:0;-webkit-transition:opacity .6s;-moz-transition:opacity .6s;-o-transition:opacity .6s;transition:opacity .6s}.lb-nav a.lb-next:hover{filter:alpha(Opacity=100);opacity:1}.lb-dataContainer{margin:0 auto;padding-top:5px;width:100%;border-bottom-left-radius:4px;border-bottom-right-radius:4px}.lb-dataContainer:after{display:table}.lb-data{padding:0 4px;color:#ccc}.lb-data .lb-details{width:85%;float:left;text-align:left;line-height:1.1em}.lb-data .lb-caption{font-size:13px;font-weight:700;line-height:1em}.lb-data .lb-caption a{color:#4ae}.lb-data .lb-number{display:block;clear:left;padding-bottom:1em;font-size:12px;color:#999}.lb-data .lb-close{display:block;float:right;width:30px;height:30px;background:url(" + escape(__webpack_require__(943)) + ") top right no-repeat;text-align:right;outline:0;filter:alpha(Opacity=70);opacity:.7;-webkit-transition:opacity .2s;-moz-transition:opacity .2s;-o-transition:opacity .2s;transition:opacity .2s}.lb-data .lb-close:hover{cursor:pointer;filter:alpha(Opacity=100);opacity:1}", ""]);

// exports


/***/ }),

/***/ 940:
/***/ (function(module, exports) {

module.exports = "/images/vendor/lightbox2/dist/loading.gif?2299ad0b3f63413f026dfec20c205b8f";

/***/ }),

/***/ 941:
/***/ (function(module, exports) {

module.exports = "/images/vendor/lightbox2/dist/prev.png?84b76dee6b27b795e89e3649078a11c2";

/***/ }),

/***/ 942:
/***/ (function(module, exports) {

module.exports = "/images/vendor/lightbox2/dist/next.png?31f15875975aab69085470aabbfec802";

/***/ }),

/***/ 943:
/***/ (function(module, exports) {

module.exports = "/images/vendor/lightbox2/dist/close.png?d9d2d0b1308cb694aa8116915592e2a9";

/***/ }),

/***/ 944:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "chatbar", class: { chatWin: _vm.isChatWin } },
    [
      _vm.chatIsTrue
        ? _c("div", { staticClass: "guide", on: { click: _vm.login } }, [
            _c("a", { staticClass: "lnk-min" })
          ])
        : _vm._e(),
      _vm._v(" "),
      !_vm.chatIsTrue
        ? _c("div", { staticClass: "chatwin type-normal" }, [
            _c("div", { staticStyle: { width: "100%", height: "100%" } }, [
              _c(
                "div",
                [
                  _c("div", { staticClass: "chat-header" }, [
                    _c("i", { staticClass: "iconfont icon-home-2" }),
                    _vm._v(" "),
                    _c("span", { staticClass: "title" }, [_vm._v(" 聊天室")]),
                    _vm._v(" "),
                    _c(
                      "span",
                      {
                        staticStyle: {
                          position: "absolute",
                          right: "8px",
                          top: "9px"
                        }
                      },
                      [
                        _c(
                          "a",
                          {
                            attrs: { href: "javascript:void(0)" },
                            on: {
                              click: function($event) {
                                _vm.profile.profileDialog = true
                              }
                            }
                          },
                          [
                            _c("i", {
                              staticClass: "icon iconfont icon-user-manage"
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: { href: "javascript:void(0)" },
                            on: {
                              click: function($event) {
                                _vm.isChatWin = !_vm.isChatWin
                              }
                            }
                          },
                          [
                            _c("i", {
                              staticClass:
                                "icon iconfont icon-quxiaohebingdanyuange"
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: { href: "javascript:void(0)" },
                            on: {
                              click: function($event) {
                                _vm.window.open("https://www.baidu.com")
                              }
                            }
                          },
                          [
                            _c("i", {
                              staticClass: "icon iconfont icon-icon_share"
                            })
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            attrs: { href: "javascript:void(0)" },
                            on: { click: _vm.changeChat }
                          },
                          [_c("i", { staticClass: "icon iconfont icon-close" })]
                        )
                      ]
                    )
                  ]),
                  _vm._v(" "),
                  _c("avatarUpload", {
                    ref: "avatarUpload",
                    attrs: {
                      field: "avatar",
                      width: 100,
                      height: 100,
                      url: "chat/avatarUpload",
                      headers: _vm.profile.headers,
                      "img-format": "png"
                    },
                    on: {
                      "crop-success": _vm.cropSuccess,
                      "crop-upload-success": _vm.cropUploadSuccess,
                      "crop-upload-fail": _vm.cropUploadFail
                    },
                    model: {
                      value: _vm.profile.show,
                      callback: function($$v) {
                        _vm.$set(_vm.profile, "show", $$v)
                      },
                      expression: "profile.show"
                    }
                  }),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      directives: [
                        {
                          name: "show",
                          rawName: "v-show",
                          value: _vm.profile.profileDialog,
                          expression: "profile.profileDialog"
                        }
                      ],
                      staticClass: "profile"
                    },
                    [
                      _c(
                        "div",
                        {
                          staticClass: "inner",
                          staticStyle: { "animation-duration": "0.3s" }
                        },
                        [
                          _c(
                            "div",
                            {
                              staticClass: "avatar",
                              on: {
                                mouseenter: _vm.userAvatarHover,
                                mouseleave: _vm.userAvatarHover
                              }
                            },
                            [
                              _c("img", {
                                attrs: { src: _vm.chatUser.avatar, alt: "" }
                              }),
                              _vm._v(" "),
                              _c(
                                "label",
                                {
                                  directives: [
                                    {
                                      name: "show",
                                      rawName: "v-show",
                                      value: _vm.profile.avatarHover,
                                      expression: "profile.avatarHover"
                                    }
                                  ],
                                  staticClass: "upload-avatar",
                                  attrs: { for: "avatarUploadInput" }
                                },
                                [
                                  _c(
                                    "svg",
                                    {
                                      staticStyle: {
                                        width: "1em",
                                        height: "1em",
                                        "vertical-align": "middle",
                                        fill: "currentcolor",
                                        overflow: "hidden"
                                      },
                                      attrs: {
                                        viewBox: "0 0 1024 1024",
                                        version: "1.1",
                                        xmlns: "http://www.w3.org/2000/svg",
                                        "p-id": "4273"
                                      }
                                    },
                                    [
                                      _c("path", {
                                        attrs: {
                                          d:
                                            "M118.265544 941.074336c-29.634948 0-53.766554-24.131607-53.766554-53.766554L64.49899 493.587652c0-29.634948 10.582009-51.921533 40.216957-51.921533s39.211047 22.285562 39.211047 51.921533l0 368.036167 736.108151 0L880.035144 493.587652c0-29.634948 8.252964-53.766554 37.917588-53.766554 29.634948 0 41.548278 24.131607 41.548278 53.766554l0 393.72013c0 29.635971-24.131607 53.766554-53.766554 53.766554L118.265544 941.074336zM745.824443 316.793086 554.50507 316.793086 554.50507 646.057205c0 29.664623-12.884448 53.795207-42.519396 53.795207-29.634948 0-42.528606-24.131607-42.528606-53.795207L469.457068 316.793086 278.145881 316.793086 511.985674 82.925664 745.824443 316.793086z",
                                          "p-id": "4274"
                                        }
                                      })
                                    ]
                                  ),
                                  _vm._v(" "),
                                  _c("input", {
                                    staticStyle: {
                                      width: "0.1px",
                                      height: "0.1px",
                                      opacity: "0",
                                      top: "-20px"
                                    },
                                    attrs: {
                                      type: "file",
                                      id: "avatarUploadInput",
                                      accept:
                                        ".jpg, .png, .gif, .jpeg, image/jpeg, image/png, image/gif"
                                    },
                                    on: { change: _vm.userAvatarUpload }
                                  })
                                ]
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "p",
                            {
                              staticStyle: {
                                "font-size": "12px",
                                color: "rgb(255, 127, 77)"
                              }
                            },
                            [_vm._v("(您还未设置头像, 请点击头像上传)")]
                          ),
                          _vm._v(" "),
                          _c("p", [
                            _c("span", { staticClass: "txt-nick" }, [
                              _vm._v("wr***00")
                            ]),
                            _vm._v(" "),
                            _c(
                              "a",
                              {
                                staticStyle: { "font-size": "20px" },
                                attrs: { href: "javascript:void(0)" },
                                on: { click: _vm.userNick }
                              },
                              [
                                _c(
                                  "svg",
                                  {
                                    staticStyle: {
                                      width: "1em",
                                      height: "1em",
                                      "vertical-align": "middle",
                                      fill: "currentcolor",
                                      overflow: "hidden"
                                    },
                                    attrs: {
                                      viewBox: "0 0 1024 1024",
                                      version: "1.1",
                                      xmlns: "http://www.w3.org/2000/svg",
                                      "p-id": "848"
                                    }
                                  },
                                  [
                                    _c("path", {
                                      attrs: {
                                        d:
                                          "M662.118 199.375s39.353-36.134 41.693-38.476c2.342-2.34 53.545-47.254 119.23 5.852 15.8 13.75 81.047 77.097 49.594 134.885-8.192 12.142-15.8 18.433-53.106 55.446-7.461-7.461-157.414-157.706-157.414-157.706zM598.041 262.283l157.267 157.703-355.352 357.692-31.891 28.381s-11.849 13.021-45.498 25.895c-33.647 13.021-82.656 31.308-140.442 44.182-16.531 2.34-46.084 7.606-42.426-30.137 3.51-37.744 27.796-102.697 41.256-144.538 17.116-39.502 30.136-51.35 54.275-76.658 24.284-25.311 362.809-362.518 362.809-362.518zM650.707 803.719h75.487v74.317h-75.487v-74.317zM496.951 803.719h75.488v74.317h-75.488v-74.317zM804.462 803.719h75.489v74.317h-75.489v-74.317z",
                                        "p-id": "849"
                                      }
                                    })
                                  ]
                                )
                              ]
                            )
                          ]),
                          _vm._v(" "),
                          _c("p", [
                            _c(
                              "a",
                              {
                                staticClass: "u-btn1",
                                attrs: { href: "javascript:void(0)" },
                                on: {
                                  click: function($event) {
                                    _vm.profile.profileDialog = false
                                  }
                                }
                              },
                              [_vm._v("关闭")]
                            )
                          ])
                        ]
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c("div", { staticClass: "center" }, [
                    _c(
                      "div",
                      { ref: "content", attrs: { id: "content" } },
                      _vm._l(_vm.items, function(item, index) {
                        return _c("div", { key: index }, [
                          item.type === "chat-system" &&
                          item.schedule === "pk10"
                            ? _c(
                                "div",
                                {
                                  directives: [
                                    {
                                      name: "show",
                                      rawName: "v-show",
                                      value: _vm.schedule_type.schedule_pk10,
                                      expression: "schedule_type.schedule_pk10"
                                    }
                                  ],
                                  staticClass: "item type-left"
                                },
                                [
                                  _vm._m(0, true),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "msg-content" }, [
                                    _c(
                                      "div",
                                      { staticClass: "content-header" },
                                      [
                                        _c("h4", [_vm._v("计划消息")]),
                                        _vm._v(" "),
                                        _c(
                                          "span",
                                          { staticClass: "content-time" },
                                          [
                                            _vm._v(
                                              "\n                                " +
                                                _vm._s(item.date) +
                                                "\n                            "
                                            )
                                          ]
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("div", {
                                      staticClass: "Bubble type-system",
                                      domProps: {
                                        innerHTML: _vm._s(item.content)
                                      }
                                    })
                                  ])
                                ]
                              )
                            : _vm._e(),
                          _vm._v(" "),
                          item.type === "chat-system" &&
                          item.schedule === "cqssc"
                            ? _c(
                                "div",
                                {
                                  directives: [
                                    {
                                      name: "show",
                                      rawName: "v-show",
                                      value: _vm.schedule_type.schedule_cqssc,
                                      expression: "schedule_type.schedule_cqssc"
                                    }
                                  ],
                                  staticClass: "item type-left"
                                },
                                [
                                  _vm._m(1, true),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "msg-content" }, [
                                    _c(
                                      "div",
                                      { staticClass: "content-header" },
                                      [
                                        _c("h4", [_vm._v("计划消息")]),
                                        _vm._v(" "),
                                        _c(
                                          "span",
                                          { staticClass: "content-time" },
                                          [
                                            _vm._v(
                                              "\n                                " +
                                                _vm._s(item.date) +
                                                "\n                            "
                                            )
                                          ]
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("div", {
                                      staticClass: "Bubble type-system",
                                      domProps: {
                                        innerHTML: _vm._s(item.content)
                                      }
                                    })
                                  ])
                                ]
                              )
                            : _vm._e(),
                          _vm._v(" "),
                          item.type === "chat-system" &&
                          item.schedule === "mssc"
                            ? _c(
                                "div",
                                {
                                  directives: [
                                    {
                                      name: "show",
                                      rawName: "v-show",
                                      value: _vm.schedule_type.schedule_mssc,
                                      expression: "schedule_type.schedule_mssc"
                                    }
                                  ],
                                  staticClass: "item type-left"
                                },
                                [
                                  _vm._m(2, true),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "msg-content" }, [
                                    _c(
                                      "div",
                                      { staticClass: "content-header" },
                                      [
                                        _c("h4", [_vm._v("计划消息")]),
                                        _vm._v(" "),
                                        _c(
                                          "span",
                                          { staticClass: "content-time" },
                                          [
                                            _vm._v(
                                              "\n                                " +
                                                _vm._s(item.date) +
                                                "\n                            "
                                            )
                                          ]
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c("div", {
                                      staticClass: "Bubble type-system",
                                      domProps: {
                                        innerHTML: _vm._s(item.content)
                                      }
                                    })
                                  ])
                                ]
                              )
                            : item.type === "chat-packet"
                              ? _c("div", { staticClass: "item type-left" }, [
                                  _vm._m(3, true),
                                  _vm._v(" "),
                                  _c("div", { staticClass: "msg-content" }, [
                                    _c(
                                      "div",
                                      { staticClass: "content-header" },
                                      [
                                        _c(
                                          "h4",
                                          {
                                            staticStyle: {
                                              color: "rgb(245, 0, 0)"
                                            }
                                          },
                                          [_vm._v("新红包")]
                                        ),
                                        _vm._v(" "),
                                        _c(
                                          "span",
                                          { staticClass: "content-time" },
                                          [_vm._v(_vm._s(item.date))]
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "div",
                                      {
                                        staticClass: "Bubble type-system",
                                        staticStyle: {
                                          background: "rgb(253, 85, 85)",
                                          "border-right-color":
                                            "rgb(253, 85, 85)"
                                        }
                                      },
                                      [
                                        _c(
                                          "div",
                                          {
                                            staticClass: "RedPack desc",
                                            staticStyle: {
                                              "text-align": "center"
                                            }
                                          },
                                          [
                                            _c("p", [
                                              _vm._v("机会难得，别错过哦！")
                                            ]),
                                            _vm._v(" "),
                                            _c(
                                              "a",
                                              {
                                                staticClass: "RBtn txt-t5",
                                                attrs: {
                                                  href: "javascript:void(0)"
                                                },
                                                on: {
                                                  click: function($event) {
                                                    _vm.showPacket(item.id)
                                                  }
                                                }
                                              },
                                              [
                                                _vm._v(
                                                  "\n                                                拆开看看\n                                            "
                                                )
                                              ]
                                            )
                                          ]
                                        )
                                      ]
                                    )
                                  ])
                                ])
                              : item.type === "SysMsg"
                                ? _c("div", { staticClass: "SysMsg" }, [
                                    _vm._m(4, true)
                                  ])
                                : item.type === "UserNickSysMsg"
                                  ? _c("div", { staticClass: "SysMsg" }, [
                                      _c(
                                        "div",
                                        {
                                          staticClass: "inner Txt type-warning"
                                        },
                                        [
                                          _c("p", [
                                            _c("i", {
                                              staticClass:
                                                "iconfont icon-icwarming"
                                            }),
                                            _vm._v(
                                              "\n                                        您尚未设置昵称, 点击\n                                        "
                                            ),
                                            _c(
                                              "a",
                                              {
                                                staticStyle: {
                                                  color: "rgb(25, 158, 216)"
                                                },
                                                attrs: {
                                                  href: "javascript:void(0)"
                                                },
                                                on: { click: _vm.userNick }
                                              },
                                              [_vm._v("这里")]
                                            ),
                                            _vm._v(
                                              "\n                                        设置\n                                    "
                                            )
                                          ]),
                                          _vm._v(" "),
                                          _c("p", [
                                            _vm._v(
                                              "昵称设置过后将无法再次更改哦"
                                            )
                                          ])
                                        ]
                                      )
                                    ])
                                  : item.type === "UserAvatarSysMsg"
                                    ? _c("div", { staticClass: "SysMsg" }, [
                                        _c(
                                          "div",
                                          {
                                            staticClass:
                                              "inner Txt type-warning"
                                          },
                                          [
                                            _c("p", [
                                              _c("i", {
                                                staticClass:
                                                  "iconfont icon-icwarming"
                                              }),
                                              _vm._v(
                                                "\n                                        您可以上传自己的头像啦,点击\n                                        "
                                              ),
                                              _c(
                                                "a",
                                                {
                                                  staticStyle: {
                                                    color: "rgb(25, 158, 216)"
                                                  },
                                                  attrs: {
                                                    href: "javascript:void(0)"
                                                  },
                                                  on: {
                                                    click: function($event) {
                                                      _vm.profile.profileDialog = true
                                                    }
                                                  }
                                                },
                                                [_vm._v("这里")]
                                              ),
                                              _vm._v(
                                                "\n                                        设置\n                                    "
                                              )
                                            ])
                                          ]
                                        )
                                      ])
                                    : item.type === "msg"
                                      ? _c(
                                          "div",
                                          {
                                            staticClass: "item ",
                                            class: {
                                              "type-left": item.type_left,
                                              "type-right": item.type_right
                                            }
                                          },
                                          [
                                            _c(
                                              "div",
                                              { staticClass: "avatar" },
                                              [
                                                _c("img", {
                                                  attrs: {
                                                    src: item.imgSrc,
                                                    alt: ""
                                                  }
                                                })
                                              ]
                                            ),
                                            _vm._v(" "),
                                            _c(
                                              "div",
                                              { staticClass: "msg-content" },
                                              [
                                                _c(
                                                  "div",
                                                  {
                                                    staticClass:
                                                      "content-header"
                                                  },
                                                  [
                                                    _c("h4", [
                                                      _vm._v(_vm._s(item.name))
                                                    ]),
                                                    _vm._v(" "),
                                                    _c(
                                                      "span",
                                                      {
                                                        staticStyle: {
                                                          "margin-top":
                                                            "15px !important"
                                                        }
                                                      },
                                                      [
                                                        _c("img", {
                                                          attrs: {
                                                            src: item.levelSrc,
                                                            alt: ""
                                                          }
                                                        })
                                                      ]
                                                    ),
                                                    _vm._v(" "),
                                                    _c(
                                                      "span",
                                                      {
                                                        staticClass:
                                                          "content-time",
                                                        staticStyle: {
                                                          "margin-top":
                                                            "15px !important"
                                                        }
                                                      },
                                                      [
                                                        _vm._v(
                                                          "\n                                            " +
                                                            _vm._s(item.date) +
                                                            "\n                                      "
                                                        )
                                                      ]
                                                    )
                                                  ]
                                                ),
                                                _vm._v(" "),
                                                _c(
                                                  "div",
                                                  { staticClass: "Bubble" },
                                                  [
                                                    item.sendSrc
                                                      ? _c("p", [
                                                          _c(
                                                            "a",
                                                            {
                                                              attrs: {
                                                                href:
                                                                  item.sendSrc,
                                                                "data-lightbox": index,
                                                                "data-title": ""
                                                              }
                                                            },
                                                            [
                                                              _c("img", {
                                                                attrs: {
                                                                  width: "200",
                                                                  src:
                                                                    item.sendSrc
                                                                }
                                                              })
                                                            ]
                                                          )
                                                        ])
                                                      : _vm._e(),
                                                    _vm._v(" "),
                                                    _c("span", {
                                                      domProps: {
                                                        innerHTML: _vm._s(
                                                          item.content
                                                        )
                                                      }
                                                    })
                                                  ]
                                                )
                                              ]
                                            )
                                          ]
                                        )
                                      : _vm._e()
                        ])
                      })
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "controls", staticStyle: { top: "73px" } },
                      [
                        _c(
                          "a",
                          {
                            staticClass: "ListCtrl active",
                            attrs: { href: "javascript:void(0)" },
                            on: { click: _vm.scroll }
                          },
                          [
                            _c("i", {
                              staticClass:
                                "icon iconfont icon-zhishikuguanli zhishikuguanli"
                            }),
                            _vm._v(
                              "\n                            滚屏\n                        "
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "a",
                          {
                            staticClass: "ListCtrl",
                            attrs: { href: "javascript:void(0)" },
                            on: { click: _vm.clean }
                          },
                          [
                            _c("i", {
                              staticClass: "icon iconfont icon-lajitong"
                            }),
                            _vm._v(
                              "\n                            清屏\n                        "
                            )
                          ]
                        )
                      ]
                    ),
                    _vm._v(" "),
                    _c("div", { staticClass: "announce" }, [
                      _vm._m(5),
                      _vm._v(" "),
                      _c(
                        "div",
                        { staticClass: "scroll" },
                        [
                          _c("marquee", { attrs: { scrollamount: "3" } }, [
                            _c(
                              "ol",
                              _vm._l(_vm.bullets, function(bullet, index) {
                                return _c("li", [_vm._v(_vm._s(bullet))])
                              })
                            )
                          ])
                        ],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        staticClass: "compose",
                        class: { left_5: _vm.isChatWin }
                      },
                      [
                        _c(
                          "div",
                          { staticClass: "control-bar" },
                          [
                            _c(
                              "el-popover",
                              {
                                ref: "emoji_popover",
                                attrs: {
                                  placement: "top-start",
                                  width: "204",
                                  trigger: "click"
                                }
                              },
                              [
                                _c("div", [
                                  _c(
                                    "div",
                                    { staticClass: "emoji-container" },
                                    _vm._l(_vm.emojis, function(item, index) {
                                      return _c("i", {
                                        class: _vm.emojiClass(item.class),
                                        on: {
                                          click: function($event) {
                                            _vm.emoji(item.emoji_u)
                                          }
                                        }
                                      })
                                    })
                                  )
                                ])
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "el-button",
                              {
                                directives: [
                                  {
                                    name: "popover",
                                    rawName: "v-popover:emoji_popover",
                                    arg: "emoji_popover"
                                  }
                                ],
                                staticClass: "btn-control",
                                attrs: { disabled: !_vm.platcfg.is_open }
                              },
                              [
                                _c("i", {
                                  staticClass: "icon iconfont icon-biaoqing"
                                })
                              ]
                            ),
                            _vm._v(" "),
                            _c("label", { attrs: { for: "imgUploadInput" } }, [
                              _c(
                                "span",
                                {
                                  staticClass: "btn-control",
                                  attrs: { title: "上传图片" }
                                },
                                [
                                  _c("i", {
                                    staticClass: "icon iconfont icon-img"
                                  }),
                                  _vm._v(" "),
                                  _c("input", {
                                    staticStyle: {
                                      width: "0.1px",
                                      height: "0.1px",
                                      opacity: "0",
                                      position: "absolute",
                                      top: "0",
                                      left: "50px"
                                    },
                                    attrs: {
                                      id: "imgUploadInput",
                                      disabled: !_vm.platcfg.is_open,
                                      type: "file",
                                      accept:
                                        ".jpg, .png, .gif, .jpeg, image/jpeg, image/png, image/gif"
                                    },
                                    on: { change: _vm.upload }
                                  })
                                ]
                              )
                            ]),
                            _vm._v(" "),
                            _c(
                              "el-popover",
                              {
                                ref: "schedule_popover",
                                attrs: {
                                  placement: "top-start",
                                  trigger: "click"
                                }
                              },
                              [
                                _c(
                                  "div",
                                  { staticStyle: { "margin-top": "5px" } },
                                  [
                                    _c(
                                      "el-checkbox-group",
                                      {
                                        attrs: { size: "small" },
                                        on: {
                                          change:
                                            _vm.handleCheckedScheduleChange
                                        },
                                        model: {
                                          value: _vm.checkedSchedule,
                                          callback: function($$v) {
                                            _vm.checkedSchedule = $$v
                                          },
                                          expression: "checkedSchedule"
                                        }
                                      },
                                      _vm._l(_vm.schedules, function(
                                        schedule,
                                        index
                                      ) {
                                        return _c(
                                          "el-checkbox",
                                          {
                                            key: index,
                                            attrs: {
                                              border: "",
                                              label: schedule
                                            }
                                          },
                                          [_vm._v(_vm._s(schedule))]
                                        )
                                      })
                                    )
                                  ],
                                  1
                                )
                              ]
                            ),
                            _vm._v(" "),
                            _c(
                              "el-button",
                              {
                                directives: [
                                  {
                                    name: "popover",
                                    rawName: "v-popover:schedule_popover",
                                    arg: "schedule_popover"
                                  }
                                ],
                                staticClass: "btn-control",
                                attrs: { disabled: !_vm.platcfg.is_open }
                              },
                              [_vm._v("计划")]
                            )
                          ],
                          1
                        ),
                        _vm._v(" "),
                        _c("div", { staticClass: "typing" }, [
                          _c("div", { staticClass: "txtinput el-textarea " }, [
                            _c("textarea", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.message,
                                  expression: "message"
                                }
                              ],
                              staticClass: "el-textarea__inner",
                              staticStyle: { height: "54px" },
                              attrs: {
                                disabled: !_vm.platcfg.is_open,
                                placeholder:
                                  "发言条件：前两天充值不少于10元；打码量不少于10元",
                                type: "textarea",
                                rows: "2",
                                autocomplete: "off"
                              },
                              domProps: { value: _vm.message },
                              on: {
                                keyup: function($event) {
                                  if (
                                    !("button" in $event) &&
                                    _vm._k(
                                      $event.keyCode,
                                      "enter",
                                      13,
                                      $event.key,
                                      "Enter"
                                    )
                                  ) {
                                    return null
                                  }
                                  $event.preventDefault()
                                  _vm.enterSend($event)
                                },
                                paste: _vm.paste,
                                input: function($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.message = $event.target.value
                                }
                              }
                            })
                          ]),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "sendbtn", on: { click: _vm.send } },
                            [
                              _c(
                                "a",
                                {
                                  staticClass: "u-btn1",
                                  attrs: { href: "javascript:void(0)" }
                                },
                                [_vm._v("发送")]
                              )
                            ]
                          )
                        ]),
                        _vm._v(" "),
                        _vm._m(6)
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "dialog" },
                      [
                        _c(
                          "el-dialog",
                          {
                            attrs: {
                              title: "发送图片",
                              "before-close": _vm.dialogHandleClose,
                              visible: _vm.sendImgVisible,
                              "modal-append-to-body": false
                            },
                            on: {
                              "update:visible": function($event) {
                                _vm.sendImgVisible = $event
                              }
                            }
                          },
                          [
                            _c(
                              "el-form",
                              { attrs: { model: _vm.form } },
                              [
                                _c("el-form-item", [
                                  _c("p", { staticClass: "tc" }, [
                                    _c("img", {
                                      attrs: { src: _vm.form.imgUrl, alt: "" }
                                    })
                                  ])
                                ]),
                                _vm._v(" "),
                                _c("el-form-item", [
                                  _c(
                                    "p",
                                    { staticClass: "tc" },
                                    [
                                      _c("el-input", {
                                        attrs: {
                                          autofocus: "",
                                          "auto-complete": "off",
                                          placeholder: "图片附言"
                                        },
                                        model: {
                                          value: _vm.form.note,
                                          callback: function($$v) {
                                            _vm.$set(_vm.form, "note", $$v)
                                          },
                                          expression: "form.note"
                                        }
                                      })
                                    ],
                                    1
                                  )
                                ])
                              ],
                              1
                            ),
                            _vm._v(" "),
                            _c("p", { staticClass: "tc sendbtn" }, [
                              _c(
                                "a",
                                {
                                  staticClass: "u-btn1",
                                  attrs: { href: "javascript:void(0)" },
                                  on: { click: _vm.sendImg }
                                },
                                [_vm._v("发送")]
                              )
                            ])
                          ],
                          1
                        )
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      {
                        directives: [
                          {
                            name: "show",
                            rawName: "v-show",
                            value: _vm.showPacketDialog,
                            expression: "showPacketDialog"
                          }
                        ],
                        staticStyle: { display: "block" },
                        attrs: { id: "packet" }
                      },
                      [
                        _c("div", { staticClass: "money" }),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass: "redPack",
                            class: { disnone: _vm.redPackDisNone }
                          },
                          [
                            _vm._m(7),
                            _vm._v(" "),
                            _c(
                              "div",
                              {
                                staticClass: "sticker",
                                on: { click: _vm.getPacket }
                              },
                              [_c("span", [_vm._v("拆红包")])]
                            )
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "div",
                          {
                            staticClass: "open",
                            class: { disblo: _vm.redPackDisNone }
                          },
                          [
                            _c("p", [
                              _vm._v("恭喜您中了" + _vm._s(_vm.packet_money))
                            ])
                          ]
                        )
                      ]
                    )
                  ])
                ],
                1
              )
            ])
          ])
        : _vm._e()
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "avatar" }, [
      _c("img", { attrs: { src: "/chat/imgs/sys.png", alt: "" } })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "avatar" }, [
      _c("img", { attrs: { src: "/chat/imgs/sys.png", alt: "" } })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "avatar" }, [
      _c("img", { attrs: { src: "/chat/imgs/sys.png", alt: "" } })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "avatar" }, [
      _c("img", { attrs: { src: "/chat/imgs/packavatar.jpg", alt: "" } })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "inner" }, [
      _c("p", [_vm._v("以上是历史消息")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "ttl" }, [
      _c("i", { staticClass: "iconfont icon-gonggao" }),
      _vm._v("\n                            公告:\n                        ")
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      { staticClass: "el-dialog__wrapper", staticStyle: { display: "none" } },
      [
        _c(
          "div",
          {
            staticClass: "el-dialog el-dialog--small chat-send-image",
            staticStyle: { top: "15%" }
          },
          [
            _c("div", { staticClass: "el-dialog__header" }, [
              _c("span", { staticClass: "el-dialog__title" }, [
                _vm._v("发送图片")
              ]),
              _vm._v(" "),
              _c(
                "button",
                {
                  staticClass: "el-dialog__headerbtn",
                  attrs: { type: "button", "aria-label": "Close" }
                },
                [
                  _c("i", {
                    staticClass: "el-dialog__close el-icon el-icon-close"
                  })
                ]
              )
            ])
          ]
        )
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "cover" }, [
      _c("p", [_vm._v("恭喜發財 大吉大利")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-98f7d2cc", module.exports)
  }
}

/***/ }),

/***/ 945:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(946)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = __webpack_require__(948)
/* template */
var __vue_template__ = __webpack_require__(949)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-21fe053c"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/common/modalbox/ModalBox.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-21fe053c", Component.options)
  } else {
    hotAPI.reload("data-v-21fe053c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 946:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(947);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("4c1d77fc", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21fe053c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ModalBox.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21fe053c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ModalBox.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 947:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n/* 公用样式和模态框样式 */\n*[data-v-21fe053c] {\n  margin: 0;\n  padding: 0;\n}\nbody[data-v-21fe053c] {\n  font: 12px/1.5 \"\\5FAE\\8F6F\\96C5\\9ED1\", \"\\5B8B\\4F53\", Arial, Helvetica,\n    sans-serif;\n  overflow-y: hidden;\n}\n.main-body[data-v-21fe053c] {\n  position: absolute;\n  overflow-x: auto;\n  top: 0;\n  left: 0;\n  right: 0;\n  bottom: 30px;\n}\na[data-v-21fe053c] {\n  text-decoration: none;\n}\n.notice-wrap[data-v-21fe053c] {\n  position: fixed;\n  width: 100%;\n  height: 100%;\n  z-index: 101;\n}\n.notice-wrap .bg[data-v-21fe053c] {\n  position: absolute;\n  left: 50%;\n  top: 50%;\n  border-radius: 5px;\n  z-index: 999;\n}\n.notice-wrap .mask[data-v-21fe053c] {\n  background: #000;\n  opacity: 0.5;\n  position: absolute;\n  top: 0;\n  left: 0;\n  width: 100%;\n  height: 100%;\n  display: block;\n}\n.notice-wrap .notice-icon[data-v-21fe053c] {\n  display: block;\n  width: 155px;\n  height: 137px;\n  background: url(\"/static/game/images/modalbox/notice_icon.png\");\n  background-position: -161px -14px;\n  padding-bottom: 8px;\n}\n.notice-wrap .more-btn[data-v-21fe053c],\n.notice-wrap .notice-btn[data-v-21fe053c] {\n  display: block;\n  border-radius: 3px;\n  font-size: 14px;\n  text-align: center;\n  transition: all 0.1s;\n  -webkit-transition: all 0.1s;\n}\n.notice-wrap .more-btn[data-v-21fe053c]:active,\n.notice-wrap .notice-btn[data-v-21fe053c]:active {\n  border-bottom: none;\n  transform: translate(0, 3px);\n  -webkit-transform: translate(0, 3px);\n}\n.notice-wrap .notice-btn[data-v-21fe053c] {\n  display: block;\n  color: #fff;\n  padding: 10px 6px;\n  border-bottom: 5px solid #d18922;\n  background-color: #fec436;\n}\n.notice-wrap .more-btn[data-v-21fe053c] {\n  display: inline-block;\n  color: red;\n  padding: 0 8px;\n  border-bottom: 3px solid #ccc;\n  font-size: 12px;\n  background-color: #fff;\n}\n.notice-wrap .notice-pager[data-v-21fe053c] {\n  text-align: center;\n  font-size: 14px;\n  color: #fff;\n}\n.notice-wrap .notice-pager a[data-v-21fe053c] {\n  color: #fff;\n}\n.notice-wrap .notice-pager .indicator[data-v-21fe053c] {\n  display: inline-block;\n  padding: 2px 15px;\n}\n.notice-wrap .notice-content[data-v-21fe053c] {\n  line-height: 1.6;\n  color: #fff;\n  font-size: 13px;\n  max-height: 300px;\n  overflow-y: scroll;\n}\n.notice-wrap .notice-content[data-v-21fe053c]::-webkit-scrollbar {\n  width: 10px;\n}\n.notice-wrap .notice-content p[data-v-21fe053c] {\n  white-space: pre-wrap;\n  word-break: break-all;\n  text-align: left;\n}\n.notice-wrap .lay-important[data-v-21fe053c] {\n  width: 300px;\n  min-height: 300px;\n  margin: -210px 0 0 -200px;\n}\n.notice-wrap .lay-important .lay-content[data-v-21fe053c] {\n  padding: 10px 20px;\n  margin: 0 10px;\n  text-align: center;\n}\n.notice-wrap .lay-important .lay-notice-icon[data-v-21fe053c] {\n  width: 155px;\n  padding-top: 20px;\n  margin: 0 auto;\n  position: relative;\n}\n.notice-wrap .lay-important .more-btn[data-v-21fe053c] {\n  position: absolute;\n  right: -28px;\n  top: 105px;\n}\n.notice-wrap .lay-notice-btn[data-v-21fe053c] {\n  width: 150px;\n  margin: 20px auto 0;\n  padding-bottom: 20px;\n}\n.notice-wrap .close-btn[data-v-21fe053c] {\n  width: 14px;\n  height: 16px;\n  position: absolute;\n  right: 8px;\n  top: 0;\n  color: #fff;\n  font-weight: 700;\n  cursor: pointer;\n}\n.notice-wrap .close-btn a[data-v-21fe053c] {\n  display: block;\n  color: #fff;\n  padding: 5px;\n}\n.skin_blue .notice-wrap .bg[data-v-21fe053c] {\n  background: #1e5799;\n  background: -webkit-gradient(\n    linear,\n    left top, left bottom,\n    color-stop(0, rgba(30, 87, 153, 1)),\n    color-stop(0, rgba(0, 219, 255, 1)),\n    to(rgba(0, 165, 255, 1))\n  );\n  background: linear-gradient(\n    to bottom,\n    rgba(30, 87, 153, 1) 0,\n    rgba(0, 219, 255, 1) 0,\n    rgba(0, 165, 255, 1) 100%\n  );\n}\n\n/* 更多信息样式 */\n.notice-wrap li[data-v-21fe053c]:not(:last-child) {\n    border-bottom: 1px solid rgba(255,255,255,.71);\n}\n.notice-wrap li[data-v-21fe053c] {\n    padding: 10px 0;\n    font-size: 14px;\n}\nh3[data-v-21fe053c] {\n    display: block;\n    font-size: 1.17em;\n    -webkit-margin-before: 1em;\n    -webkit-margin-after: 1em;\n    -webkit-margin-start: 0px;\n    -webkit-margin-end: 0px;\n    font-weight: bold;\n\tfont-size: 100%;\n}\np[data-v-21fe053c] {\n    display: block;\n    -webkit-margin-before: 1em;\n    -webkit-margin-after: 1em;\n    -webkit-margin-start: 0px;\n    -webkit-margin-end: 0px;\n}\n.notice-wrap .lay-list[data-v-21fe053c] {\n\twidth: 600px;\n\theight: 330px;\n\tmargin: -180px 0 0 -300px\n}\n.notice-wrap .lay-list .notice-icon[data-v-21fe053c] {\n\tbackground-position: -5px 0;\n\theight: 142px\n}\n.notice-wrap .lay-list .lay-notice-icon[data-v-21fe053c] {\n\twidth: 155px;\n\tpadding-top: 60px;\n\tmargin-right: 20px;\n\tfloat: left;\n\tmargin-left: 20px\n}\n.notice-wrap .lay-list .lay-content[data-v-21fe053c] {\n\toverflow-y: auto;\n\toverflow-x: hidden;\n\theight: 280px;\n\tmargin-top: 26px;\n\tmargin-right: 20px\n}\n\n", ""]);

// exports


/***/ }),

/***/ 948:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
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

// import { mapGetters } from 'vuex'


/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      page: 1,
      maxPage: 3,
      minPage: 1,
      isTrue: true,
      //    allMsg: ["【通知】：如需人工微信入款请添加最新收款微信号：【we238665】谢谢！在线支付微信扫码100-5000恢复交易 由于交易流程更改 如下，1、扫码之前登陆微信，打开收付款，2、点击查看付款码数字，并记下数字。3、打开仁信微信扫码，扫码后出跳出支付页面，输入数字确认即可，（注意：记下付码数字后必需在一分钟内支付，否则会支付无效，要重新生成付款码)", "尊敬的会员您好！支付宝扫码入款【财付通 *晓】通道已经开启，扫码付款时需要备注支付宝认证姓名以便财务核实入款，感谢您的支持，谢谢！", "尊敬的会员您好！【万象更新;年年如意。岁岁平安;财源广进。富贵吉祥;幸福安康。福禄满门;喜气洋洋】值此新春佳节到来之际、爱彩娱乐团队祝您在新的一年里：鸿运当头、一路长虹、2018[發][發][發]！"],
      currMsg: null,
      ModelBoole: true,
      // 获取模态框
      modalMessage: {
        messageArr: []
      }
    };
  },

  methods: {
    gb: function gb() {
      this.isTrue = false;
    },

    // 关闭模态框
    last: function last() {
      if (this.page > this.minPage) {
        this.page--;
      }
      // this.currMsg = this.allMsg[this.page - 1];
    },
    next: function next() {
      if (this.page < this.maxPage) {
        this.page++;
      } else {
        this.isTrue = false;
      }
      // this.currMsg = this.allMsg[this.page - 1];
    },
    ModelShow: function ModelShow() {
      this.ModelBoole = !this.ModelBoole;
    },

    // 获取公告数据同时算出公告的个数
    getModalMessageFromStatic: function getModalMessageFromStatic() {
      var count = 0;
      var _this = this;
      window.axios.get('/static/messages.js').then(function (response) {
        // 获取数据,要用双引号将数据包起来，才能
        var str = response.data;
        var ModalMessageArr = JSON.parse(str.slice(15, -1));
        var step = 0;
        // 将第二种消息压入有数据
        if (step === 0) {
          for (var item in ModalMessageArr.type_4) {

            count++;

            _this.modalMessage.messageArr.push(ModalMessageArr.type_4[item]);
          }
          step++;
        }
        // 将第一种消息压入有数据
        if (step === 1) {
          for (var _item in ModalMessageArr.type_2) {
            count++;
            _this.modalMessage.messageArr.push(ModalMessageArr.type_2[_item]);
          }
          step++;
        }
        if (step === 2) {
          _this.maxPage = count;
        }
      });
    }
  },
  mounted: function mounted() {
    this.getModalMessageFromStatic();
  },

  computed: {
    modalMessageArrComputed: function modalMessageArrComputed() {
      var emptyArr = [];
      for (var item in this.modalMessage.messageArr) {
        emptyArr.push(this.modalMessage.messageArr[item].message);
      }
      return emptyArr;
    }
  }
});

/***/ }),

/***/ 949:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _vm.isTrue
      ? _c("div", { staticClass: "notice-wrap" }, [
          _c("div", { staticClass: "mask" }),
          _vm._v(" "),
          _vm.ModelBoole
            ? _c("div", { staticClass: "bg lay-important" }, [
                _c(
                  "div",
                  { staticClass: "close-btn", on: { click: _vm.next } },
                  [
                    _c("a", { attrs: { href: "javascript:void(0)" } }, [
                      _vm._v("X")
                    ])
                  ]
                ),
                _vm._v(" "),
                _c("div", { staticClass: "notice-pager" }, [
                  _c(
                    "a",
                    {
                      attrs: { href: "javascript:void(0)" },
                      on: { click: _vm.last }
                    },
                    [_vm._v("<<")]
                  ),
                  _vm._v(" "),
                  _c("span", { staticClass: "indicator" }, [
                    _vm._v(_vm._s(_vm.page) + "/" + _vm._s(_vm.maxPage))
                  ]),
                  _vm._v(" "),
                  _c(
                    "a",
                    {
                      attrs: { href: "javascript:void(0)" },
                      on: { click: _vm.next }
                    },
                    [_vm._v(">>")]
                  )
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "lay-notice-icon" }, [
                  _c("i", { staticClass: "notice-icon" }),
                  _vm._v(" "),
                  _c(
                    "a",
                    {
                      staticClass: "more-btn",
                      attrs: { href: "javascript:void(0)" },
                      on: { click: _vm.ModelShow }
                    },
                    [_vm._v("更多")]
                  )
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "notice-content lay-content" }, [
                  _c("p", [
                    _vm._v(_vm._s(_vm.modalMessageArrComputed[this.page - 1]))
                  ])
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "lay-notice-btn" }, [
                  _c(
                    "a",
                    {
                      staticClass: "notice-btn",
                      attrs: { href: "javascript:void(0)" },
                      on: { click: _vm.next }
                    },
                    [_vm._v("我知道了")]
                  )
                ])
              ])
            : _vm._e(),
          _vm._v(" "),
          !_vm.ModelBoole
            ? _c("div", { staticClass: "bg lay-list" }, [
                _c("div", { staticClass: "close-btn" }, [
                  _c(
                    "a",
                    {
                      attrs: { href: "javascript:void(0)" },
                      on: { click: _vm.gb }
                    },
                    [_vm._v("X")]
                  )
                ]),
                _vm._v(" "),
                _vm._m(0),
                _vm._v(" "),
                _c("div", { staticClass: "notice-content lay-content" }, [
                  _c(
                    "ul",
                    _vm._l(_vm.modalMessage.messageArr, function(item) {
                      return _c("li", [
                        _c("h3", [_vm._v(_vm._s(item.title))]),
                        _vm._v(" "),
                        _c("p", [_vm._v(_vm._s(item.updateTime))]),
                        _vm._v(" "),
                        _c("p", [_vm._v(_vm._s(item.message))])
                      ])
                    })
                  )
                ])
              ])
            : _vm._e()
        ])
      : _vm._e()
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "lay-notice-icon" }, [
      _c("i", { staticClass: "notice-icon" })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-21fe053c", module.exports)
  }
}

/***/ }),

/***/ 950:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "main-body",
      class: _vm.skin_color,
      staticStyle: { right: "0px" }
    },
    [
      _c(
        "div",
        { staticClass: "header" },
        [
          _c("header-top", { on: { "child-info-for-skin": _vm.getSkin } }),
          _vm._v(" "),
          _c("header-middle", {
            on: { "child-info-for-header-bottom": _vm.get }
          }),
          _vm._v(" "),
          _c(_vm.headerBottom, { tag: "component" })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "main-wrap" },
        [
          _c("sider-bar"),
          _vm._v(" "),
          _c("div", { staticClass: "content-wrap" }, [
            _c("div", { staticClass: "content" }, [
              _c(
                "div",
                { staticClass: "sub-wrap clearfix" },
                [
                  _c("router-view"),
                  _vm._v(" "),
                  this.contSiderShow ? _c("ContSider") : _vm._e()
                ],
                1
              )
            ])
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c("ChatBar"),
      _vm._v(" "),
      _c("FooterNotice"),
      _vm._v(" "),
      _c("modal-box")
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-2549acb8", module.exports)
  }
}

/***/ }),

/***/ 951:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(952)
}
var normalizeComponent = __webpack_require__(9)
/* script */
var __vue_script__ = null
/* template */
var __vue_template__ = __webpack_require__(954)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = "data-v-3a458b7c"
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/common/loading/Loading.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3a458b7c", Component.options)
  } else {
    hotAPI.reload("data-v-3a458b7c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 952:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(953);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(12)("08b95400", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3a458b7c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Loading.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3a458b7c\",\"scoped\":true,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Loading.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ 953:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(5)(false);
// imports


// module
exports.push([module.i, "\n.bet-loading[data-v-3a458b7c] {\n\tmargin: 10px auto;\n}\n.spinner[data-v-3a458b7c] {\n\twidth: 62px;\n\theight: 30px;\n\tdisplay: inline-block;\n\t/*background: rgba(255, 255, 255, 0.85);*/\n\tbackground: rgba(255, 255, 255, 0);\n\tpadding: 10px 50px 0;\n}\n.spinner .three-bounce[data-v-3a458b7c] {\n\tposition: relative;\n\ttext-align: center;\n\ttop: 50%;\n\tbottom: 50%;\n\tmargin-top: -9px;\n}\n.spinner .three-bounce .one[data-v-3a458b7c] {\n\t-webkit-animation-delay: -.32s;\n\tanimation-delay: -.32s;\n\tbackground: rgb(55,137,250);\n}\n.spinner .three-bounce>div[data-v-3a458b7c] {\n\tdisplay: inline-block;\n\twidth: 18px;\n\theight: 18px;\n\tborder-radius: 100%;\n\ttop: 50%;\n\tmargin-top: -9px;\n\tbackground: #aeadba;\n\t-webkit-animation: bouncedelay-data-v-3a458b7c 1.4s infinite ease-in-out;\n\tanimation: bouncedelay-data-v-3a458b7c 1.4s infinite ease-in-out;\n\t-webkit-animation-fill-mode: both;\n\tanimation-fill-mode: both;\n}\n@-webkit-keyframes bouncedelay-data-v-3a458b7c {\n0%, 100%, 80% {\n\t\ttransform: scale(0);\n\t\t-webkit-transform: scale(0);\n}\n40% {\n\t\ttransform: scale(1);\n\t\t-webkit-transform: scale(1);\n}\n}\n@keyframes bouncedelay-data-v-3a458b7c {\n0%, 100%, 80% {\n\t\ttransform: scale(0);\n\t\t-webkit-transform: scale(0);\n}\n40% {\n\t\ttransform: scale(1);\n\t\t-webkit-transform: scale(1);\n}\n}\n.spinner .three-bounce .two[data-v-3a458b7c] {\n\t-webkit-animation-delay: -.16s;\n\tanimation-delay: -.16s;\n\tbackground: rgb(99,99,99)\n}\n.spinner .three-bounce .three[data-v-3a458b7c] {\n\tbackground: rgb(235,67,70);\n}\n", ""]);

// exports


/***/ }),

/***/ 954:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "bet-loading",
        staticStyle: {
          position: "fixed",
          width: "100%",
          top: "200px",
          "text-align": "center",
          "z-index": "3000",
          display: "block"
        },
        attrs: { id: "appLoading" }
      },
      [
        _c("div", { staticClass: "spinner" }, [
          _c("div", { staticClass: "three-bounce" }, [
            _c("div", { staticClass: "one" }),
            _vm._v(" "),
            _c("div", { staticClass: "two" }),
            _vm._v(" "),
            _c("div", { staticClass: "three" })
          ])
        ])
      ]
    )
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3a458b7c", module.exports)
  }
}

/***/ }),

/***/ 955:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "div",
        { staticStyle: { position: "absolute", top: "30%" } },
        [
          _c("Loading", {
            directives: [
              {
                name: "show",
                rawName: "v-show",
                value: _vm.loading,
                expression: "loading"
              }
            ]
          })
        ],
        1
      ),
      _vm._v(" "),
      _c("mainBodyOuter")
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-2beefe62", module.exports)
  }
}

/***/ })

});