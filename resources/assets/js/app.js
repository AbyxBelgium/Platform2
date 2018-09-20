
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

Vue.use(VueMaterial);
Vue.use(VueRouter);

import AppComponent from './components/AppComponent';
import HomeComponent from './components/home/HomeComponent';
import LoginComponent from './components/authentication/LoginComponent';
import RegisterComponent from './components/authentication/RegisterComponent'

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
    router
});
