<template>
  <section>
    <div class="row breadcrumbs-top mb-3">
      <div class="col-12">
        <h2 class="content-header-title float-left mb-0">Salary Module</h2>
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <router-link :to="{name: 'dashboard'}">Home</router-link>
            </li>
            <li class="breadcrumb-item">
              <router-link :to="{name: 'given-salary'}">Salary Pay</router-link>
            </li>
            <li class="breadcrumb-item active">
              <router-link to="#">Salary History Employee</router-link>
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="row match-height" id="table-bordered">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Salary Details</h4>
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
                      <input type="search" class="form-control form-control-sm" placeholder="Search here..." aria-controls="DataTables_Table_0" v-model="searchWord">
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover-animation mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Month Name</th>
                    <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                  <tr v-for="(salary, index) in searchFilter" :key="salary.id">
                    <td scope="row">{{ index+1 }}</td>
                    <td>{{ salary.salary_month }}</td>
                    <td>
                      <router-link :to="{name: 'view-salary', params: { id: salary.salary_month } }"
                        class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light"><i
                          class="feather icon-activity"></i></router-link>
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
        salaries: [],
        searchWord: '',
      }
    },
    created() {
      if (!User.isLoggedIn()) {
                this.$router.push({ name: 'login' })
      }
      this.getAllSalary();
    
    },
    computed: {
      searchFilter(){
        return this.salaries.filter(salary => {
          return (
            salary.salary_month.match(this.searchWord)
          );
        })
      }
    },
    methods: {
        getAllSalary()
        {
            axios.get('/api/salary')
            .then(res => {
            // console.log(res.data)
                this.salaries = res.data;
            })
            .catch(err => console.log(err.response.data))
        }
    }
  }
</script>

<style>
  #em_photo {
    width: 40px;
    height: 40px;
  }
</style>