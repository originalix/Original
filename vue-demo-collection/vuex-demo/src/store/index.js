import Vue from 'vue';
import Vuex from 'vuex';
import actions from './actions';
import mutations from './mutations';
import counter from './modules/counter';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {},
  mutations,
  actions,
  modules: {
    counter,
  },
});
