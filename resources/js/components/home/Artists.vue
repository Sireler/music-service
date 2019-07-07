<template>
    <div class="artists">
        <h2>Artists</h2>
        <div class="row">
            <div class="col-lg-3 col-md-4 mb-4 artist-container"
                 v-for="artist in list"
                 @click="toArtist">
                <div class="card artist-card">
                    <img :src="artist.image" alt="artist" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ artist.name }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapState } from 'vuex';

    export default {
        name: "Artists",
        methods: {
            toArtist() {

            }
        },
        computed: {
            ...mapState({
                list: state => state.artists.list
            })
        },
        mounted() {
            this.$store.dispatch('artists/getAll');
        }
    }
</script>

<style scoped>
    .artist-container {
        cursor: pointer;
    }
</style>