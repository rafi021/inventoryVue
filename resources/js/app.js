
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

// Import Global Classes
import User from './helpers/User';
window.User = User;

// Sweet Alert Start
import Swal from 'sweetalert2';
window.Swal =  Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;
// Sweet Alert End

// Notification Start
import Notification from './helpers/Notification';
window.Notification = Notification;
// Notification End

const app = new Vue({
    el: '#app',
    router,
});
