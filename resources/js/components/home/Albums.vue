<template>
    <div class="albums">
        <h2>Albums</h2>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4"
                     v-for="album in albums">
                    <ArtistAlbum :album="album" class="mb-4"></ArtistAlbum>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ArtistAlbum from "../songs/ArtistAlbum";

    import { mapState, mapActions } from 'vuex';

    export default {
        name: "Albums",
        components: {
            ArtistAlbum
        },
        computed: {
            ...mapState({
                albums: state => state.albums.albums,
            })
        },
        methods: {
            ...mapActions('albums', [
                'getAlbums'
            ])
        },
        mounted() {
            this.getAlbums();
        }
    }
</script>

<style scoped>

</style>
