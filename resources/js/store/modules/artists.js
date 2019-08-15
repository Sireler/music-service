import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const artists = {
    namespaced: true,
    state: {
        list: [],
        artist: {},
        artistSongs: {},
        artistAlbums: {},
        pageData: {},
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
        },
        setArtistAlbums(state, data) {
            state.artistAlbums = data;
        },
        setPageData(state, data) {
            state.pageData = data;
        }
    },
    actions: {
        getAll(context, page) {
            axios.get('/artists?page=' + page)
                .then(response => {
                    context.commit('setAll', response.data.data);
                    context.commit('setPageData', response.data);
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
        },
        getArtistAlbums(context, id) {
            axios.get('/artists/' + id + '/albums')
                .then(response => {
                    context.commit('setArtistAlbums', response.data.albums);
                });
        },
        updateAvatar(context, data) {
            return new Promise((resolve, reject) => {
                axios.post('/artists/' + data.id + '/update/avatar', data.file, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        }
    },
    getters: {

    }
};

export default artists;
