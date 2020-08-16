<template>
    <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Product Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item"><router-link :to="{name: 'index-product'}">All Product</router-link>
                        </li>
                        <li class="breadcrumb-item active"><router-link to="#">Add New Product Form</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Product</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" @submit.prevent="productInsert" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <div class="form-group">
                                                    <label for="category-name">Category Name</label>
                                                    <select class="custom-select" id="customSelect1" v-model="form.category_id">
                                                        <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.categoryname }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <div class="form-group">
                                                <label for="supplier-name">Supplier Name</label>
                                                    <select class="custom-select" id="customSelect2" v-model="form.supplier_id">
                                                        <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id">{{ supplier.name }} ({{ supplier.shopname }})</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="product-name" class="form-control"
                                                    placeholder="Product Name" name="product_name" v-model="form.product_name">
                                                    <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                                <label for="product-name">Product Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="product-code" class="form-control"
                                                    placeholder="Product Code" name="product_code" v-model="form.product_code">
                                                    <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                                <label for="product-code">Product Code</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-label-group">
                                                <textarea name="product_description" id="product-description" cols="30" rows="10"
                                                    placeholder="Product Description" v-model="form.product_description"
                                                    class="form-control"></textarea>
                                                <small class="text-danger" v-if="errors.product_description">{{ errors.product_description[0] }}</small>
                                                <label for="product-description">Product Description</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="product-root" class="form-control"
                                                    placeholder="Product Root" name="product_root" v-model="form.product_root">
                                                    <small class="text-danger" v-if="errors.product_root">{{ errors.product_root[0] }}</small>
                                                <label for="product-root">Product Root</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-label-group">
                                                <input type="number" id="buying_price" class="form-control"
                                                    placeholder="Buying Price" name="buying_price" v-model="form.buying_price">
                                                    <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                                <label for="buying_price">Buying Price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-label-group">
                                                <input type="number" id="selling-price" class="form-control"
                                                    placeholder="Selling Price" name="selling_price" v-model="form.selling_price">
                                                    <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                                <label for="selling-price">Selling Price</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-label-group">
                                                <input type="number" id="product-quantity" class="form-control"
                                                    placeholder="Product Quantity" name="product_quantity" v-model="form.product_quantity">
                                                    <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                                <label for="product-quantity">Product Quantity</label>
                                            </div>
                                        </div> 
                                        <div class="col-md-4 col-12">
                                            <div class="form-label-group">
                                                <input type="number" id="alert-quantity" class="form-control"
                                                    placeholder="Alert Quantity" name="alert_quantity" v-model="form.alert_quantity">
                                                    <small class="text-danger" v-if="errors.alert_quantity">{{ errors.alert_quantity[0] }}</small>
                                                <label for="alert-quantity">Alert Quantity</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <div class="form-label-group">
                                                <input type="date" id="buying-date" class="form-control"
                                                    placeholder="Buying Date" name="buying_date" v-model="form.buying_date">
                                                    <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                                                <label for="buying-date">Buying Date</label>
                                            </div>
                                        </div>                                                                                 
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <label for="basicInputFile">Product Image Upload</label>
                                                <div class="custom-file">
                                                    <input type="file" name="product_image" class="custom-file-input" id="product-image" @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.product_image">{{ errors.product_image[0] }}</small>
                                                    <label class="custom-file-label" for="product-image">Choose file</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <img :src="form.product_image" alt="" style="height: 50px; width: 50px">
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                            <button type="reset"
                                                class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Axios from 'axios';
    export default {
        created() {
            if (!User.isLoggedIn()) {
                this.$router.push({ name: 'login' })
            }
            this.getCategories();
            this.getSuppliers();
        },
        data() {
            return {
                form: {
                    category_id: null,
                    supplier_id: null,
                    product_name: null,
                    product_code: null,
                    product_description: null,
                    product_root: null,
                    buying_price: null,
                    selling_price: null,
                    product_quantity: null,
                    alert_quantity: null,
                    buying_date: null,
                    product_image: null,
                },
                categories: {},
                suppliers: {},
                errors: {},
            }
        },
        methods: {
            getCategories(){
                Axios.get('/api/category')
                .then(res => this.categories = res.data)
                .catch(err => console.log(err))
            },
            getSuppliers(){
                Axios.get('/api/supplier')
                .then(res => this.suppliers = res.data)
                .catch(err => console.log(err))
            },
            productInsert(){
                //console.log(this.form);
                Axios.post('/api/product',this.form)
                .then(res => {
                    // then redirect auth user in to dashboard page
                    console.log(res.data);
                    this.$router.push({ name: 'index-product' });
                    Notification.success();
                })
                .catch(err => {
                    console.log(err);
                    this.errors = err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: 'Invalid data input!!!'
                    });
                })
            },
            onFileSelected(event){
                let file = event.target.files[0];  // get the file details 
                if(file.size > 1048770){
                    Notification.image_validation();
                }else{
                    let reader = new FileReader();
                    //console.log(reader);
                    reader.onloadend = file => {
                        this.form.product_image = reader.result;
                        // console.log(event.target.result)
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    }
</script>

<style>

</style>