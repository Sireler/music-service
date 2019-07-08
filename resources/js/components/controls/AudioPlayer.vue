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
            {{ track }}
        </div>
    </div>
</template>

<script>
    import { VuePlyr } from 'vue-plyr';
    import 'vue-plyr/dist/vue-plyr.css';

    import { mapState, mapMutations } from 'vuex';

    export default {
        name: "AudioPlayer",
        components: {
            'vue-plyr': VuePlyr
        },
        computed: {
            player() {
                return this.$refs.plyr.player;
            },
            ...mapState({
                track: state => state.player.currentTrackUrl,
                playing: state => state.player.play
            }),
        },
        methods: {
            ...mapMutations('player', [
                'play',
                'pause'
            ])
        },
        watch: {
            track(url) {
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
            },
            playing(p) {
                if (p) {
                    this.player.play();
                } else {
                    this.player.pause();
                }
            }
        },

        mounted() {
            this.player.on('play', () => {
                this.play();
            });

            this.player.on('pause', () => {
                this.pause();
            });
        }
    }
</script>

<style>
    .plyr--audio,
    .plyr__controls {
        background: transparent !important;
    }
</style>