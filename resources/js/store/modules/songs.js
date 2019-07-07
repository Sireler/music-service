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
        updateArtist(state, artist) {
            state.uploadInfo.artist = artist;
        },
        updateTitle(state, title) {
            state.uploadInfo.title = title;
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
                        context.commit('setUploadInfo', {
                            title: response.data.info.title,
                            artist: response.data.info.artist,
                            image: response.data.info.image,
                            filename: response.data.info.filename,
                            length: response.data.info.length
                        });

                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });
        },

        storeTrack(context) {
            return new Promise((resolve, reject) => {
                axios.post('/song/create', context.state.uploadInfo)
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
        percentCompleted(state) {
            return state.uploadProgress + '%';
        }
    }
};

export default songs;