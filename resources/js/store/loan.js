import api from '../api/Api'

export default {
  state: {
    loanData: [],
    loanId: '',
    loanGuid: '',
    isExistLoan: false,
    isBlocked: false,
    blockedUntil: null,
    documents: [],
  },
  mutations: {
    loanData: (s, payload) => s.loanData = payload,
    loanId: (s, payload) => s.loanId = payload,
    loanGuid: (s, payload) => s.loanGuid = payload,
    isExistLoan: (s, payload) => s.isExistLoan = payload,
    documents: (s, payload) => s.documents = payload,
    isBlocked: (s, payload) => s.isBlocked = payload,
    blockedUntil: (s, payload) => s.blockedUntil = payload,
    addDocument: (s, payload) => {
      s.documents.push(payload)
    },
    resetCurrentLoanData: (s) => {
      s.loanData = []
      s.loanId = ''
      s.loanGuid = ''
      s.fillContractName = ''
      s.isExistLoan = false
      s.documents = []
    },
  },
  getters: {
    loanData: (s) => s.loanData,
    loanId: (s) => s.loanId,
    loanGuid: (s) => s.loanGuid,
    isExistLoan: (s) => s.isExistLoan,
    isBlocked: (s) => s.isBlocked,
    blockedUntil: (s) => s.blockedUntil,
    documents: (s) => s.documents.filter((item) => {
      return item.hide === "0";
    }),
    extendDocuments: (s) => s.documents.filter((item) => {
      return item.hide === "1";
    }),
    isExistSignContract: (s) => {
      const contract = s.documents.find(item => {
        return (item.name === 'Договор потребительского займа')
      });

      return !!contract;
    },
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
      const response = await api.createLoan(getters.sessionId, getters.getDays, getters.getSum, getters.smsCode, getters.get, getters.guid);
      commit('loanData', response.loan)
      commit('documents', response.documents)
      commit('loanGuid', response.loan.GUID)
      commit('isExistLoan', true)
    },
    async signContract({commit, getters}, payload) {
      await api.getSignContract(getters.guid, payload, getters.sessionId)
    },
    async getExtensionLoanDocuments({getters, commit}, {returnDate, smsCode}) {
      const documents = await api.getExtensionLoanDocuments(getters.sessionId, getters.loanGuid, returnDate, smsCode)
      documents.forEach((item) => {
        commit('addDocument', item)
      })
    },
    async extensionLoan({getters}, {returnDate, smsCode}) {
      return await api.extensionLoan(getters.loanGuid, returnDate, smsCode)
    },
    async isExistLoan({getters, commit}) {
      const response = await api.isExistLoan(getters.guid);
      if (response.data) {
        commit('isExistLoan', true);
        commit('loanGuid', response.data);
      } else {
        commit('isExistLoan', false);
      }
    },
    async getHistoryLoans({getters}) {
      return await api.getHistory(getters.guid);
    },
    clearExtendDocuments({getters, commit}) {
      const documents = _.remove(getters.documents, (n) => {
        return n.hide === 1
      })
      commit('documents', documents)
    },
    async cancelLoan({getters, commit}) {
      const response = await api.cancelLoan(getters.sessionId, getters.loanGuid)
      commit('resetCurrentLoanData');
      return response;
    }
  }
}
