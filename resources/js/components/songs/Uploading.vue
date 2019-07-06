<template>
    <div class="card">
        <div class="card-body">
            <div class="uploading-info">
                <div class="row">
                    <div class="col-md-6">
                        {{ title }}
                        <hr>
                        {{ artist }}
                    </div>
                    <div class="col-md-6">
                        <div class="image-container">
                            <img class="float-right" :src="image" alt="Cover" width="200" height="200">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name: "Uploading",
        computed: {
            ...mapState({
                title: state => state.songs.uploadInfo.title,
                artist: state => state.songs.uploadInfo.artist,
                image: state => state.songs.uploadInfo.image
            })
        }
    }
</script>

<style scoped>

</style>