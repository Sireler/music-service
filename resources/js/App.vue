<template>
    <div class="application">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md bg-light shadow-sm">
            <div class="container">
                <router-link class="navbar-brand" to="/">Laravel</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li v-if="!loggedIn" class="nav-item">
                            <router-link :to="{ name: 'login' }">Login</router-link>
                        </li>
                        <li v-if="loggedIn" class="nav-item">
                            <router-link :to="{ name: 'logout' }">Logout</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /Navbar -->
        <!-- Router view -->
        <div class="current-view">
            <router-view></router-view>
        </div>
        <!-- /Router view -->
    </div>

</template>

<script>
    export default {
        name: "App",
        computed: {
            loggedIn() {
                return this.$store.getters.loggedIn;
            }
        }
    }
</script>

<style scoped>

</style>