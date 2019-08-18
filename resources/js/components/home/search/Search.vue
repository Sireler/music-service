<template>
    <div class="albums">
        <div class="container">
            <div class="found-container"
                 v-if="(tracks && tracks.length > 0) || (albums && albums.length > 0)">
                <!-- Tracks -->
                <div class="row tracks-list" v-if="tracks && tracks.length > 0">
                    <div class="col-md-12 mt-2">
                        <div class="card border-primary">
                            <div class="col-md-12 my-2">
                                <h3>Tracks: {{ tracksCount }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="m-1" v-for="track in tracks">
                                    <Track :track="track"></Track>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Albums -->
                <div class="row albums-list mt-2" v-if="albums && albums.length > 0">
                    <div class="col-md-12 mt-2">
                        <div class="card border-primary">
                            <div class="col-md-12 my-2">
                                <h3>Albums: {{ albumsCount }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 my-2" v-for="album in albums">
                                        <ArtistAlbum :album="album"></ArtistAlbum>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="not-found" v-else>
                <div class="row">
                    <div class="col-md-8 mt-2">
                        <div class="card p-4">
                            <p>Nothing Found</p>
                            <router-link :to="{ name: 'home.search', query: { q: this.query } }">
                                <p>Query: {{ query }}</p>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';

    import Track from "../../songs/Track";
    import ArtistAlbum from "../../songs/ArtistAlbum";

    export default {
        name: "Search",
        components: {
            Track,
            ArtistAlbum
        },
        methods: {
            ...mapActions('search', [
                'search'
            ])
        },
        computed: {
            query() {
                return this.$route.query.q || '';
            },
            ...mapState({
                tracks: state => state.search.tracks,
                tracksCount: state => state.search.tracksCount,
                albums: state => state.search.albums,
                albumsCount: state => state.search.albumsCount
            }),
        },
        watch: {
            query() {
                this.search(this.query);
            }
        },
        created() {
            this.search(this.query);
        }
    }
</script>

<style scoped>

</style>
