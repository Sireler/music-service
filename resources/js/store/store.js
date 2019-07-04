import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

import auth from './modules/auth';
import songs from './modules/songs';

Vue.use(Vuex);
axios.defaults.baseURL = window.location.origin + '/api/v1';

export const store = new Vuex.Store({
    modules: {
        auth,
        songs
    }
});