import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: {},
    categories: [],
    promos: [],
    populars: [],
    keySearch: "",
    cartItems: [],
    address: {}
  },
  mutations: {
    changeUser(state, payload) {
      state.user = payload;
    },

    changeCategories(state, payload) {
      state.categories = payload;
    },

    changePromos(state, payload) {
      state.promos = payload;
    },

    changePupulars(state, payload) {
      state.populars = payload;
    },

    changeKeySearch(state, payload) {
      state.keySearch = payload;
    },

    changeCartItems(state, payload) {
      state.cartItems = payload;
    },

    changeAddress(state, payload) {
      state.address = payload;
    }
  }
})
