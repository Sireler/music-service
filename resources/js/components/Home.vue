<template>
    <div class="home-container">
        <div class="container-fluid">
            <div class="row">
                <!-- Left sidebar -->
                <NavSidebar></NavSidebar>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2 text-info">Home</h1>
                    </div>

                    <router-view class="text-secondary"></router-view>

                </main>
            </div>

        </div>

        <!-- Audio controls -->
        <nav v-show="track" class="navbar fixed-bottom navbar-light bg-primary">
            <AudioPlayer></AudioPlayer>
        </nav>
    </div>

</template>

<script>
    import AudioPlayer from './controls/AudioPlayer';
    import NavSidebar from './home/NavSidebar';
    import { mapState } from 'vuex';

    export default {
        name: "Home",
        components: {
            AudioPlayer,
            NavSidebar
        },
        computed: {
            ...mapState({
                track: state => state.player.currentTrackUrl
            })
        }
    }
</script>

<style scoped>

</style>