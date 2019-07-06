<template>
    <div class="card">
        <div class="card-body">
            <div class="uploading-info">
                {{ title }}
                <hr>
                {{ artist }}
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
                artist: state => state.songs.uploadInfo.artist
            })
        }
    }
</script>

<style scoped>

</style>