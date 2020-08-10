let login = require('./pages/auth/login.vue').default;
let register = require('./pages/auth/register.vue').default;
let forget = require('./pages/auth/forget.vue').default;

// import login from './pages/auth/login.vue';
//import register from './pages/auth/register.vue';


export const routes = [
    {
        path: '/login', 
        component: login, 
        name: 'login'
    },
    {
        path: '/register', 
        component: register, 
        name: 'register'
    },
    {
        path: '/forget/password', 
        component: forget, 
        name: 'forget-password'
    }
];
