import {createApp} from "vue";

require('./bootstrap');
window.Vue = require('vue').default;
import App from "./App.vue"
import router from "./router";
import axios from 'axios'
import store from "./store/store";
import VueAxios from 'vue-axios'

createApp(App)
    .use(VueAxios,axios)
    .use(router)
    .use(store)
    .mount("#app")
