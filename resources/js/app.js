
import Vue from 'vue';
import router from './router'
import App from './components/App.vue';
import Vuetify from './vuetify';
import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios, axios);

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router,
    Vuetify
});
