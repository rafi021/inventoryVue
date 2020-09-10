<template>
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-shopping-cart text-primary font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700" v-if="todaysSell">{{ todaysSell }}k</h2>
                            <h2 class="text-bold-700" v-else>0</h2>
                            <p class="mb-0 line-ellipsis">Today's Orders</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-credit-card text-success font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700" v-if="todaysEarnings">{{ todaysEarnings }}k</h2>
                            <h2 class="text-bold-700" v-else>0</h2>
                            <p class="mb-0 line-ellipsis">Today's Earnings</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-shopping-bag text-danger font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700" v-if="todaysDue">{{ todaysDue }}k</h2>
                            <h2 class="text-bold-700" v-else>0</h2>
                            <p class="mb-0 line-ellipsis">Today's Due</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                                <div class="avatar-content">
                                    <i class="feather icon-package text-warning font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700" v-if="todaysExpense">{{ todaysExpense }}k</h2>
                            <h2 class="text-bold-700" v-else>0</h2>
                            <p class="mb-0 line-ellipsis">Today's Expense</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row match-height" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Stock of Products</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="DataTables_Table_0_length">
                                        <label>Show
                                            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                                class="custom-select custom-select-sm form-control form-control">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                            entries</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <label>Search:
                                            <input type="search" class="form-control form-control-sm"
                                                placeholder="Search here..." aria-controls="DataTables_Table_0"
                                                v-model="searchWord">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover-animation mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Category & Supplier Name</th>
                                        <th>Status</th>
                                        <th>Product Quantity</th>
                                        <th>Buying Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(product, index) in searchFilter" :key="product.id">
                                        <td scope="row">{{ index+1 }}</td>
                                        <td>
                                            <img :src="product.product_image" id="em_photo" alt="">
                                        </td>
                                        <td>{{ product.product_name }}</td>
                                        <td>{{ product.product_code }}</td>
                                        <td>{{ product.category.categoryname }}/ {{ product.supplier.name }} ({{ product.supplier.shopname }})</td>
                                        <td v-if="product.product_quantity > product.alert_quantity"><span class="badge badge-success">Available</span></td>
                                        <td v-else><span class="badge badge-danger">Stock Out</span></td>
                                        <td>{{ product.product_quantity }}</td>
                                        <td>{{ product.buying_date }}</td>
                                        <td>
                                            <router-link :to="{name: 'edit-product', params: { id: product.id } }"
                                                class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light">
                                                <i class="feather icon-edit"></i></router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Analytics end -->

</template>

<script>
    export default {
        created() {
            if (!User.isLoggedIn()) {
                this.$router.push({ name: 'login' })
            }
        },
        mounted() {
            this.TodaySell();
            this.getAllProductWithStock();
        },
        computed: {
            searchFilter() {
                if(this.products.length>0){
                return this.products.filter(product => {
                    return (
                        product.product_name.match(this.searchWord) || product.product_code.match(this.searchWord) || product.category.categoryname.match(this.searchWord) 
                    );
                })
                }
            }
        },
        data() {
            return {
                todaysDue: '',
                todaysEarnings: '',
                todaysSell: '',
                todaysExpense: '',
                income: '',
                due: '',
                expense: '',
                errors: {},
                products: [],
                searchWord: '',
            }
        },
        methods: {
            TodaySell() {
                axios.get('/api/dashboard')
                    .then(res => {
                        console.log(res.data);
                        this.todaysSell = (res.data.todaysSell / 1000);
                        this.totalEarnings = (res.data.totalEarnings / 1000);
                        this.totalDue = (res.data.totalDue / 1000);
                        this.todaysExpense = (res.data.todaysExpense / 1000);
                        this.todaysEarnings = (res.data.todaysEarnings / 1000);
                    })
                    .catch(err => this.errors = err.response.data.errors);
            },
            getAllProductWithStock(){
                axios.get('/api/product')
                .then(res => {
                    //console.log(res)
                    this.products = res.data;
                })
                .catch(err => console.log(err.response.data));
            }
        },

    }
</script>

<style>

</style>