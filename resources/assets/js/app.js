
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vue from 'vue'
import App from './App.vue'
import router from './router/index.js'
import stores from './store'

import jwtToken from './helpers/jwt'
import VueCookie from 'vue-cookie'

//全局性的样式在 resources/views/app.blade.php中引入



import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(ElementUI);
Vue.use(VueCookie);

import '../icon/iconfont.css';

import './../../../public/static/game/css/base.css' // 为game引入全局性的样式

import './../../../public/static/game/css/skin.css' // 为换肤引入全局性的样式


// Vue.component('example-component', require('./components/ExampleComponent.vue'));

const socket     = require('socket.io-client')(':6003');
Vue.prototype.socket = socket;




const app = new Vue({
    el: '#app',
    router,
    store:stores,
    render:h=>h(App)
});
