<template>
    <div class="card">
        <div class="card-body">
            <div class="uploading-info">
                <div class="row">

                    <!-- Track fields -->
                    <div class="col-md-6">
                        <div class="track-title">
                            <label for="track">Track</label>
                            <input id="track" class="form-control" type="text"
                                   :value="title"
                                   @input="updateInfo({ key: 'title', value: $event.target.value })">
                        </div>
                        <hr>
                        <div class="track-artist">
                            <label for="artist">Artist</label>
                            <input id="artist" class="form-control" type="text"
                                   :value="artist"
                                   @input="updateInfo({ key: 'artist', value: $event.target.value })">
                        </div>
                        <hr>
                        <div class="track-album">
                            <label for="album">Album</label>
                            <input id="album" class="form-control" type="text"
                                   :value="album"
                                   @input="updateInfo({ key: 'album', value: $event.target.value })">
                        </div>
                    </div>

                    <!-- Cover (if exists) -->
                    <div class="col-md-5">
                        <div v-if="image" class="image-container">
                            <img class="float-right img-thumbnail" :src="image" alt="Cover" width="200" height="200">
                        </div>
                    </div>

                </div>
                <button class="btn btn-primary my-4"
                        @click="storeTrack">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapMutations } from 'vuex';

    export default {
        name: "Uploading",
        computed: {
            ...mapState({
                title: state => state.songs.uploadInfo.title,
                artist: state => state.songs.uploadInfo.artist,
                image: state => state.songs.uploadInfo.image,
                album: state => state.songs.uploadInfo.album
            })
        },
        methods: {
            ...mapMutations('songs', [
                'updateInfo'
            ]),
            storeTrack() {
                this.$store.dispatch('songs/storeTrack')
                    .then(response => {
                        this.$emit('uploadEnd');
                    });
            }
        }
    }
</script>

<style scoped>

</style>