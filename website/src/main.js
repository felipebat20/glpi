import Vue from 'vue'
import axios from 'axios';
import moment from 'moment';
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './router'

Vue.config.productionTip = false

Vue.use(VueRouter);
Vue.prototype.moment = moment;
Vue.prototype.$http = axios;

moment.locale('pt-br');

new Vue({
    router,
    render: h => h(App),
}).$mount('#app')