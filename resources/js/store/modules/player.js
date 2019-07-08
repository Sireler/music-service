import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const player = {
    namespaced: true,
    state: {
        trackId: '',
        currentTrackUrl: '',
        play: false,
    },
    mutations: {
        setTrackUrl(state, id) {
            state.trackId = id;
            state.play = true;
            state.currentTrackUrl = axios.defaults.baseURL + '/song/' + id;
        },
        play(state) {
            state.play = true;
        },
        pause(state) {
            state.play = false;
        }
    },
    actions: {

    },
    getters: {

    }
};

export default player;