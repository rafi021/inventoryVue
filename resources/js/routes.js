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
// Category Menu Route Start
let store_category = require('./pages/category/create.vue').default;
let edit_category = require('./pages/category/edit.vue').default;
let index_category = require('./pages/category/index.vue').default;
// Category Menu Route End
// Product Menu Route Start
let store_product = require('./pages/product/create.vue').default;
let edit_product = require('./pages/product/edit.vue').default;
let index_product = require('./pages/product/index.vue').default;
// Product Menu Route End
// Expense Menu Route Start
let store_expense = require('./pages/expense/create.vue').default;
let edit_expense = require('./pages/expense/edit.vue').default;
let index_expense = require('./pages/expense/index.vue').default;
// Expense Menu Route End
// Salary Menu Route Start
// let store_salary = require('./pages/salary/create.vue').default;
let edit_salary = require('./pages/salary/edit.vue').default;
let index_salary = require('./pages/salary/index.vue').default;
let given_salary = require('./pages/salary/all_employee.vue').default;
let pay_salary = require('./pages/salary/create.vue').default;
let view_salary = require('./pages/salary/view.vue').default;
// Salary Menu Route End
// Stock Menu Route Start
let index_stock = require('./pages/product/stock.vue').default;
// Stock Menu Route End
// Customer Menu Route Start
let store_customer = require('./pages/customer/create.vue').default;
let edit_customer = require('./pages/customer/edit.vue').default;
let index_customer = require('./pages/customer/index.vue').default;
// Customer Menu Route End
// POS Menu Route Start
let index_pos = require('./pages/pos/index.vue').default;
// POS Menu Route Start


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
    // Product Menu Route List Start
    {path: '/store/product', component: store_product, name: 'store-product'},
    {path: '/edit/product/:id', component: edit_product, name: 'edit-product'},
    {path: '/product', component: index_product, name: 'index-product'},
    // Product Menu Route List End
    // Expense Menu Route List Start
    {path: '/store/expense', component: store_expense, name: 'store-expense'},
    {path: '/edit/expense/:id', component: edit_expense, name: 'edit-expense'},
    {path: '/expense', component: index_expense, name: 'index-expense'},
    // Expense Menu Route List End
    // Salary Menu Route List Start
    {path: '/pay-salary/:id', component: pay_salary, name: 'pay-salary'},
    {path: '/given-salary', component: given_salary, name: 'given-salary'},
    {path: '/salary', component: index_salary, name: 'index-salary'},
    {path: '/salary/edit/:id', component: edit_salary, name: 'edit-salary'},
    {path: '/salary/details/:id', component: view_salary, name: 'view-salary'},
    // Salary Menu Route List End
    // Stock Menu Routes List Start
    {path: '/stock', component: index_stock, name: 'stock'},
    // Stock Menu Routes List End
     //Customer Menu Route List Start
    { path: '/store/customer', component: store_customer, name: 'store-customer'},
    { path: '/edit/customer/:id', component: edit_customer, name: 'edit-customer'},
    { path: '/customer', component: index_customer, name: 'index-customer'},
    //Customer Menu Route List End
    //POS Menu Route List Start
    {path: '/pos', component: index_pos, name: 'pos'},
    //POS Menu Route List End
];
