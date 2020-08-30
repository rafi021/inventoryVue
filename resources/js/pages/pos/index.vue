<template>
    <section id="pos">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title">Expense Insert</h4>
                        <a class="btn btn-sm btn-info text-white" href="">Add Customer</a>
                    </div>
                    <hr />
                    <div class="card-content">
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-hover-animation mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Unit</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(product) in searchFilter" :key="product.id">
                                                <td>{{ product.product_name }}</td>
                                                <td>Qty</td>
                                                <td>Unit</td>
                                                <td>Total</td>
                                                <td>
                                                    <a @click="deleteProduct(product.id)"
                                                        class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light">
                                                        <i class="feather icon-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                        <table class="table table-borderless table-hover-animation mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>Total Quantity</th>
                                                    <td>100</td>
                                                </tr>
                                                <tr>
                                                    <th>SubTotal</th>
                                                    <td>114000 USD</td>
                                                </tr>
                                                <tr>
                                                    <th>DISCOUNT (5%)</th>
                                                    <td>5700 USD</td>
                                                </tr>
                                                <tr>
                                                    <th>VAT (5%)</th>
                                                    <td>5700 USD</td>
                                                </tr>
                                                <tr>
                                                    <th>TOTAL</th>
                                                    <td>108300 USD</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                                <div class="card-body">
                                        <form class="form form-vertical" @submit.prevent="paymentMethod">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="customer-name-vertical">Customer Name</label>
                                                            <select name="" id="" class="form-control" v-model="customer_id">
                                                                <option value="">Mahmud</option>
                                                                <option value="">Ibrahim</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="pay-id-vertical">Pay</label>
                                                            <input type="text" id="pay-id-vertical" class="form-control" name="pay-id" placeholder="pay" required v-model="pay">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="due-id-vertical">Due</label>
                                                            <input type="text" id="due-id-vertical" class="form-control" name="due-id" placeholder="due" required v-model="due">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="payment-method">Payment Method</label>
                                                            <select name="" id="" class="form-control" v-model="customer_id">
                                                                <option value="cash">Cash</option>
                                                                <option value="cheque">Cheque</option>
                                                                <option value="giftcard">Gift Card</option>
                                                                <option value="creditcard">Credit Card</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                                        <button type="reset" class="btn btn-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h4 class="card-title mb-2">Product List</h4>
                        <br />
                        <hr />
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="allproduct-tab" data-toggle="tab" href="#allproduct"
                                    role="tab" aria-controls="allproduct" aria-selected="true">All Product</a>
                            </li>
                            <li class="nav-item" v-for="category in categories" :key="category.id">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false"
                                    @click="subProduct(category.id)">{{ category.categoryname }}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="allproduct" role="tabpanel"
                                aria-labelledby="allproduct-tab">
                                <input type="text" v-model="searchWord" class="form-control"
                                    placeholder="Search Product" />
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-4" v-for="product in searchFilter"
                                        :key="product.id">
                                        <a href="">
                                            <div class="card">
                                                <div class="card-content">
                                                    <img class="card-img-top img-fluid" :src="
                                                            product.product_image
                                                        " alt="Card image cap" />
                                                    <div class="card-body text-center">
                                                        <h4 class="card-title">{{ product.product_name }}
                                                        </h4>
                                                        <span class="badge badge-success" v-if="
                                                                product.product_quantity >
                                                                    product.alert_quantity
                                                            ">Available</span>
                                                        <span class="badge badge-danger" v-else>Stock Out</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <input type="text" v-model="getsearchWord" class="form-control"
                                    placeholder="Search Product" />
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-4" v-for="getproduct in filterSearch"
                                        :key="getproduct.id">
                                        <a href="">
                                            <div class="card">
                                                <div class="card-content">
                                                    <img class="card-img-top img-fluid" :src="
                                                            getproduct.product_image
                                                        " alt="Card image cap" />
                                                    <div class="card-body text-center">
                                                        <h4 class="card-title">
                                                            {{
                                                                getproduct.product_name
                                                            }}
                                                        </h4>
                                                        <span class="badge badge-success" v-if="
                                                                getproduct.product_quantity >
                                                                    getproduct.alert_quantity
                                                            ">Available</span>
                                                        <span class="badge badge-danger" v-else>Stock Out</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "POS",
        data() {
            return {
                products: [],
                categories: "",
                getproducts: [],
                searchWord: "",
                getsearchWord: ""
            };
        },
        created() {
            this.getAllProducts();
            this.getAllCategory();
        },
        methods: {
            getAllProducts() {
                axios
                    .get("/api/product")
                    .then(res => (this.products = res.data))
                    .catch(err => console.log(err));
            },
            getAllCategory() {
                axios
                    .get("api/category")
                    .then(res => (this.categories = res.data))
                    .catch(err => console.log(err));
            },
            subProduct(id) {
                axios
                    .get(`/api/getting/product/${id}`)
                    .then(res => (this.getproducts = res.data))
                    .catch(err => console.log(err));
            }
        },
        computed: {
            filterSearch() {
                return this.getproducts.filter(product => {
                    return product.product_name.match(this.getsearchWord);
                });
            },
            searchFilter() {
                if (this.products.length > 0) {
                    return this.products.filter(product => {
                        return (
                            product.product_name.match(this.searchWord) ||
                            product.product_code.match(this.searchWord) ||
                            product.category.categoryname.match(this.searchWord)
                        );
                    });
                }
            }
        }
    };
</script>

<style></style>