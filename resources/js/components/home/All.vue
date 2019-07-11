<template>
    <div class="all">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2>Popular tracks</h2>
                    <div class="list-songs">
                        <div class="item-song" v-for="song in songs">
                            <Track :track="song"></Track>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Track from '../songs/Track';

    export default {
        name: "All",
        components: {
            Track
        },
        data() {
            return {
                songs: []
            }
        },
        methods: {
            getAllSongs() {
                this.$store.dispatch('songs/getAllSongs')
                    .then(response => {
                        this.songs = response.data.songs;
                    })
                    .catch(error => {

                    });
            },

            setSong(id) {
                this.$store.commit('player/setTrackUrl', id);
            }
        },
        mounted() {
            this.getAllSongs();
        }
    }
</script>

<style scoped>

</style>