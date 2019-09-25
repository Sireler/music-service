<template>
    <div class="albums">

        <div class="container">
            <h2>Albums</h2>
            <div class="row">
                <div class="col-lg-3 col-md-4"
                     v-for="album in albums"
                     v-bind:key="album.id">
                    <AlbumCard :album="album" class="mb-4"></AlbumCard>
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
    import PageNavigation from "../navigation/PageNavigation";
    import AlbumCard from "./albums/AlbumCard";

    import { mapState } from 'vuex';

    import { store } from '../../store/store';

    export default {
        name: "Albums",
        components: {
            AlbumCard,
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
        beforeRouteEnter(to, from, next) {
            store.dispatch('albums/getAlbums', to.query.page).then(res => next());
        },
        beforeRouteUpdate(to, from, next) {
            store.dispatch('albums/getAlbums', to.query.page).then(res => next());
        }
    }
</script>

<style scoped>

</style>
