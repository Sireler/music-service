import Vue from 'vue';
import Router from 'vue-router';
import {store} from '../store/store.js';

// Main '/'
import Main from '../components/Main';

// Auth
import Login from '../components/auth/Login';
import Logout from '../components/auth/Logout';

// User's home page
import Home from '../components/Home';

// Home _ childrens
import HomeAll from '../components/home/All';
import HomeAlbums from '../components/home/Albums';
import HomeArtists from '../components/home/Artists';

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
            meta: {
                requiresAuth: true,
            },
            children: [
                {
                    name: 'home.all',
                    path: 'all',
                    component: HomeAll
                },
                {
                    name: 'home.albums',
                    path: 'albums',
                    component: HomeAlbums
                },
                {
                    name: 'home.artists',
                    path: 'artists',
                    component: HomeArtists
                },
            ]
        },
        {
            name: 'login',
            path: '/login',
            component: Login,
            meta: {
                requiresVisitor: true,
            }
        },
        {
            name: 'logout',
            path: '/logout',
            component: Logout
        }
    ]
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!store.getters['auth/loggedIn']) {
            next({
                name: 'login',
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires visitor, check if logged in
        // if logged, redirect to home page.
        if (store.getters['auth/loggedIn']) {
            next({
                name: 'home',
            })
        } else {
            next()
        }
    } else {
        next()
    }
});


export default router;