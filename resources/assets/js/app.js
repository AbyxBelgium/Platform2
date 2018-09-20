
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

import AppComponent from './components/AppComponent.vue';
import HomeComponent from './components/home/HomeComponent.vue';

const router = new VueRouter({
    mode: 'history',
    base: 'backend',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeComponent
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { AppComponent },
    router
});
