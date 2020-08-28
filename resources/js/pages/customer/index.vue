<template>
    <section>
        <div class="row breadcrumbs-top mb-3">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">
                    Customer Module
                </h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <router-link :to="{ name: 'dashboard' }"
                                >Home</router-link
                            >
                        </li>
                        <li class="breadcrumb-item">
                            <router-link :to="{ name: 'store-customer' }"
                                >Add Customer</router-link
                            >
                        </li>
                        <li class="breadcrumb-item active">
                            <router-link to="#">List of Customer</router-link>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row match-height" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List of Customer</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div
                                        class="dataTables_length"
                                        id="DataTables_Table_0_length"
                                    >
                                        <label
                                            >Show
                                            <select
                                                name="DataTables_Table_0_length"
                                                aria-controls="DataTables_Table_0"
                                                class="custom-select custom-select-sm form-control form-control"
                                            >
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                            entries</label
                                        >
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div
                                        id="DataTables_Table_0_filter"
                                        class="dataTables_filter"
                                    >
                                        <label
                                            >Search:
                                            <input
                                                type="search"
                                                class="form-control form-control-sm"
                                                placeholder="Search here..."
                                                aria-controls="DataTables_Table_0"
                                                v-model="searchWord"
                                            />
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
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(customer,
                                        index) in searchFilter"
                                        :key="customer.id"
                                    >
                                        <td scope="row">{{ index + 1 }}</td>
                                        <td>
                                            <img
                                                :src="customer.photo"
                                                id="em_photo"
                                                alt=""
                                            />
                                        </td>
                                        <td>
                                            {{ customer.name }}
                                        </td>
                                        <td>{{ customer.email }}</td>
                                        <td>{{ customer.phone }}</td>
                                        <td>{{ customer.address }}</td>
                                        <td>
                                            <router-link
                                                :to="{
                                                    name: 'edit-customer',
                                                    params: { id: customer.id }
                                                }"
                                                class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light"
                                                ><i
                                                    class="feather icon-edit"
                                                ></i
                                            ></router-link>
                                            <a
                                                @click="
                                                    deleteCustomer(customer.id)
                                                "
                                                class="btn btn-icon btn-outline-danger mr-1 mb-1 waves-effect waves-light"
                                                ><i
                                                    class="feather icon-trash"
                                                ></i
                                            ></a>
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
            customers: [],
            searchWord: ""
        };
    },
    created() {
        // if (!User.isLoggedIn()) {
        //           this.$router.push({ name: 'login' })
        // }
        axios
            .get("/api/customer")
            .then(res => {
                // console.log(res.data)
                this.customers = res.data;
            })
            .catch(err => console.log(err.response.data));
    },
    computed: {
        searchFilter() {
            return this.customers.filter(customer => {
                return (
                    customer.phone.match(this.searchWord) || customer.name.match(this.searchWord) ||customer.email.match(this.searchWord) ||
                    customer.address.match(this.searchWord) 
                );
            });
        }
    },
    methods: {
        deleteCustomer(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value) {
                    // then call axios to delete
                    axios
                        .delete(`/api/customer/${id}`)
                        .then(() => {
                            this.customers = this.customers.filter(customer => {
                                return customer.id != id;
                            });
                        })
                        .catch(() => {
                            this.$router.push({ name: "index-customer" });
                        });
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        }
    }
};
</script>

<style>
#em_photo {
    width: 40px;
    height: 40px;
}
</style>
