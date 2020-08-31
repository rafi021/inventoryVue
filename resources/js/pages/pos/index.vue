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
                                            <tr v-for="(product) in carts" :key="product.id">
                                                <td>{{ product.product_name }}</td>
                                                <td>
                                                    <button class="btn btn-icon btn-outline-success mr-1 mb-1 waves-effect waves-light"
                                                    @click.prevent="addItem(product.id)"
                                                    >+</button>
                                                    <input type="text" readonly :value="product.product_quantity" style="width: 30px;">
                                                    <button class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light"
                                                    @click.prevent="reduceItem(product.id)"
                                                    v-if="product.product_quantity>0"
                                                    >-</button>
                                                </td>
                                                <td>{{ product.product_price }}</td>
                                                <td>{{ product.sub_total }}</td>
                                                <td>
                                                    <a @click="removeItem(product.id)"
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
                                                    <td>{{ qty }}</td>
                                                </tr>
                                                <tr>
                                                    <th>SubTotal</th>
                                                    <td>{{ subTotal }} USD</td>
                                                </tr>
                                                <tr>
                                                    <th>DISCOUNT (5%)</th>
                                                    <td>{{ (subTotal*5)/100 }} USD</td>
                                                </tr>
                                                <tr>
                                                    <th>VAT (15%)</th>
                                                    <td>{{ (subTotal*15)/100 }} USD</td>
                                                </tr>
                                                <tr>
                                                    <th>TOTAL</th>
                                                    <td>{{ (subTotal+(subTotal*15)/100)-((subTotal*5)/100)  }} USD</td>
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
                                                                <option value="" v-for="customer in customers" :key="customer.id">{{ customer.name }}</option>
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
                                        <a class="btn btn-sm" href="" @click.prevent="addToCart(product.id)">
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
                                        <a class="btn btn-sm" href="" @click.prevent="addToCart(getproduct.id)">
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
                getsearchWord: "",
                customers: [],
                carts: [],
                errors: '',
                customer_id: null,
                pay: null,
                due: null,
            };
        },
        created() {
            this.getAllProducts();
            this.getAllCategory();
            this.getAllCustomer();
            this.getCartProduct();
            Reload.$on('AfterAdd', () =>{
                this.getCartProduct();
            })
        },
        methods: {
            addToCart(id){
                // alert(id);
                axios.get(`/api/add-to-cart/${id}`)
                .then((res) => {
                    Reload.$emit('AfterAdd');
                    if(res.data.type == 'success')
                    Notification.cart_success(res.data.message);
                })
                .catch(err => console.log(err))
            },
            getCartProduct(){
                axios.get('/api/cart/product')
                .then(res => this.carts = res.data)
                .catch(err => console.log(err));
            },
            getAllCustomer(){
                axios.get('/api/customer')
                .then(res => this.customers = res.data)
                .catch(err => console.log(err));
            },
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
            },
            removeItem(id){
                axios.get(`/api/remove-from-cart/${id}`)
                .then((res) => {
                    Reload.$emit('AfterAdd');
                    if(res.data.type == 'success')
                    Notification.cart_success(res.data.message);
                })
                .catch(err => console.log(err))
            },
            addItem(id){
                axios.get(`/api/add-to-cart/inc/${id}`)
                .then((res) => {
                    Reload.$emit('AfterAdd');
                    if(res.data.type == 'success')
                    Notification.cart_success(res.data.message);
                })
                .catch(err => console.log(err))
            },
            reduceItem(id){
                axios.get(`/api/add-to-cart/dec/${id}`)
                .then((res) => {
                    Reload.$emit('AfterAdd');
                    if(res.data.type == 'success')
                    Notification.cart_success(res.data.message);
                })
                .catch(err => console.log(err))
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
                            product.product_name.match(this.searchWord) || product.product_code.match(this.searchWord) || product.category.categoryname.match(this.searchWord)
                        );
                    });
                }
            },
            qty(){
                let cart_sum_quantity = 0;
                for(let index=0; index < this.carts.length; index++ ){
                    cart_sum_quantity +=parseFloat(this.carts[index].product_quantity)
                }
                return cart_sum_quantity;
            },
            subTotal(){
                let cart_sub_total = 0;
                for(let index=0; index < this.carts.length; index++ ){
                    cart_sub_total +=parseFloat(this.carts[index].sub_total)
                }
                return cart_sub_total;
            }
        }
    };
</script>

<style></style>