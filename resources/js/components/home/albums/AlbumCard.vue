<template>
    <div class="card rounded-0 border border-primary">
        <img :src="album.cover ? album.cover : '/storage/default-avatar.png'" alt="album" class="card-img-top">
        <div class="card-body">
            <router-link :to="{ name: 'home.album', params: { id: album.id } }">
                {{ album.name }}
            </router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AlbumCard",
        props: ['album']
    }
</script>

<style scoped>

</style>
