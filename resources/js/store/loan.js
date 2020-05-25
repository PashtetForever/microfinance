import api from '../api/Api'
import _ from 'lodash'

export default {
  state: {
    loanData: [],
    loanId: '',
    loanGuid: '',
    fillContractName: '',
    isExistLoan: false,
  },
  mutations: {
    loanData: (s, payload) => s.loanData = payload,
    loanId: (s, payload) => s.loanId = payload,
    loanGuid: (s, payload) => s.loanGuid = payload,
    fillContractName: (s, payload) => s.fillContractName = payload,
    isExistLoan: (s, payload) => s.isExistLoan = payload,
  },
  getters: {
    loanData: (s) => s.loanData,
    loanId: (s) => s.loanId,
    loanGuid: (s) => s.loanGuid,
    fillContractName: (s) => s.fillContractName,
    isExistLoan: (s) => s.isExistLoan,
  },
  actions: {
    async getLoanData({getters, commit}) {
      const response = await api.Api1C.getCurrentLoan(getters.sessionId, getters.loanGuid);
      commit('loanData', response.body);
      commit('loanId', response.body.Number);
      return response.body;
    },
    async createLoan({commit, getters}) {
      const response = await api.createLoan(getters.sessionId, getters.getSum, getters.getDays);
      commit('loanGuid', response)
    },
    async getDocumentsByLoan({getters, commit}) {
      const response = await api.ApiSite.getDocumentsByLoan(getters.loanId, getters.guid, getters.loanGuid);
      return response.body;
    },

    async getFillContract({getters, commit}) {
      const response = await api.ApiSite.getFillContract(getters.sessionId, getters.loanGuid, getters.loanGuid);
      commit('fillContractName', response.contractFileName);
    },

    async checkContractSms({getters}, payload) {
      return await api.ApiSite.checkSmsSignContract(getters.phone, payload)
    },

    async getValidContract({getters, commit}) {
      const result = await api.Api1C.getValidContract(getters.sessionId, getters.loanGuid);
      result.body.Penalty = _.ceil(result.body.Penalty, 2);
      return result.body;
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
