// Start of Authentication
let login = require('./pages/auth/login.vue').default;
let register = require('./pages/auth/register.vue').default;
let forget = require('./pages/auth/forget.vue').default;
let logout = require('./pages/auth/logout.vue').default;
// End of Authentication

// Dashboard Page Start
let dashboard = require('./pages/dashboard/dashboard.vue').default;

// Dashboard Page End
// Employee Menu Route Start
let store_employee = require('./pages/employee/create.vue').default;
let edit_employee = require('./pages/employee/edit.vue').default;
let index_employee = require('./pages/employee/index.vue').default;
// Employee Menu Route End
// Supplier Menu Route Start
let store_supplier = require('./pages/supplier/create.vue').default;
let edit_supplier = require('./pages/supplier/edit.vue').default;
let index_supplier = require('./pages/supplier/index.vue').default;
// Supplier Menu Route End
// Category Meny Route Start
let store_category = require('./pages/category/create.vue').default;
let edit_category = require('./pages/category/edit.vue').default;
let index_category = require('./pages/category/index.vue').default;
// Category Meny Route End




export const routes = [
    { path: '/login', component: login, name: 'login' },
    { path: '/register', component: register, name: 'register' },
    { path: '/forget/password', component: forget, name: 'forget-password' },
    { path: '/logout', component: logout, name: 'logout' },
    { path: '/dashboard', component: dashboard, name: 'dashboard'},
    //Employee Menu Route List Start
    { path: '/store/employee', component: store_employee, name: 'store-employee'},
    { path: '/edit/employee/:id', component: edit_employee, name: 'edit-employee'},
    { path: '/employee', component: index_employee, name: 'index-employee'},
    //Employee Menu Route List End
    //Supplier Menu Route List Start
    { path: '/store/supplier', component: store_supplier, name: 'store-supplier'},
    { path: '/edit/supplier/:id', component: edit_supplier, name: 'edit-supplier'},
    { path: '/supplier', component: index_supplier, name: 'index-supplier'},
    //Supplier Menu Route List End
    // Category Menu Route List Start
    {path: '/store/category', component: store_category, name: 'store-category'},
    {path: '/edit/category/:id', component: edit_category, name: 'edit-category'},
    {path: '/category', component: index_category, name: 'index-category'},
    // Category Menu Route List End
];
