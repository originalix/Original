import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    count: 0,
    todos: [
      { id: 1, text: 'this 1', done: true },
      { id: 2, text: 'this 2', done: false },
      { id: 3, text: 'this 3', done: true },
      { id: 4, text: 'this 4', done: false },
    ],
  },
  getters: {
    doneTodos: state => state.todos.filter(todo => todo.done),
  },
  mutations: {
    increment: state => state.count += 1,
    decrement: state => state.count -= 1,
  },
  actions: {
    increment({ commit }) {
      // context.commit('increment');
      setTimeout(() => {
        commit('increment');
      }, 1500);
    },
  },
});
