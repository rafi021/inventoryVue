<template>
    <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Employee Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item"><router-link :to="{name: 'index-employee'}">All Employee</router-link>
                        </li>
                        <li class="breadcrumb-item active"><router-link to="#">Add New Employee Form</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Employee</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" @submit.prevent="employeeInsert" enctype="multipart/form-data">
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
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="number" id="salary-floating" class="form-control"
                                                    name="salary" placeholder="Salary"
                                                    v-model="form.salary">
                                                    <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                                                <label for="salary-floating">Salary</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="nid-floating" class="form-control"
                                                    name="nid" placeholder="National ID" v-model="form.nid">
                                                    <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                                                <label for="nid-floating">National Identification No:</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="date" id="joining-date-column" class="form-control"
                                                    name="joining_date" placeholder="Joining Date"
                                                    v-model="form.joining_date">
                                                    <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>
                                                <label for="joining-date-column">Joining Date</label>
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
                                                    <input type="file" name="photo" class="custom-file-input" id="inputGroupFile01" @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <img :src="form.photo" alt="" style="height: 50px; width: 50px">
                                            </fieldset>
                                        </div>
                                        <!-- <div class="form-group col-12">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Remember me</span>
                                                </div>
                                            </fieldset>
                                        </div> -->
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
                    name: null,
                    email: null,
                    phone: null,
                    salary: null,
                    address: null,
                    photo: null,
                    nid: null,
                    joining_date: null,
                },
                errors: {},
            }
        },
        methods: {
            employeeInsert(){
                console.log(this.form);
                // axios.post('/api/employee', this.form)
                // .then(res => console.log(res.data))
                // .catch(err => console.log(err))
                axios.post('/api/employee',this.form)
                .then(res => {
                    // then redirect auth user in to dashboard page
                    this.$router.push({ name: 'index-employee' });
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
                    console.log(reader);
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