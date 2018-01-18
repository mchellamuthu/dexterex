require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import router from './routes';
Vue.component('example-component', require('./components/ExampleComponent.vue'));
const app = new Vue({
    el: '#app',
    router
});
Vue.config.devtools = true;
