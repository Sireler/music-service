<template>
    <div class="container">
        <div class="upload-container my-3">

            <AlertDanger :title="'Files cannot be uploaded'"
                         :error="error"
                         @closed="error = ''"></AlertDanger>
            <div class="card">

                <UploadProgress></UploadProgress>
                <div class="card-body">
                    <div class="custom-file mb-2">
                        <input type="file" class="custom-file-input" id="customFileInput" required
                               @change="handleUpload" multiple ref="file">
                        <label class="custom-file-label" for="customFileInput">Choose files to upload</label>
                    </div>
                </div>
            </div>
        </div>
        <Uploading v-if="uploaded"
                   @uploadEnd="handleUploadEnd">
        </Uploading>
        <AboutArtist v-if="artist.was_created" :artist="artist"></AboutArtist>
    </div>
</template>

<script>
    import UploadProgress from './UploadProgress';
    import Uploading from './Uploading';
    import AboutArtist from "./AboutArtist";

    import AlertDanger from "../helpers/AlertDanger";

    import { mapMutations } from 'vuex';

    export default {
        name: "Upload",
        components: {
            UploadProgress,
            Uploading,
            AboutArtist,
            AlertDanger
        },
        data() {
            return {
                files: null,
                uploaded: false,
                artist: {},
                error: '',
            }
        },
        methods: {
            ...mapMutations('songs', [
                'setProgress'
            ]),
            handleUpload() {
                this.files = this.$refs.file.files;

                if (this.files.length !== 0) {
                    this.submitFile();
                }
            },
            handleUploadEnd(data) {
                this.uploaded = false;
                this.artist = data.artist;

                if (!this.artist.was_created) {
                    this.$router.push({
                        name: 'home.artists.artist',
                        params: { id: this.artist.id }
                    });
                }
            },
            submitFile() {
                let formData = new FormData();

                for (let i = 0; i < this.files.length; i++) {
                    formData.append('track[]', this.files[i]);
                }

                this.$store.dispatch('songs/upload', formData)
                    .then(response => {
                        this.uploaded = true;
                    })
                    .catch(error => {
                        this.setProgress(0);
                        this.error = error.response.data.message;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
