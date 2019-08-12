<template>
    <div class="card">
        <div class="card-body">
            <div class="uploading-info">

                <MultipleTracks v-if="tracksCount > 1" :info="info"></MultipleTracks>
                <OneTrack v-else :trackInfo="info[0]"></OneTrack>

                <button class="btn btn-primary my-4"
                        @click="storeTrack">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    import MultipleTracks from "./info/MultipleTracks";
    import OneTrack from "./info/OneTrack";

    import { mapState, mapMutations } from 'vuex';

    export default {
        name: "Uploading",
        components: {
            MultipleTracks,
            OneTrack
        },
        computed: {
            ...mapState({
                info: state => state.songs.uploadInfo,
            }),
            tracksCount() {
                return this.info.length;
            }
        },
        methods: {
            storeTrack() {
                this.$store.dispatch('songs/storeTrack')
                    .then(response => {
                        this.$emit('uploadEnd', response.data);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
