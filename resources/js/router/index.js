import Vue from 'vue';
import Router from 'vue-router';

import Main from '../components/Main';
import Home from '../components/Home';

// Auth
import Login from '../components/auth/Login';

Vue.use(Router);

const router = new Router({
    mode: 'history',
    routes: [
        {
            name: 'main',
            path: '/',
            component: Main
        },
        {
            name: 'home',
            path: '/home',
            component: Home,
        },
        {
            name: 'login',
            path: '/login',
            component: Login
        }
    ]
});


export default router;