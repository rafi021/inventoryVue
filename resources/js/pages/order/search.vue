<template>
    <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Order Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item"><router-link :to="{name: 'index-order'}">All Order</router-link>
                        </li>
                        <li class="breadcrumb-item active"><router-link to="#">Order Search</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order Search</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" @submit.prevent="searchDate">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-label-group">
                                                <input type="date" id="search-date" class="form-control"
                                                    placeholder="Search Date" name="search_date" v-model="date">
                                                    <small class="text-danger" v-if="errors.date">{{ errors.date[0] }}</small>
                                                <label for="search-date">Search Date</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                            <button type="reset"
                                                class="btn btn-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row match-height" id="table-bordered" v-if="orders.length">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List of Search Orders</h4>
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
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Pay Amount</th>
                                        <th>Due Amount</th>
                                        <th>Payment Method</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(order, index) in searchFilter" :key="order.id">
                                        <td scope="row">{{ index+1 }}</td>
                                        <td>{{ order.customer.name }}</td>
                                        <td>{{ order.total }}</td>
                                        <td>{{ order.due_amount }}</td>
                                        <td>{{ order.payment_method }}</td>
                                        <td>
                                            <router-link :to="{name: 'view-order', params: { id: order.id } }"
                                                class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light">
                                                <i class="feather icon-eye"></i></router-link>
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
</template>

<script>
    export default {
        created() {
            if (!User.isLoggedIn()) {
                this.$router.push({ name: 'login' })
            }
        },
        data() {
            return {
                date: {},
                orders: {},
                errors: {},
                searchWord: '',
            }
        },
        computed: {
            searchFilter() {
                if(this.orders.length>0){
                return this.orders.filter(order => {
                    return (
                        order.customer.name.match(this.searchWord) || order.total.match(this.searchWord) || order.payment_method.match(this.searchWord) 
                    );
                })
                }
            }
        },
        methods: {
            searchDate(){
                let data = {
                    date: this.date,
                };    
                axios.post('/api/order/search', data)
                .then(res => {
                    // console.log(res);
                    this.orders = res.data.orders;
                    //this.$router.push({ name: 'index-order' });
                    Notification.success();
                })
                .catch(err => {
                this.errors = err.response.data.errors;
                Toast.fire({
                    icon: 'warning',
                    title: 'Invalid data input!!!'
                });
                })
            },
        }
    }
</script>

<style>

</style>