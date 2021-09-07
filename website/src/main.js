import Vue from 'vue'
import axios from 'axios';
import moment from 'moment';
import store from './store';

import BootstrapVue from 'bootstrap-vue/dist/bootstrap-vue.esm';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'bootstrap/dist/css/bootstrap.css';

import App from './App.vue'
import VueRouter from 'vue-router'
import router from './router'

Vue.config.productionTip = false

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.prototype.moment = moment;
Vue.prototype.$http = axios;

moment.locale('pt-br');

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app')