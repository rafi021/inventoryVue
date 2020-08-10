
require('./bootstrap');

//window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

// Router import
import {routes} from './routes';

const router = new VueRouter({
    mode: 'history',
    routes,
}); 

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
