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
                this.$store.dispatch('getAllSongs')
                    .then(response => {
                        this.songs = response.data.songs;
                        console.log(this.songs)
                    })
                    .catch(error => {

                    });
            },

            setSong(id) {
                this.$emit('songChanged', id);
            }
        },
        mounted() {
            this.getAllSongs();
        }
    }
</script>

<style scoped>

</style>