<template>
    <div class="application">
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

                    </ul>
                </div>
            </div>
        </nav>
        <div class="current-view">
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
    export default {
        name: "App"
    }
</script>

<style scoped>

</style>