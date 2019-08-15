<template>
    <div class="container artists">
        <h2>Artists</h2>
        <div class="row">
            <div class="col-lg-3 col-md-4 mb-4 artist-container"
                 v-for="artist in artists"
                 v-bind:key="artist.id">
                <div class="card artist-card">
                    <img :src="artist.image ? artist.image : '/storage/default-avatar.png'" alt="artist" class="card-img-top">
                    <div class="card-body">
                        <router-link :to="{ name: 'home.artists.artist', params: { id: artist.id } }">
                            {{ artist.name }}
                        </router-link>
                    </div>
                </div>
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
</template>
<script>
    import PageNavigation from "../../navigation/PageNavigation";

    import { mapState, mapActions } from 'vuex';

    export default {
        name: "Artists",
        components: {
            PageNavigation
        },
        data() {
            return {
                currentPage: this.$route.query.page || 1
            }
        },
        computed: {
            ...mapState({
                artists: state => state.artists.list,
                lastPage: state => state.artists.pageData.last_page
            })
        },
        methods: {
            ...mapActions('artists', [
                'getAll'
            ]),
            nextPage() {
                this.currentPage++;

                this.$router.push({
                    name: 'home.artists', query: { page: this.currentPage }
                });
            },
            prevPage() {
                this.currentPage--;

                this.$router.push({
                    name: 'home.artists', query: { page: this.currentPage }
                });
            }
        },
        watch: {
            currentPage(page) {
                this.getAll(page);
            }
        },
        mounted() {
            this.getAll(this.currentPage);
        }
    }
</script>

<style scoped>

</style>
