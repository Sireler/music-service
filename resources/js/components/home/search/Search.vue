<template>
    <div class="albums">
        <div class="container">
            <!-- Tracks -->
            <div class="row tracks-list" v-if="tracks && tracks.length > 0">
                <div class="col-md-8 mt-2">
                    <div class="card">
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
            <div class="row" v-else>
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
</template>

<script>
    import { mapState, mapActions } from 'vuex';

    import Track from "../../songs/Track";

    export default {
        name: "Search",
        components: {
            Track
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
                tracksCount: state => state.search.tracksCount
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
