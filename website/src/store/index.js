import Vue from 'vue';
import Vuex from 'vuex';

import user from './modules/user';
import call from './modules/call';
import calls from './modules/calls';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    user,
    calls,
    call,
  }
});
