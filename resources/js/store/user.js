import moment from "moment"
import Api from "../api/Api";

export default {
  state: {
    sessionId: null,
    sum: 1000,
    days: 1,
    authError: false,
    isVerify: false,
    isAuthorized: false,
    guid: '',
    dateEndLoan: '',
  },
  getters: {
    dateEndLoan: (state, getters) => moment().add(getters.getDays, 'd').format('DD.MM.YYYY'),
    sessionId(state) {
      return state.sessionId;
    },
    isAuthorized(state) {
      return state.isAuthorized;
    },
    getDays(state) {
      return state.days;
    },
    getSum(state) {
      return state.sum;
    },
    authError(state) {
      return state.authError;
    },
    isVerify(state) {
      return state.isVerify;
    },
    guid(state) {
      return state.guid;
    },
  },
  mutations: {
    sessionId(state, payload) {
      state.sessionId = payload;
    },
    setDays(state, payload) {
      state.days = payload
    },
    setSum(state, payload) {
      state.sum = payload
    },
    authError(state, payload) {
      state.authError = payload;
    },
    isVerify(state, payload) {
      state.isVerify = payload;
    },
    guid(state, payload) {
      state.guid = payload;
    },
    isAuthorized(state, payload) {
      state.isAuthorized = payload;
    },
    dateEndLoan(state, payload) {
      state.dateEndLoan = payload;
    },
  },
  actions: {
    dateEndLoan: ({commit, getters}) => {
      const endDate = moment.now().add(getters.days, 'days');
      commit('dateEndLoan', endDate)
    },
    async logoutUser() {
      await window.localStorage.removeItem('vuex');
      window.localStorage.vuex = null;
    },
    async userLogin({commit, dispatch}, payload) {
      const response = await Api.login(payload.login, payload.password, payload.phone);
      console.log(response);
      commit('sessionId', response.SessionId);
      commit('guid', response.GUID);
      commit('phone', payload.phone);
      return response;
    },
    async checkVerificationCode({commit, getters, dispatch}, payload) {
      const result = await Api.checkAuthVerifyCode(getters.phone, payload.code);
      console.log(result);
      if(result)
        commit('isVerify', true);
      return result;
    },
    async sendPhoneVerifyCode({getters}){
      await Api.sendSmsCode(getters.phone);
    },
    setSum({commit}, payload) {
      commit('setSum', payload);
    },
    setDays({commit}, payload) {
      commit('setDays', payload);
    },
    async changeOldPassword({getters}, {oldPassword, newPassword}) {
      return await Api1C.changePassword(getters.sessionId, oldPassword, newPassword);
    }
  }
}
