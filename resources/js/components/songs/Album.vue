<template>
    <div class="col-lg-3 col-md-2 album my-2 bg-primary rounded p-2 text-light">
        <div class="card">
            <img class="card-img-top" src="https://avatars.yandex.net/get-music-content/99892/13e72980.p.4353492/200x200" alt="Card image cap">
            <div class="card-body text-secondary">
                {{ album.name }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Album",
        props: ['album']
    }
</script>

<style scoped>

</style>