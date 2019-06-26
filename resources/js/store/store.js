import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);
axios.defaults.baseURL = window.location.origin + '/api';

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
    },
    mutations: {
        retrieveToken(state, token) {
            state.token = token;
        }
    },
    actions: {
        retrieveToken(context, credentials) {

            return new Promise((resolve, reject) => {
                axios.post('/login', {
                    username: credentials.username,
                    password: credentials.password,
                })
                    .then(response => {
                        const token = response.data.access_token;

                        localStorage.setItem('access_token', token);
                        context.commit('retrieveToken', token);
                        resolve(response);
                    })
                    .catch(error => {
                        reject(error);
                    });
            });


        }
    }
});