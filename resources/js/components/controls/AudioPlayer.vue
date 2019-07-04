<template>
    <div class="audio-controls col-md-12">
        <!-- audio element -->
        <vue-plyr ref="plyr" :options="{controls: [
                'restart',
                'play',
                'progress',
                'current-time',
                'duration',
                'mute',
                'volume'
        ]}">
            <audio>
                <source />
            </audio>
        </vue-plyr>
        <div class="controls mt-1">
            {{ trackUrl }}
        </div>
    </div>
</template>

<script>
    import { VuePlyr } from 'vue-plyr';

    import 'vue-plyr/dist/vue-plyr.css';

    export default {
        name: "AudioPlayer",
        components: {
            'vue-plyr': VuePlyr
        },
        props: ['trackUrl'],
        methods: {
            play() {
                this.setTrack();
                this.setVolume();
                this.player.play();
            },

            setTrack() {

            },

            setVolume() {
                this.player.volume = 0.05;
            },

            prevTrack() {

            },
            nextTrack() {

            }
        },

        computed: {
            player() {
                return this.$refs.plyr.player;
            }
        },

        watch: {
            trackUrl(url) {
                this.player.source = {
                    type: 'audio',
                    title: '',
                    sources: [
                        {
                            src: url,
                            type: 'audio/mp3',
                        }
                    ],
                };
                this.player.play();
            }
        }
    }
</script>

<style>
    .plyr--audio,
    .plyr__controls {
        background: transparent !important;
    }
</style>