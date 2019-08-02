import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const albums = {
    namespaced: true,
    state: {
        albums: {},
        album: {},
        tracks: {}
    },
    mutations: {
        setAlbums(state, data) {
            state.albums = data;
        },
        setAlbum(state, data) {
            state.album = data;
        },
        setAlbumTracks(state, data) {
            state.tracks = data;
        }
    },
    actions: {
        getAlbums(context, id) {
            axios.get('/albums')
                .then(response => {
                    context.commit('setAlbums', response.data.albums);
                });
        },
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
