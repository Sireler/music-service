<template>
    <nav class="col-md-2 d-none d-md-block bg-light sidebar position-fixed border-primary border-right">
        <div class="sidebar-sticky">
            <ul class="nav nav-pills flex-column pt-2">
                <li class="nav-item active">
                    <router-link class="nav-link" :to="{ name: 'home' }" exact-active-class="active">
                        <span class="oi oi-home"></span>
                        Home
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{ name: 'home.all' }" active-class="active">
                        <span class="oi oi-musical-note"></span>
                        All songs
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
                <hr>
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

<style scoped>
    nav {
        margin-top: -100px;
        padding-top: 100px;
        height: 200%;
        z-index: 1;
    }
</style>
