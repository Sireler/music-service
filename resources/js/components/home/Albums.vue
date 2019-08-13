<template>
    <div class="albums">
        <h2>Albums</h2>
        <div class="container">

            <div class="row">
                <div class="col-lg-3 col-md-4"
                     v-for="album in albums"
                     v-bind:key="album.id">
                    <ArtistAlbum :album="album" class="mb-4"></ArtistAlbum>
                </div>
            </div>

            <div class="row">
                <div class="pagination">
                    <div class="col-md-12">
                        <PageNavigation :current="currentPage"
                                        :last="lastPage"
                                        @nextPage="nextPage"
                                        @prevPage="prevPage"></PageNavigation>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import ArtistAlbum from "../songs/ArtistAlbum";
    import PageNavigation from "../navigation/PageNavigation";

    import { mapState, mapActions, mapGetters } from 'vuex';

    export default {
        name: "Albums",
        components: {
            ArtistAlbum,
            PageNavigation
        },
        data() {
            return {
                currentPage: this.$route.query.page || 1
            }
        },
        computed: {
            ...mapState({
                albums: state => state.albums.albums,
                lastPage: state => state.albums.pageData.last_page
            }),
        },
        methods: {
            ...mapActions('albums', [
                'getAlbums',
            ]),
            nextPage() {
                this.currentPage++;

                this.$router.push({
                    name: 'home.albums', query: { page: this.currentPage }
                });
            },
            prevPage() {
                this.currentPage--;

                this.$router.push({
                    name: 'home.albums', query: { page: this.currentPage }
                });
            }
        },
        watch: {
            currentPage(page) {
                this.getAlbums(page);
            }
        },
        mounted() {
            this.getAlbums(this.currentPage);
        }
    }
</script>

<style scoped>
    .list-complete-item {
        transition: all 1s;
        display: inline-block;
        margin-right: 10px;
    }
    .list-complete-enter, .list-complete-leave-to
        /* .list-complete-leave-active до версии 2.1.8 */ {
        opacity: 0;
        transform: translateY(30px);
    }
    .list-complete-leave-active {
        position: absolute;
    }
</style>
