import api from '../api/Api'

export default {
  state: {
    loanData: [],
    loanId: '',
    loanGuid: '',
    fillContractName: '',
    isExistLoan: false,
    documents: [],
  },
  mutations: {
    loanData: (s, payload) => s.loanData = payload,
    loanId: (s, payload) => s.loanId = payload,
    loanGuid: (s, payload) => s.loanGuid = payload,
    fillContractName: (s, payload) => s.fillContractName = payload,
    isExistLoan: (s, payload) => s.isExistLoan = payload,
    documents: (s, payload) => s.documents = payload,
    addDocument: (s, payload) => { s.documents.push(payload) }
  },
  getters: {
    loanData: (s) => s.loanData,
    loanId: (s) => s.loanId,
    loanGuid: (s) => s.loanGuid,
    fillContractName: (s) => s.fillContractName,
    isExistLoan: (s) => s.isExistLoan,
    documents: (s) => s.documents.filter((item) => {
      return item.hide === 0;
    }),
    extendDocuments: (s) => s.documents.filter((item) => {
      return item.hide === 1;
    }),
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
      const response = await api.createLoan(getters.sessionId, getters.getDays, getters.getSum, getters.smsCode, getters.guid);
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
      await api.loanReturn(getters.sessionId, getters.guid)
    },
    async getExtensionLoanDocuments({getters}, {returnDate, smsCode}) {
      return await api.getExtensionLoanDocuments(getters.sessionId, getters.loanGuid, returnDate, smsCode)
    },
    async extensionLoan({getters}, payload) {
      return await api.extensionLoan(getters.loanGuid, payload)
    },
    async isExistLoan({getters, commit}) {
      const response = await api.isExistLoan(getters.guid);
      if(response.data) {
        commit('isExistLoan', true);
        commit('loanGuid', response.data);
      } else {
        commit('isExistLoan', false);
      }
    },
  }
}
