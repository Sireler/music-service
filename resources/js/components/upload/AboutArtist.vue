<template>
    <div class="card">
        <div class="card-body">
            <h3>Upload an avatar for the new artist</h3>
            <div class="image-container">
                <img class="img-thumbnail" :src="image" alt="Default avatar">
                <div class="input-group my-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Update image</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01"
                               @change="handleInput">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
                <button class="btn btn-success" @click="handleUpload">Save</button>
            </div>

        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        name: "AboutArtist",
        props: ['artist'],
        data() {
            return {
                image: '/storage/default-avatar.png',
                file: null
            }
        },
        methods: {
            handleInput(e) {
                if (e.target.files && e.target.files[0]) {
                    const file = e.target.files[0];
                    this.file = file;

                    this.image = URL.createObjectURL(file);
                }
            },
            handleUpload() {
                if (this.file) {
                    let formData = new FormData();
                    formData.append('image', this.file);

                    this.updateAvatar({
                        id: this.artist.id,
                        file: formData
                    })
                        .then(response => {
                            this.toArtist();
                        })
                } else {
                    this.toArtist();
                }
            },
            toArtist() {
                this.$router.push({
                    name: 'home.artists.artist',
                    params: {
                        id: this.artist.id
                    }
                });
            },
            ...mapActions('artists', [
                'updateAvatar'
            ])
        }
    }
</script>

<style scoped>
    .img-thumbnail {
        width: 300px;
        height: 300px;
    }
</style>
