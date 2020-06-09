import Api from "../api/Api";

export default {
  state: {
    email: '',
    fio: '',
    phone: '',
    isVerifyEmail: false,
    userWebLink: ''
  },
  getters: {
    email: (state) => {
      return state.email
    },
    fio: (state) => {
      return state.fio
    },
    isVerifyEmail: (state) => {
      return state.isVerifyEmail
    },
    phone(state) {
      return state.phone;
    },
  },
  mutations: {
    email: (state, payload) => {
      state.email = payload;
    },
    fio: (state, payload) => {
      state.fio = payload
    },
    phone(state, payload) {
      state.phone = payload;
    },
    isVerifyEmail: (state, payload) => {
      state.isVerifyEmail = payload
    },
  },
  actions: {
    async loadContactData({commit, getters}) {
      const result = await Api.getContactData(getters.sessionId);
      commit('fio', result.FIO);
      commit('email', result.Email);
      if(result.Email !== false)
        commit('isVerifyEmail', true);
    },
    async setContactData({getters, commit}) {
      await Api.setContactData(getters.sessionId, getters.fio, getters.email);
    },
    async sendEmailCode({getters}) {
      return await Api.sendVerifyMail(getters.email, getters.guid);
    },
    async checkEmailCode({getters, commit}, payload) {
      const result = await Api.checkVerifyMail(getters.guid, payload);
      if (result == true) {
        commit('isVerifyEmail', true);
      }
      return result;
    },
  }
}
