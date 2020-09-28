import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}


import Vue from 'vue';

import VueRouter from 'vue-router';

import Toasted from 'vue-toasted';

Vue.use(Toasted);
Vue.use(VueRouter);


import routes from './router'



Vue.component('navigation', require('./components/Navigation.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#lern',
    router: new VueRouter(routes),
});
