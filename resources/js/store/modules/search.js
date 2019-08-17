import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const search = {
    namespaced: true,
    state: {
        tracks: {},
        tracksCount: 0
    },
    mutations: {
        setTracks(state, data) {
            state.tracks = data;
        },
        setTracksCount(state, count) {
            state.tracksCount = count;
        }
    },
    actions: {
        search(context, query) {
            axios.get('/search?q=' + query)
                .then(response => {
                     context.commit('setTracks', response.data.tracks);
                     context.commit('setTracksCount', response.data.tracks_count);
                });
        }
    },
    getters: {

    }
};

export default search;
