<template>
    <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Order Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <router-link :to="{name: 'today-order'}">Today's Orders</router-link>
                        </li>
                        <li class="breadcrumb-item active">
                            <router-link to="#">Order's Details</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order's Details</h4>
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
                                        <th>Order No</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>SubTotal</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(order, index) in searchFilter" :key="order.id">
                                        <td scope="row">{{ index+1 }}</td>
                                        <td>{{ order.order_id }}</td>
                                        <td>{{ order.products[0].product_name }}</td>
                                        <td>{{ order.product_quantity }}</td>
                                        <td>{{ order.product_price }}</td>
                                        <td>{{ order.sub_total }}</td>
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
        data() {
            return {
                orders: [],
                searchWord: '',
            }
        },
        created() {
            this.getOrder();
        },
        computed: {
            searchFilter() {
                if(this.orders.length>0){
                return this.orders.filter(order => {
                    return (
                        order.products[0].product_name.match(this.searchWord) || order.order_id.match(this.searchWord) || order.sub_total.match(this.searchWord) 
                    );
                })
                }
            }
        },
        methods: {
            getOrder(){
                let id = this.$route.params.id;
                axios.get(`/api/orders/details/${id}`)
                .then(res => {
                    this.orders = res.data;
                    // console.log(this.orders[0].products[0].product_image);
                })
                .catch(err => console.log(err.response.data));
            }
    }
}
</script>

<style>
    #em_photo {
        width: 40px;
        height: 40px;
    }
</style>