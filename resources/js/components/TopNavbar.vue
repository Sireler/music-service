<template>
    <nav class="navbar navbar-expand-md bg-primary shadow-sm">
        <div class="container">
            <router-link class="navbar-brand text-white" to="/">Laravel</router-link>
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Search -->
                    <li v-if="loggedIn" class="nav-item mx-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" v-model="searchText">
                            <div class="input-group-append">
                                <button class="btn btn-light" type="button"
                                        @click="search">
                                    <span class="oi oi-magnifying-glass text-primary"></span>
                                </button>
                            </div>
                        </div>
                    </li>
                    <li v-if="!loggedIn" class="nav-item">
                        <router-link class="text-white" :to="{ name: 'login' }">Login</router-link>
                    </li>
                    <li v-if="loggedIn" class="nav-item">
                        <router-link class="text-white" :to="{ name: 'logout' }">Logout</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "TopNavbar",
        data() {
            return {
                searchText: ''
            }
        },
        computed: {
            loggedIn() {
                return this.$store.getters['auth/loggedIn'];
            }
        },
        methods: {
            search() {
                this.$router.push({ name: 'home.search', query: { q: this.searchText } })
            }
        }
    }
</script>

<style scoped>
    nav {
        z-index: 10;
    }
</style>
