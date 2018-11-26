import {
  INCREMENT,
  DECREMENT,
} from '../mutation-types';

const state = {
  count: 0,
};

const mutations = {
  /* eslint no-shadow: ["error", { "allow": ["state"] }] */
  [INCREMENT](state) {
    state.count += 1;
  },
  [DECREMENT](state) {
    state.count -= 1;
  },
};

const actions = {
  [INCREMENT]({ commit }) {
    setTimeout(() => {
      commit('increment');
    }, 50);
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
