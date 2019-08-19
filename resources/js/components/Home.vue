<template>
    <div class="home-container">
        <div class="container-fluid">
            <div class="row">

                <main role="main" class="col-md-12 col-lg-10 offset-lg-1 px-4">
                    <!-- Left sidebar -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <NavSidebar class="my-4 text-secondary border-primary border"></NavSidebar>
                            </div>
                        </div>
                    </div>



                    <router-view class="text-secondary"></router-view>

                </main>
            </div>

        </div>

        <!-- Audio controls -->
        <nav v-show="track" class="navbar fixed-bottom navbar-light bg-primary player-container">
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
    .player-container {
        height: 75px;
    }
    .home-container {
        margin-bottom: 100px;
    }
</style>
