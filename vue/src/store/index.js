import {createStore} from "vuex";
import axiosClient from "../axios.js";

const store = createStore({
  state: {
    // just to show the author, you get it
    user: {
      data: {
        name: 'Mike Nykytenko',
        email: 'ur7ez@ukr.net',
        github: 'https://github.com/ur7ez',
      },
    },
    // properties store data
    properties: {
      loading: false,
      data: [],
      links: [],
    },
    notification: {
      show: false,
      type: "success",
      message: "",
    },
  },
  getters: {},
  actions: {
    searchProperty({ commit, dispatch }, property) {
      commit('setPropertiesLoading', true);
      return axiosClient
        .post(`/search`, property)
        .then(({data}) => {
          commit('setPropertiesLoading', false);
          commit("setProperties", data);
          return data;
        });
    },
    getProperties({commit}, {url = null} = {}) {
      commit('setPropertiesLoading', true);
      url = url || "/property";
      return axiosClient.get(url)
        .then((res) => {
          commit('setPropertiesLoading', false);
          commit("setProperties", res.data);
          return res;
        });
    },
  },
  mutations: {
    setProperties: (state, properties) => {
      state.properties.links = properties.meta?.links ?? [];
      state.properties.data = properties.data;
    },
    setPropertiesLoading: (state, loading) => {
      state.properties.loading = loading;
    },
    notify: (state, {message, type}) => {
      state.notification.show = true;
      state.notification.type = type;
      state.notification.message = message;
      setTimeout(() => {
        state.notification.show = false;
      }, 5000);
    },
  },
  modules: {},
});

export default store;
