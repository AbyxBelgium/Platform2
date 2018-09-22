
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
import VueMaterial from 'vue-material'
import VueRouter from 'vue-router'
import Vuex from 'vuex';

Vue.use(VueMaterial);
Vue.use(VueRouter);
Vue.use(Vuex);

import AppComponent from './components/AppComponent';
import HomeComponent from './components/home/HomeComponent';
import LoginComponent from './components/authentication/LoginComponent';
import RegisterComponent from './components/authentication/RegisterComponent'

const store = new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem('token')
    },
    mutations: {
        LOGIN(state) {
            state.pending = true;
        },
        LOGIN_SUCCESSFUL(state) {
            state.isLoggedIn = true;
            state.pending = false;
        },
        LOGOUT(state) {
            state.isLoggedIn = false;
        }
    },
    actions: {
        login({commit}, creds) {
            commit("LOGIN");
            return new Promise(resolve => {
                let formData = new FormData();
                formData.set('client_id', '4');
                formData.set('client_secret', '5bRC8rM4BCtCmvZHyfRreh1talXfzfBH12p791dl');
                formData.set('grant_type', 'password');
                formData.set('username', creds.email);
                formData.set('password', creds.password);
                formData.set('scope', '');
                axios.post('/oauth/token', formData).then(response => {
                    localStorage.token = response.data.access_token;
                    localStorage.refreshToken = response.data.refresh_token;
                    commit("LOGIN_SUCCESSFUL");
                    resolve();
                });
            })
        },
        logout({commit}) {
            localStorage.removeItem("token");
            commit("LOGOUT");
        }
    },
    getters: {
        isLoggedIn: state => {
            return state.isLoggedIn;
        }
    }
});

const router = new VueRouter({
    mode: 'history',
    base: 'backend',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeComponent
        },
        {
            path: '/login',
            name: 'login',
            component: LoginComponent
        },
        {
            path: '/register',
            name: 'register',
            component: RegisterComponent
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { AppComponent },
    router,
    store
});
