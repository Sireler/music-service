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
    import { mapActions, mapMutations, mapState } from 'vuex';

    import TopNavbar from "./components/TopNavbar";

    export default {
        name: "App",
        components: {
            TopNavbar
        },
        methods: {
            ...mapActions('auth', [
                'getCurrentUser',
            ]),
            ...mapMutations('auth', [
                'destroyToken'
            ])
        },
        computed: {
            ...mapState({
                user: state => state.auth.user,
            }),
        },
        mounted() {
            this.getCurrentUser()
                .catch(error => {
                    this.destroyToken();
                });
        }
    }
</script>

<style scoped>

</style>
