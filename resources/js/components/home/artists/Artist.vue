<template>
    <div class="artist">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-thumbnail rounded-circle" :src="artist.image ? artist.image : '/storage/default-avatar.png'" alt="Artist">
                            </div>
                            <div class="col-md-8">
                                <h4>Artist</h4>
                                <h1 class="text-primary">{{ artist.name }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <Nav :tracks="songs" :albums="albums"></Nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Nav from './artist/Nav';
    import { mapState, mapActions, mapMutations } from 'vuex';

    export default {
        name: "Artist",
        components: {
            Nav
        },
        methods: {
            ...mapActions('artists', [
                'get',
            ]),
            ...mapMutations('artists', [
                'clearArtist'
            ])
        },
        computed: {
            ...mapState({
                artist: state => state.artists.artist,
                songs: state => state.artists.artist.songs,
                albums: state => state.artists.artist.albums
            }),
            id() {
                return this.$route.params.id;
            }
        },

        mounted() {
            this.clearArtist();

            this.get(this.id);
        }
    }
</script>

<style scoped>

</style>
