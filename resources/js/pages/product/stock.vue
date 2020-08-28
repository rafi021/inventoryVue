<template>
    <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Product Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <router-link :to="{name: 'store-product'}">Add Product</router-link>
                        </li>
                        <li class="breadcrumb-item active">
                            <router-link to="#">List of Product</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List of Product</h4>
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

</template>

<script>
    export default {
        data() {
            return {
                products: [],
                searchWord: '',
            }
        },
        created() {
            // if (!User.isLoggedIn()) {
            //           this.$router.push({ name: 'login' })
            // }
            axios.get('/api/product')
                .then(res => {
                    //console.log(res)
                    this.products = res.data;
                })
                .catch(err => console.log(err.response.data));
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
        methods: {

    }
}
</script>

<style>
    #em_photo {
        width: 40px;
        height: 40px;
    }
</style>