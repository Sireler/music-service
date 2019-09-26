<template>
    <div class="releases">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Releases</h2>
                    <div class="container">
                        <div class="row">

                            <div class="list-songs-item col-md-8">
                                <div class="item-song" v-for="song in songs">
                                    <Track :track="song"></Track>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Track from '../songs/Track';

    import { mapState } from 'vuex';
    import { store } from '../../store/store';

    export default {
        name: "Releases",
        components: {
            Track
        },
        computed: {
            ...mapState({
                songs: state => state.songs.releases,
            })
        },
        methods: {
            setSong(id) {
                this.$store.commit('player/setTrackUrl', id);
            }
        },
        beforeRouteEnter(to, from, next) {
            store.dispatch('songs/getAllSongs').then(res => next());
        },
        beforeRouteUpdate(to, from, next) {
            store.dispatch('songs/getAllSongs').then(res => next());
        }
    }
</script>

<style scoped>

</style>
