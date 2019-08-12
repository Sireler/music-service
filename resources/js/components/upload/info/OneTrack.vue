<template>
    <div v-if="trackInfo" class="track-info">
        <div class="row">
            <!-- Track fields -->
            <div class="col-md-6">
                <div class="track-title">
                    <label for="track">Track</label>
                    <input id="track" class="form-control" type="text"
                           :value="trackInfo.title"
                           @input="updateInfo({ i: 0, key: 'title', value: $event.target.value })">
                </div>
                <hr>
                <div class="track-artist">
                    <label for="artist">Artist</label>
                    <input id="artist" class="form-control" type="text"
                           :value="trackInfo.artist"
                           @input="updateInfo({ i: 0, key: 'artist', value: $event.target.value })">
                </div>
                <hr>
                <div class="track-album">
                    <label for="album">Album</label>
                    <input id="album" class="form-control" type="text"
                           :value="trackInfo.album"
                           @input="updateInfo({ i: 0, key: 'album', value: $event.target.value })">
                </div>
            </div>

            <!-- Cover (if exists) -->
            <div class="col-md-5 text-right">
                <span>Track</span>
                <div v-if="trackInfo.image" class="image-container">
                    <img class="float-right img-thumbnail" :src="trackInfo.image" alt="Cover" width="200" height="200">
                </div>
            </div>
            <div class="col-md-12">
                <hr class="bg-primary">
            </div>
        </div>
    </div>
</template>

<script>
    import { mapMutations } from 'vuex';

    export default {
        name: "OneTrack",
        props: ['trackInfo'],
        methods: {
            ...mapMutations('songs', [
                'updateInfo'
            ]),
        }
    }
</script>

<style scoped>

</style>
