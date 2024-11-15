// store/index.js
import { createStore } from 'vuex';

const store = createStore({
  state: {
    // Your state properties here
    message: 'Hello from Vuex'
  },
  mutations: {
    setMessage(state, message) {
      state.message = message;
    },
  },
  actions: {
    updateMessage({ commit }, message) {
      commit('setMessage', message);
    },
  },
  getters: {
    getMessage(state) {
      return state.message;
    },
  },
});

export default store;
