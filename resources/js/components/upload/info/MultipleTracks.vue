<template>
    <div class="track-info">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="track-artist">
                    <label for="artist">Artist</label>
                    <input id="artist" class="form-control" type="text"
                           :value="info[0].artist"
                           @input="updateAllInfo({ key: 'artist', value: $event.target.value })">
                </div>
                <hr>
            </div>
            <div class="col-md-12">
                <div class="track-album">
                    <label for="album">Album</label>
                    <input id="album" class="form-control" type="text"
                           :value="info[0].album"
                           @input="updateAllInfo({ key: 'album', value: $event.target.value })">
                </div>
                <hr>
            </div>
        </div>

        <div class="row" v-for="(trackInfo, i) in info">
            <!-- Track fields -->
            <div class="col-md-6">
                <div class="track-title">
                    <label for="track">Track</label>
                    <input id="track" class="form-control" type="text"
                           :value="trackInfo.title"
                           @input="updateInfo({ i: i, key: 'title', value: $event.target.value })">
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
        name: "Multiple",
        props: ['info'],
        methods: {
            ...mapMutations('songs', [
                'updateInfo',
                'updateAllInfo'
            ]),
        }
    }
</script>

<style scoped>

</style>
