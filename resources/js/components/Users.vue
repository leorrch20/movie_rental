<template>
    <section class="content">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users Table</h3>

                            <div class="card-tools">
                                <button class="btn btn-success" @click="newModal">Add New
                                    <i class="fas fa-user-plus fa-fw"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{ user.username }}</td>
                                    <td>{{ user.first_name }}</td>
                                    <td>{{ user.last_name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.role | capitalize }}</td>
                                    <td>
                                        <a href="#" @click="editModal(user)"><i class="fas fa-edit blue"></i></a> /
                                        <a href="#" @click="deleteUser(user.id)"><i class="fas fa-trash red"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Add New</h5>
                            <h5 class="modal-title" v-show="editMode" id="addNewLabel">Update User's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? updateUser() : createUser()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input v-model="form.first_name" type="text" name="first_name" placeholder="Name"
                                           class="form-control"
                                           :class="{ 'is-invalid': form.errors.has('first_name') }">
                                    <has-error :form="form" field="first_name"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.last_name" type="text" name="last_name" placeholder="Last Name"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }">
                                    <has-error :form="form" field="last_name"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.username" type="text" name="username" placeholder="Username"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                                    <has-error :form="form" field="username"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.email" type="email" name="email" placeholder="Email Address"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="form-group">
                                    <select v-model="form.role" name="role" id="role" class="form-control"
                                            :class="{ 'is-invalid': form.errors.has('role') }">
                                        <option value="">Select User Role</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Manager">Manager</option>
                                    </select>
                                    <has-error :form="form" field="role"></has-error>
                                </div>
                                <div class="form-group">
                                    <input v-model="form.password" type="password" name="password" id="password"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button v-show="!editMode" type="submit" class="btn btn-primary">Create</button>
                                <button v-show="editMode" type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </div>
    </section>
</template>

<script>
    export default {
        name: "Users",
        data () {
            return {
                // Create a new form instance
                form: new Form({
                    first_name: '',
                    last_name: '',
                    username: '',
                    email: '',
                    password: '',
                    role: ''
                }),

                users: {},
                editMode: false
            }
        },
        methods: {
            newModal () {
                this.editMode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            editModal (user) {
                this.editMode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            loadUsers () {
                axios.get('api/users').then(({ data }) => (this.users = data.data));
            },
            createUser () {
                this.$Progress.start()
                this.form.post('api/users')
                    .then(response => {
                        $('#addNew').modal('hide');
                        toast.fire({
                            icon: 'success',
                            title: 'User created in successfully'
                        })
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate');
                    })
                    .catch(error => {
                        this.$Progress.fail()
                    });
            },
            updateUser () {
                this.$Progress.start();
                this.form.put('api/users/'+this.form.id)
                    .then(response => {
                        $('#addNew').modal('hide');
                        swal.fire(
                            'Updated!',
                            response.message,
                            'success'
                        )
                        this.$Progress.finish();
                        Fire.$emit('AfterCreate');
                    })
                    .catch(error => {
                        this.$Progress.fail();
                    });
            },
            deleteUser (id) {
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('api/users/'+id)
                            .then(response => {
                                swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                )
                                Fire.$emit('AfterCreate');
                            })
                            .catch(error => {
                                swal.fire(
                                    'Failed!',
                                    'There was something wrong.',
                                    'warning'
                                );
                            });
                    }
                })
            }
        },
        created() {
            //this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            });
        }
    }
</script>

<style scoped>

</style>
