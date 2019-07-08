<template>
    <div class="artist">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-thumbnail rounded-circle" :src="artist.image" alt="Artist">
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
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';

    export default {
        name: "Artist",
        methods: {
            ...mapActions('artists', [
                'get'
            ])
        },
        computed: {
            ...mapState({
                artist: state => state.artists.artist
            })
        },

        mounted() {
            let id = this.$route.params.id;

            this.get(id);
        }
    }
</script>

<style scoped>

</style>