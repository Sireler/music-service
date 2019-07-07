<template>
    <div class="all">
        <h2>All songs</h2>
        <div class="list-songs">
            <div class="item-song" v-for="song in songs">
                <button class="btn btn-success"
                        @click="setSong(song.id)">Set song</button>

            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "All",
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