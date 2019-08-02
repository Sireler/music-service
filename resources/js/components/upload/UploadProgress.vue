<template>
    <div class="upload-progress">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="'width: '+ uploadProgress"></div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: "UploadProgress",
        computed: {
            ...mapGetters({
                uploadProgress: 'songs/percentCompleted'
            })
        }
    }
</script>

<style scoped>

</style>