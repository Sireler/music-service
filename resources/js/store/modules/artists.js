import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const artists = {
    namespaced: true,
    state: {
        list: []
    },
    mutations: {
        setAll(state, data) {
            state.list = data;
        }
    },
    actions: {
        getAll(context) {
            axios.get('/artists')
                .then(response => {
                    console.log(response);
                    context.commit('setAll', response.data.artists);
                });
        }
    },
    getters: {

    }
};

export default artists;