<template>
    <div class="row track my-2 bg-primary rounded p-2 text-light">
        <div class="col-md-2">
            <span class="oi oi-play-circle m-1"
                  @click="play(track.id)"
                  v-show="playingId !== track.id || !playing"></span>
            <span class="oi oi-media-stop m-1"
                  @click="pause"
                  v-show="playingId === track.id && playing"></span>
        </div>
        <div class="col-md-4">
            {{ track.title }}
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name: "Track",
        props: ['track'],
        computed: {
            ...mapState({
                playingId: state => state.player.trackId,
                playing: state => state.player.play
            })
        },
        methods: {
            play(id) {
                this.$store.commit('player/setTrackUrl', id);
            },
            pause() {
                this.$store.commit('player/pause');
            }
        }
    }
</script>

<style scoped>
    .oi-play-circle,
    .oi-media-stop{
        font-size: 1.25em;
        cursor: pointer;
    }
</style>