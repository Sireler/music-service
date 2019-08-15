import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const albums = {
    namespaced: true,
    state: {
        albums: {},
        album: {},
        tracks: {},
        pageData: {}
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
        },
        setPageData(state, data) {
            state.pageData = data;
        }
    },
    actions: {
        getAlbums(context, page) {
            axios.get('/albums?page=' + page)
                .then(response => {
                    context.commit('setAlbums', response.data.data);
                    context.commit('setPageData', response.data);
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
};

export default albums;
