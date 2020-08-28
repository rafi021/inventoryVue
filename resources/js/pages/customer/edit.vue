<template>
      <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Customer Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item"><router-link :to="{name: 'index-customer'}">All Customer</router-link>
                        </li>
                        <li class="breadcrumb-item active"><router-link to="#">Update Customer Form</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Customer</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" @submit.prevent="editCustomer" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="full-name-column" class="form-control"
                                                    placeholder="Full Name" name="name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                                <label for="full-name-column">Full Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="email" id="email-column" class="form-control"
                                                    placeholder="Email Address" name="email"
                                                    v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                                <label for="email-column">Email Address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="phone" id="phone-column" class="form-control"
                                                    placeholder="Phone" name="phone" v-model="form.phone">
                                                    <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                                <label for="phone-column">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-label-group">
                                                <textarea name="address" id="address-column" cols="30" rows="10"
                                                    placeholder="Full Address" v-model="form.address"
                                                    class="form-control"></textarea>
                                                <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                                <label for="company-column">Present Address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <label for="basicInputFile">Photo Upload</label>
                                                <div class="custom-file">
                                                    <input type="file" name="new_photo" class="custom-file-input" id="inputGroupFile01" @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.new_photo">{{ errors.new_photo[0] }}</small>
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <!-- <img :src="form.photo" alt="old_image" style="height: 50px; width: 50px"> -->
                                                <img :src="form.new_photo" alt="new_image" style="height: 50px; width: 50px">
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Update</button>
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
    </section>
</template>

<script>
export default {
    created() {
            if (!User.isLoggedIn()) {
                this.$router.push({ name: 'login' })
            }
            let id = this.$route.params.id;
            axios.get(`/api/customer/${id}`)
            .then(res => {
                this.form = res.data
                console.log(res.data, this.form);
            })
            .catch(err => console.log(err))
        },
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    phone: '',
                    address: '',
                    photo: '',
                    new_photo: '', 
                },
                errors: {},
            }
        },
        methods: {
            editCustomer(){
                let id = this.$route.params.id;
                axios.put(`/api/customer/${id}`, this.form)
                .then(res => {
                    // then redirect auth user in to dashboard page
                    this.$router.push({ name: 'index-customer' });
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
                    reader.onloadend = file => {
                        this.form.new_photo = reader.result;
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