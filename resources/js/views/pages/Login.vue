<template>
    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Movie</b>Rental</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form @submit.prevent="login()">
                        <div class="input-group mb-3">
                            <input v-model="form.email" type="email" class="form-control" placeholder="Email"
                                   :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input v-model="form.password" type="password" class="form-control" placeholder="Password"
                                   :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mb-1">
                        <a href="#">I forgot my password</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "login",
    data() {
        return {
            form: new Form({
                username: '',
                password: ''
            })
        }
    },
    methods: {
        async login() {
            const response = await this.form.post('/api/login')
        }
    }
}
</script>

<style scoped>

</style>
