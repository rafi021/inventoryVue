<template>
      <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Employee Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item"><router-link :to="{name: 'index-salary'}">All Salary</router-link>
                        </li>
                        <li class="breadcrumb-item active"><router-link to="#">Employee Salary Form</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Employee Salary</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" @submit.prevent="salaryPay">
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
                                                <input type="number" id="salary-floating" class="form-control"
                                                    name="salary" placeholder="Salary"
                                                    v-model="form.amount">
                                                    <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                                                <label for="salary-floating">Salary</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="salary-month">Months</label>
                                                <select class="form-control" id="salary-month" v-model="form.salary_month" >
                                                    <option selected> Select Month </option>
                                                    <option value="January"> January </option>
                                                    <option value="February"> February </option>
                                                    <option value="March"> March </option>
                                                    <option value="April"> April </option>
                                                    <option value="May"> May </option>
                                                    <option value="June"> June </option>
                                                    <option value="July"> July </option>
                                                    <option value="August"> August </option>
                                                    <option value="September"> September </option>
                                                    <option value="October"> October </option>
                                                    <option value="November"> November </option>
                                                    <option value="December"> December </option>
                                                </select>
                                                <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Pay Now</button>
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
            axios.get(`/api/salary/${id}`)
            .then(res => {
                this.form = res.data[0]
                console.log(res.data, this.form);
            })
            .catch(err => console.log(err))
        },
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    amount: '',
                    salary_month: '',
                },
                errors: {},
            }
        },
        methods: {
            salaryPay(){
                let id = this.$route.params.id;
                axios.put(`/api/salary/${id}`, this.form)
                .then(res => {
                    // then redirect auth user in to dashboard page
                    this.$router.push({ name: 'given-salary' });
                    if(res.data.type == 'danger'){
                        Notification.danger(res.data.message);
                    }else{
                        Notification.success();
                    }
                    
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