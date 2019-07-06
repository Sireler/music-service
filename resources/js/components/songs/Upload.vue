<template>
    <div class="container">
        <div class="upload-container my-3">
            <div class="card">

                <UploadProgress></UploadProgress>

                <div class="card-body">
                    <div class="custom-file mb-2">
                        <input type="file" class="custom-file-input" id="customFileInput" required
                               @change="handleUpload" ref="file">
                        <label class="custom-file-label" for="customFileInput">Choose files to upload</label>
                    </div>
                </div>
            </div>
        </div>
        <Uploading v-if="uploaded"></Uploading>
    </div>
</template>

<script>
    import UploadProgress from './UploadProgress';
    import Uploading from './Uploading';

    export default {
        name: "Upload",
        components: {
            UploadProgress,
            Uploading
        },
        data() {
            return {
                file: null,
                uploaded: false
            }
        },
        methods: {
            handleUpload() {
                this.file = this.$refs.file.files[0];
                this.submitFile();
            },
            submitFile() {
                let formData = new FormData();

                formData.append('track', this.file);

                this.$store.dispatch('songs/upload', formData)
                    .then(response => {
                        this.uploaded = true;
                    });
            }
        },
    }
</script>

<style scoped>

</style>