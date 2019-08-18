import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const search = {
    namespaced: true,
    state: {
        tracks: {},
        albums: {},
        tracksCount: 0,
        albumsCount: 0
    },
    mutations: {
        setTracks(state, data) {
            state.tracks = data;
        },
        setTracksCount(state, count) {
            state.tracksCount = count;
        },
        setAlbums(state, data) {
            state.albums = data;
        },
        setAlbumsCount(state, count) {
            state.albumsCount = count;
        }
    },
    actions: {
        search(context, query) {
            axios.get('/search?q=' + query)
                .then(response => {
                     context.commit('setTracks', response.data.tracks);
                     context.commit('setTracksCount', response.data.tracks_count);

                     context.commit('setAlbums', response.data.albums);
                     context.commit('setAlbumsCount', response.data.albums_count);
                });
        }
    },
    getters: {

    }
};

export default search;
