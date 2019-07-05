import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const songs = {
    namespaced: true,
    state: {
        songs: [],
    },
    mutations: {

    },
    actions: {
        getAllSongs(context, data) {
            return new Promise((resolve, reject) => {
                axios.get('/songs')
                    .then(response => {
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },
    },
    getters: {

    }
};

export default songs;