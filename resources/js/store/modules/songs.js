import axios from 'axios';
axios.defaults.baseURL = window.location.origin + '/api/v1';

const songs = {
    namespaced: true,
    state: {
        songs: [],
        uploadProgress: 0,
        uploadInfo: {}
    },
    mutations: {
        setProgress(state, progress) {
            state.uploadProgress = progress;
        },
        setUploadInfo(state, info) {
            state.uploadInfo = info;
        },
        updateInfo(state, info) {
            state.uploadInfo[info.i][info.key] = info.value;
        }
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

        upload(context, data) {
            const options = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress: function(progressEvent) {
                    let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    context.commit('setProgress', percentCompleted);
                }
            };

            return new Promise((resolve, reject) => {
                axios.post('/songs/upload', data, options)
                    .then(response => {
                        context.commit('setUploadInfo', response.data.info);

                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },

        storeTrack(context) {
            return new Promise((resolve, reject) => {
                axios.post('/song/create', { tracks: context.state.uploadInfo })
                    .then(response => {
                        context.commit('setProgress', 0);
                        context.commit('setUploadInfo', {});

                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        }
    },
    getters: {
        percentCompleted(state) {
            return state.uploadProgress + '%';
        }
    }
};

export default songs;
