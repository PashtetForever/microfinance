import api from '../api/Api'
import _ from 'lodash'

export default {
  state: {
    loanData: [],
    loanId: '',
    loanGuid: '',
    fillContractName: '',
    isExistLoan: false,
    documents: []
  },
  mutations: {
    loanData: (s, payload) => s.loanData = payload,
    loanId: (s, payload) => s.loanId = payload,
    loanGuid: (s, payload) => s.loanGuid = payload,
    fillContractName: (s, payload) => s.fillContractName = payload,
    isExistLoan: (s, payload) => s.isExistLoan = payload,
    documents: (s, payload) => s.documents = payload,
  },
  getters: {
    loanData: (s) => s.loanData,
    loanId: (s) => s.loanId,
    loanGuid: (s) => s.loanGuid,
    fillContractName: (s) => s.fillContractName,
    isExistLoan: (s) => s.isExistLoan,
    documents: (s) => s.documents,
  },
  actions: {
    async getLoanData({getters, commit}) {
      const response = await api.getCurrentLoan(getters.sessionId, getters.guid);
      commit('loanData', response.loan);
      commit('loanId', response.loan.Number);
      commit('documents', response.documents);
      return response;
    },
    async createLoan({commit, getters}) {
      const response = await api.createLoan(getters.sessionId, getters.getSum, getters.getDays, getters.smsCode, getters.guid);
      commit('loanData', response.loan)
      commit('documents', response.documents)
      commit('loanGuid', response.loan.GUID)
    },
    async signContract({commit, getters}, payload) {
      await api.getSignContract(getters.guid, payload, getters.sessionId)
    },
    async getValidContract({getters, commit}) {
      return await api.getContractData(getters.sessionId, getters.loanGuid);
    },
    async loanReturn({getters}) {
      await api.Api1C.loanReturn(getters.sessionId, getters.guid)
    },

    async isExistLoan({getters, commit}) {
      const response = await api.ApiSite.isExistLoan(getters.guid);
      commit('isExistLoan', response.response);
      if (response.response)
        commit('loanGuid', response.loanGuid);
    },
    async extensionLoanTo1C({commit, getters}, payload) {
      await api.Api1C.extensionLoan(getters.loanGuid, payload.dateEndLoan)
    }
  }
}
