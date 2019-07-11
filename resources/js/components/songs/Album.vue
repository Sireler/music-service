<template>
    <div class="album">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-thumbnail rounded-circle" :src="album.cover" alt="Album">
                            </div>
                            <div class="col-md-8">
                                <div class="float-right">
                                    <h4>Album</h4>
                                    <h1 class="text-primary">{{ album.name }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="m-1" v-for="track in tracks">
                            <Track :track="track"></Track>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Track from './Track';

    import { mapState, mapActions } from 'vuex';

    export default {
        name: "Album",
        components: {
            Track
        },
        computed: {
            id() {
                return this.$route.params.id;
            },
            ...mapState({
                album: state => state.albums.album,
                tracks: state => state.albums.tracks
            })
        },
        methods: {
            ...mapActions('albums', [
                'getAlbum',
                'getAlbumTracks'
            ])
        },
        mounted() {
            this.getAlbum(this.id);
            this.getAlbumTracks(this.id);
        }
    }
</script>

<style scoped>

</style>