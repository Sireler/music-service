import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const artists = {
    namespaced: true,
    state: {
        list: [],
        artist: {},
        artistSongs: {}
    },
    mutations: {
        setAll(state, data) {
            state.list = data;
        },
        set(state, data) {
            state.artist = data;
        },
        clearArtist(state) {
            state.artist = {};
            state.artistSongs = {};
        },
        setArtistSongs(state, data) {
            state.artistSongs = data;
        }
    },
    actions: {
        getAll(context) {
            axios.get('/artists')
                .then(response => {
                    context.commit('setAll', response.data.artists);
                });
        },
        get(context, id) {
            axios.get('/artists/' + id)
                .then(response => {
                    context.commit('set', response.data.artist);
                });
        },
        getArtistSongs(context, id) {
            axios.get('/artists/' + id + '/songs')
                .then(response => {
                    context.commit('setArtistSongs', response.data.songs);
                });
        }
    },
    getters: {

    }
};

export default artists;