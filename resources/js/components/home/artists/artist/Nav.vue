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
            <div class="tab-pane fade show active" id="tracks" role="tabpanel" aria-labelledby="tracks-tab">Tracks</div>
            <div class="tab-pane fade" id="albums" role="tabpanel" aria-labelledby="albums-tab">Albums</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Nav"
    }
</script>

<style scoped>

</style>