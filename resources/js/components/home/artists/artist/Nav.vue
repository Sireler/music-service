<template>
    <div class="artist-navtab">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tracks-tab" data-toggle="tab" href="#tracks" role="tab" aria-controls="tracks" aria-selected="true">Tracks</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="albums-tab" data-toggle="tab" href="#albums" role="tab" aria-controls="albums" aria-selected="false">Albums</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tracks" role="tabpanel" aria-labelledby="tracks-tab">
                <div class="col-md-8">
                    <div class="track" v-for="track in tracks">
                        <Track :track="track"></Track>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="albums" role="tabpanel" aria-labelledby="albums-tab">
                <div class="col-md-12">
                    <div class="album" v-for="album in albums">
                        <Album :album="album"></Album>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Track from '../../../songs/Track';
    import Album from '../../../songs/ArtistAlbum';

    export default {
        name: "Nav",
        props: ['tracks', 'albums'],
        components: {
            Track,
            Album
        }
    }
</script>

<style scoped>

</style>