<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 my-2 mt-5 py-5 bg-primary">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-primary border-light">
                            <div class="card-body text-center">
                                <h2>Music service</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4 text-center">
                        <router-link class="btn btn-secondary btn-lg" to="/login">Sign up</router-link>
                    </div>
                </div>
            </div>
        </div>
        <hr class="bg-primary">
        <div class="row mb-4">
            <div class="col-md-12 mt-2 py-3 bg-white text-secondary">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <div class="main-albums-header">
                            <h2 class="display-4">Listen to good music</h2>
                            <h3 class="text-left text-primary">Top albums</h3>
                        </div>
                        <div class="main-albums row">
                            <div class="main-albums-item col-md-3 col-sm-6 mb-4" v-for="album in albums">
                                <ArtistAlbum :album="album"></ArtistAlbum>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ArtistAlbum from "./songs/ArtistAlbum";

    import { mapState, mapActions } from 'vuex';

    export default {
        name: "Main",
        components: {
            ArtistAlbum
        },
        computed: {
            ...mapState({
                albums: state => state.albums.mainAlbums
            })
        },
        methods: {
            ...mapActions('albums', [
                'getMainAlbums'
            ])
        },
        created() {
            this.getMainAlbums();
        }
    }
</script>

<style scoped>

</style>
