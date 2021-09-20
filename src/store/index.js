import Vue from 'vue'
import Vuex from 'vuex'
import axios from '../axios'

Vue.use(Vuex)

const state = {
  offcanvas: false,
  alphabetical: false
}

const getters = {
  offcanvas: state => state.offcanvas,
  alphabetical: state => state.alphabetical
}

const mutations = {
  setOffcanvas(state, offcanvas) {
    state.offcanvas = offcanvas
  },
  setAlphabetical(state, alphabetical) {
    state.alphabetical = alphabetical
  }
}

const actions = {
  async appAxios(_context, args) {
    const response = await axios(args)
    return response
  }
}

const modules = {}

export default new Vuex.Store({
  state,
  getters,
  mutations,
  actions,
  modules
})
