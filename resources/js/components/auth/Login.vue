<template>
    <div class="page-login">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <form @submit.prevent class="p-4 rounded m-4">
                                <h3 class="text-center">Log In</h3>
                                <div class="form-group">
                                    <label for="li-email">Email</label>
                                    <input id="li-email" name="email" class="form-control" type="email"
                                           v-model="login.email">
                                </div>
                                <div class="form-group">
                                    <label for="li-password">Password</label>
                                    <input id="li-password" name="password" class="form-control" type="password"
                                           v-model="login.password">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-secondary">Log In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <form @submit.prevent class="p-4 rounded m-4">
                                <h3 class="text-center">Sign Up</h3>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" class="form-control" type="text"
                                           v-model="signup.name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" name="email" class="form-control" type="email"
                                           v-model="signup.email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" class="form-control" type="password"
                                           v-model="signup.password">
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" name="password_confirmation" class="form-control" type="password"
                                           v-model="signup.password_confirmation">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-secondary">Sign Up</button>
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
                login: {
                    email: '',
                    password: ''
                },
                signup: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                }
            }
        }
    }
</script>

<style scoped>
form {
    background: #EBF5EE;
    color: #808080;
}
</style>