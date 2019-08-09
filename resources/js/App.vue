<template>
    <div class="application">
        <!-- Navbar -->
        <TopNavbar></TopNavbar>
        <!-- /Navbar -->
        <!-- Router view -->
        <div class="current-view">
            <router-view></router-view>
        </div>
        <!-- /Router view -->
    </div>

</template>

<script>
    import TopNavbar from "./components/TopNavbar";

    export default {
        name: "App",
        components: {
            TopNavbar
        },
        computed: {
            loggedIn() {
                return this.$store.getters['auth/loggedIn'];
            }
        }
    }
</script>

<style scoped>

</style>
