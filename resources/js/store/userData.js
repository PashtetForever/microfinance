import api from "../api/Api";

export default {
  state: {
    userData: [],
    isChangedData: false,
  },
  getters: {
    userData(state) {
      return state.userData;
    },
    isChangedData(state) {
      return state.isChangedData;
    },
  },
  mutations: {
    userData(state, payload) {
      state.userData = payload;
    },
    isChangedData(state, payload) {
      state.isChangedData = payload;
    },
  },
  actions: {
    async requestUserData({getters, commit}) {
      const result = await api.getUserData(getters.sessionId);
      commit('userData', result);
      return result;
    },
    async setUserData({getters}, payload) {
      await api.setUserData(getters.sessionId, payload);
    },
    isChangedData({commit}, payload) {
      commit('isChangedData', payload);
    },
  }
}
