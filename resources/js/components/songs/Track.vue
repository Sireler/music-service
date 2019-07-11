<template>
    <div class="row track my-2 bg-primary rounded p-2 text-light">
        <div class="col-md-6">
            <span class="oi oi-play-circle m-1"
                  @click="play(track.id)"
                  v-show="playingId !== track.id || !playing"></span>
            <span class="oi oi-media-stop m-1"
                  @click="pause"
                  v-show="playingId === track.id && playing"></span>

            <span class="track-title">{{ track.title }}</span>
        </div>
        <div class="col-md-6">
            <div class="track float-right">
                {{ trackDuration }}
            </div>
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
            }),
            trackDuration() {
                let minutes = Math.floor(this.track.length / 60);
                let seconds = Math.floor(this.track.length % 60);

                return minutes + ':' + seconds;
            }
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