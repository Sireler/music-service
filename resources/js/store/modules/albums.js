import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const albums = {
    namespaced: true,
    state: {
        album: {},
        tracks: {}
    },
    mutations: {
        setAlbum(state, data) {
            state.album = data;
        },
        setAlbumTracks(state, data) {
            state.tracks = data;
        }
    },
    actions: {
        getAlbum(context, id) {
            axios.get('/albums/' + id)
                .then(response => {
                    context.commit('setAlbum', response.data.album);
                });
        },
        getAlbumTracks(context, id) {
            axios.get('/albums/' + id + '/tracks')
                .then(response => {
                    context.commit('setAlbumTracks', response.data.tracks);
                });
        }
    },
    getters: {

    }
};

export default albums;