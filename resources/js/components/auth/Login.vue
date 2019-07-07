<template>
    <div class="page-login">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Login form -->
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <form @submit.prevent="login" class="p-4 rounded m-4 bg-info vld-parent" ref="loginContainer">
                                <h3 class="text-center">Log In</h3>

                                <div v-if="loginServerError" class="alert alert-danger">
                                    {{ loginServerError }}
                                </div>

                                <div class="form-group">
                                    <label for="li-email">Email</label>
                                    <input id="li-email" name="email" class="form-control" type="email"
                                           v-model="loginFields.email">
                                </div>
                                <div class="form-group">
                                    <label for="li-password">Password</label>
                                    <input id="li-password" name="password" class="form-control" type="password"
                                           v-model="loginFields.password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn bg-white text-info">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Registration form -->
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <form @submit.prevent="register" class="p-4 rounded m-4 bg-info vld-parent" ref="registerContainer">
                                <h3 class="text-center">Sign Up</h3>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" class="form-control" type="text"
                                           :class="{ 'is-invalid': registerServerErrors.name }"
                                           v-model="registerFields.name">
                                    <div v-if="registerServerErrors.name" class="invalid-feedback">
                                        {{ registerServerErrors.name[0] }}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" class="form-control" type="email"
                                           :class="{ 'is-invalid': registerServerErrors.email }"
                                           v-model="registerFields.email">
                                    <div v-if="registerServerErrors.email" class="invalid-feedback">
                                        {{ registerServerErrors.email[0] }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" class="form-control" type="password"
                                           :class="{ 'is-invalid': registerServerErrors.password }"
                                           v-model="registerFields.password">
                                    <div v-if="registerServerErrors.password" class="invalid-feedback">
                                        {{ registerServerErrors.password[0] }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" name="password_confirmation" class="form-control" type="password"
                                           v-model="registerFields.password_confirmation">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn bg-white text-info">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                loginFields: {
                    email: '',
                    password: ''
                },
                registerFields: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },

                loginServerError: '',
                registerServerErrors: {},
            }
        },
        methods: {
            login() {
                let loader = this.$loading.show({
                    container: this.$refs.loginContainer,
                });

                this.$store.dispatch('auth/retrieveToken', {
                    username: this.loginFields.email,
                    password: this.loginFields.password
                })
                    .then(response => {
                        this.$router.push({ name: 'home' });
                        loader.hide();
                    })
                    .catch(error => {
                        this.loginServerError = error.response.data;
                        loader.hide();
                    });
            },

            register() {
                let loader = this.$loading.show({
                    container: this.$refs.registerContainer,
                });

                this.$store.dispatch('auth/register', {
                    name: this.registerFields.name,
                    email: this.registerFields.email,
                    password: this.registerFields.password,
                    password_confirmation: this.registerFields.password_confirmation
                })
                    .then(response => {
                        this.$router.push({ name: 'main' });
                        loader.hide();
                    })
                    .catch(error => {
                        this.registerServerErrors = error.response.data.errors;
                        loader.hide();
                    });
            }
        }
    }
</script>

<style scoped>

</style>