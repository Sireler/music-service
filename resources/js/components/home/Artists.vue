<template>
    <div class="artists">
        <h2>Artists</h2>
        <div class="row">
            <div class="col-lg-3 col-md-4 mb-4"
                 v-for=""
                 @click="toArtist">
                <div class="card artist-card">
                    <img src="" alt="artist" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Artist</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Artists",
        methods: {
            toArtist() {

            }
        }
    }
</script>

<style scoped>

</style>