<template>
    <div class="home-container">
        <div class="container-fluid">
            <div class="row">
                <!-- Left sidebar -->
                <nav class="col-md-2 d-none d-md-block bg-light sidebar position-fixed">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <router-link class="nav-link active" :to="{ name: 'home' }">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    Home <span class="sr-only">(current)</span>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link active" :to="{ name: 'home.all' }">
                                    All songs
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link active" :to="{ name: 'home.albums' }">
                                    Albums
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link active" :to="{ name: 'home.artists' }">
                                    Artists
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2 text-info">Home</h1>
                    </div>


                    <router-view class="text-secondary"></router-view>

                </main>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Home"
    }
</script>

<style scoped>

</style>