<template>
    <div class="card">
        <div class="card-body">
            <div class="uploading-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="track-title">
                            <label for="track">Track</label>
                            <input id="track" class="form-control" type="text" :value="title"
                                   @input="updateTitle">
                        </div>
                        <hr>
                        <div class="track-artist">
                            <label for="artist">Artist</label>
                            <input id="artist" class="form-control" type="text"
                                   :value="artist"
                                   @input="updateArtist">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div v-if="image" class="image-container">
                            <img class="float-right img-thumbnail" :src="image" alt="Cover" width="200" height="200">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary"
                        @click="storeTrack">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';

    export default {
        name: "Uploading",
        computed: {
            ...mapState({
                title: state => state.songs.uploadInfo.title,
                artist: state => state.songs.uploadInfo.artist,
                image: state => state.songs.uploadInfo.image
            })
        },
        methods: {
            updateTitle(e) {
                this.$store.commit('songs/updateTitle', e.target.value);
            },
            updateArtist(e) {
                this.$store.commit('songs/updateArtist', e.target.value);
            },
            ...mapActions('songs', [
                'storeTrack'
            ])
        }
    }
</script>

<style scoped>

</style>