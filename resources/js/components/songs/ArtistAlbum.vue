<template>
    <div class="col-lg-3 col-md-2 album my-2 bg-primary rounded p-2 text-light">
        <div class="card">
            <img class="card-img-top" :src="album.cover" alt="Card image cap">
            <div class="card-body text-secondary">
                <router-link :to="{ name: 'home.album', params: {id: album.id} }">{{ album.name }}</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ArtistAlbum",
        props: ['album']
    }
</script>

<style scoped>

</style>