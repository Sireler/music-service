import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

import auth from './modules/auth';
import songs from './modules/songs';
import player from './modules/player';
import artists from './modules/artists';
import albums from './modules/albums';

Vue.use(Vuex);
axios.defaults.baseURL = window.location.origin + '/api/v1';

export const store = new Vuex.Store({
    modules: {
        auth,
        player,
        songs,
        artists,
        albums
    },
    strict: process.env.NODE_ENV !== 'production'
});