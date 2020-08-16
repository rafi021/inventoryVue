<template>
    <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Expense Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item"><router-link :to="{name: 'index-expense'}">All Expense</router-link>
                        </li>
                        <li class="breadcrumb-item active"><router-link to="#">Add New Expense Form</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Expense</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" @submit.prevent="expenseInsert">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-label-group">
                                                <textarea name="details" id="expense-details" cols="30" rows="10"
                                                    placeholder="Expense Details" v-model="form.details"
                                                    class="form-control"></textarea>
                                                <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                                                <label for="expense-details">Expense Details</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="number" id="expense-amount" class="form-control"
                                                    placeholder="Expense Amount" name="amount" v-model="form.amount">
                                                    <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                                                <label for="expense-amount">Expense Amount</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="date" id="expense-date" class="form-control"
                                                    placeholder="Expense Date" name="expense_date" v-model="form.expense_date">
                                                    <small class="text-danger" v-if="errors.expense_date">{{ errors.expense_date[0] }}</small>
                                                <label for="expense-date">Expense Date</label>
                                            </div>
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
        },
        data() {
            return {
                form: {
                    details: null,
                    amount: null,
                    expense_date: null
                },
                errors: {},
            }
        },
        methods: {
            expenseInsert(){
                //console.log(this.form);
                Axios.post('/api/expense',this.form)
                .then(res => {
                    // then redirect auth user in to dashboard page
                    //console.log(res.data);
                    this.$router.push({ name: 'index-expense' });
                    Notification.success();
                })
                .catch(err => {
                    //console.log(err);
                    this.errors = err.response.data.errors;
                    Toast.fire({
                        icon: 'warning',
                        title: 'Invalid data input!!!'
                    });
                })
            }
        }
    }
</script>

<style>

</style>