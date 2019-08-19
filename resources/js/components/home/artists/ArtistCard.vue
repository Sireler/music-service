<template>
    <div class="card rounded-0 border border-primary">
        <img :src="artist.image ? artist.image : '/storage/default-avatar.png'" alt="artist" class="card-img-top">
        <div class="card-body">
            <router-link :to="{ name: 'home.artists.artist', params: { id: artist.id } }">
                {{ artist.name }}
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ArtistCard",
        props: ['artist']
    }
</script>

<style scoped>

</style>
