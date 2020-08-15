<template>
    <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Supplier Module</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <router-link :to="{name: 'dashboard'}">Home</router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <router-link :to="{name: 'store-supplier'}">Add Supplier</router-link>
                        </li>
                        <li class="breadcrumb-item active">
                            <router-link to="#">List of Supplier</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List of Supplier</h4>
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
                                            <input type="search" class="form-control form-control-sm"
                                                placeholder="Search here..." aria-controls="DataTables_Table_0"
                                                v-model="searchWord">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover-animation mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>ShopName</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(supplier, index) in searchFilter" :key="supplier.id">
                                        <td scope="row">{{ index+1 }}</td>
                                        <td>
                                            <img :src="supplier.photo" id="em_photo" alt="">
                                        </td>
                                        <td>{{ supplier.name }}</td>
                                        <td>{{ supplier.email }}</td>
                                        <td>{{ supplier.phone }}</td>
                                        <td>{{ supplier.shopname }}</td>
                                        <td>{{ supplier.address }}</td>
                                        <td>
                                            <router-link :to="{name: 'edit-supplier', params: { id: supplier.id } }"
                                                class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light">
                                                <i class="feather icon-edit"></i></router-link>
                                            <a @click="deleteSupplier(supplier.id)"
                                                class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light">
                                                <i class="feather icon-trash"></i></a>
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
                suppliers: [],
                searchWord: '',
            }
        },
        created() {
            // if (!User.isLoggedIn()) {
            //           this.$router.push({ name: 'login' })
            // }
            axios.get('/api/supplier')
                .then(res => {
                    // console.log(res.data)
                    this.suppliers = res.data;
                })
                .catch(err => console.log(err.response.data))
        },
        computed: {
            searchFilter() {
                return this.suppliers.filter(supplier => {
                    return (
                        supplier.name.match(this.searchWord) || supplier.email.match(this.searchWord) || supplier.phone.match(this.searchWord)
                        || supplier.shopname.match(this.searchWord) || supplier.address.match(this.searchWord)
                    );
                })
            }
        },
        methods: {
            deleteSupplier(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        // then call axios to delete
                        axios.delete(`/api/supplier/${id}`)
                            .then(() => {
                                this.suppliers = this.suppliers.filter(supplier => {
                                    return supplier.id != id;
                                })
                            })
                            .catch(() => {
                                this.$router.push({ name: 'index-supplier' })
                            })
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
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