<template>
    <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Category Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item"><router-link :to="{name: 'index-category'}">All Category</router-link>
                        </li>
                        <li class="breadcrumb-item active"><router-link to="#">Add New Category Form</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Category</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" @submit.prevent="categoryInsert" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="category-name" class="form-control"
                                                    placeholder="Category Name" name="categoryname" v-model="form.categoryname">
                                                    <small class="text-danger" v-if="errors.categoryname">{{ errors.categoryname[0] }}</small>
                                                <label for="category-name">Category Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-label-group">
                                                <textarea name="categorydescription" id="category-description" cols="30" rows="10"
                                                    placeholder="Category Description" v-model="form.categorydescription"
                                                    class="form-control"></textarea>
                                                <small class="text-danger" v-if="errors.categorydescription">{{ errors.categorydescription[0] }}</small>
                                                <label for="category-description">Category Description</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <label for="basicInputFile">Category Photo</label>
                                                <div class="custom-file">
                                                    <input type="file" name="categoryphoto" class="custom-file-input" id="inputGroupFile01" @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.categoryphoto">{{ errors.categoryphoto[0] }}</small>
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <img :src="form.categoryphoto" alt="" style="height: 50px; width: 50px">
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
    export default {
        created() {
            if (!User.isLoggedIn()) {
                this.$router.push({ name: 'login' })
            }
        },
        data() {
            return {
                form: {
                    categoryname: null,
                    categorydescription: null,
                    categoryphoto: null,
                },
                errors: {},
            }
        },
        methods: {
            categoryInsert(){
                console.log(this.form);
                // axios.post('/api/employee', this.form)
                // .then(res => console.log(res.data))
                // .catch(err => console.log(err))
                axios.post('/api/category',this.form)
                .then(res => {
                    // then redirect auth user in to dashboard page
                    this.$router.push({ name: 'index-category' });
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
            onFileSelected(event){
                let file = event.target.files[0];  // get the file details 
                if(file.size > 1048770){
                    Notification.image_validation();
                }else{
                    let reader = new FileReader();
                    //console.log(reader);
                    reader.onloadend = file => {
                        this.form.photo = reader.result;
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