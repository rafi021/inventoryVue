<template>
  <section class="row flexbox-container">
    <div class="col-xl-12 col-11 d-flex justify-content-center">
      <div class="card bg-authentication rounded-0 mb-0">
        <div class="row m-0">
          <div class="col-lg-12 col-12 p-0">
            <div class="card rounded-0 mb-0 px-2">
              <div class="card-header pb-1">
                <div class="card-title">
                  <h4 class="mb-0">Login</h4>
                </div>
              </div>
              <p class="px-2">Welcome back, please login to your account.</p>
              <div class="card-content">
                <div class="card-body pt-1">
                  <form @submit.prevent="login">
                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                      <input 
                      type="email" 
                      class="form-control" 
                      id="user-email" 
                      placeholder="User Email" 
                      required 
                      v-model="form.email"
                      >
                      <div class="form-control-position">
                        <i class="feather icon-user"></i>
                      </div>
                      <label for="user-email">Username</label>
                    </fieldset>

                    <fieldset class="form-label-group position-relative has-icon-left">
                      <input 
                      type="password" 
                      class="form-control" 
                      id="user-password" 
                      placeholder="Password" 
                      required 
                      v-model="form.password"
                      >
                      <div class="form-control-position">
                        <i class="feather icon-lock"></i>
                      </div>
                      <label for="user-password">Password</label>
                    </fieldset>
                    <div class="form-group d-flex justify-content-between align-items-center">
                      <div class="text-left">
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
                      </div>
                      <div class="text-right">
                        <router-link :to="{name: 'forget-password' }" class="card-link">Forgot Password?</router-link>
                      </div>
                    </div>
                    <router-link :to="{name: 'register' }" class="btn btn-outline-primary float-left btn-inline">Register</router-link>
                    <button type="submit" class="btn btn-primary float-right btn-inline">Login</button>
                  </form>
                </div>
              </div>
              <div class="login-footer">
                <div class="divider">
                  <div class="divider-text">OR</div>
                </div>
                <div class="footer-btn d-inline">
                  <a href="#" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                  <a href="#" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                  <a href="#" class="btn btn-google"><span class="fa fa-google"></span></a>
                  <a href="#" class="btn btn-github"><span class="fa fa-github-alt"></span></a>
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
import axios from 'axios';
import User from '../../helpers/User'
  export default {
    data(){
      return{
        form: {
          email : null,
          password: null,
        }
      }
    },
    methods: {
      login() {
        axios.post('/api/auth/login',this.form)
        .then(res => {
          console.log(res.data);
          User.responseAfterLogin(res);
        })
        .catch(err => console.log(err.response.data))
      }
    }
  }
</script>

<style>

</style>