import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const artists = {
    namespaced: true,
    state: {
        list: [],
        artist: {}
    },
    mutations: {
        setAll(state, data) {
            state.list = data;
        },
        set(state, data) {
            state.artist = data;
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
        }
    },
    getters: {

    }
};

export default artists;