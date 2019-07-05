<template>
    <div class="home-container">
        <div class="container-fluid">
            <div class="row">
                <!-- Left sidebar -->
                <nav class="col-md-2 d-none d-md-block bg-light sidebar position-fixed">
                    <div class="sidebar-sticky">
                        <ul class="nav nav-pills flex-column pt-2">
                            <li class="nav-item active">
                                <router-link class="nav-link" :to="{ name: 'home' }" exact-active-class="active">
                                    <span class="oi oi-home"></span>
                                    Home
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'home.all' }" exact-active-class="active">
                                    <span class="oi oi-musical-note"></span>
                                    All songs
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'home.albums' }" exact-active-class="active">
                                    <span class="oi oi-media-play"></span>
                                    Albums
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'home.artists' }" exact-active-class="active">
                                    <span class="oi oi-person"></span>
                                    Artists
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </nav>

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
    import { mapState } from 'vuex';

    export default {
        name: "Home",
        components: {
            AudioPlayer
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