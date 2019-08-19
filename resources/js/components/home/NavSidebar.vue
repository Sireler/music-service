<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'home' }" exact-active-class="active">
                        <span class="oi oi-home"></span>
                        Home
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'home.all' }" active-class="active">
                        <span class="oi oi-musical-note"></span>
                        Releases
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'home.albums' }" active-class="active">
                        <span class="oi oi-media-play"></span>
                        Albums
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'home.artists' }" active-class="active">
                        <span class="oi oi-person"></span>
                        Artists
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'home.upload' }" active-class="active">
                        <span class="oi oi-data-transfer-upload"></span>
                        Upload
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "NavSidebar"
    }
</script>

<style lang="scss" scoped>
    @import '../../../sass/variables';

    .active {
        color: $primary !important;
    }
</style>
