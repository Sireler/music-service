import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const player = {
    namespaced: true,
    state: {
        currentTrackUrl: '',
    },
    mutations: {
        setTrackUrl(state, id) {
            state.currentTrackUrl = axios.defaults.baseURL + '/song/' + id;
        }
    },
    actions: {

    },
    getters: {

    }
};

export default player;