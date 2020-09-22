import api from '../api/Api'
import _ from 'lodash'

export default {
  state: {
    canBeExtended: false,
    contractData: undefined,
    sumPercent: 0,
    sumRepayment: 0
  },
  getters: {
    canBeExtended: (s) => s.canBeExtended,
    contractData: (s) => s.contractData,
    sumPercent: (s) => s.sumPercent,
    sumRepayment: (s) =>  s.sumRepayment,
  },
  mutations: {
    canBeExtended: (s, payload) => s.canBeExtended = payload,
    contractData: (s, payload) => s.contractData = payload,
    sumPercent: (s, payload) => s.sumPercent = payload,
    sumRepayment: (s, payload) => s.sumRepayment = payload,
  },
  actions: {
    async getContractData({getters, commit, dispatch}) {
      let result = await api.getContractData(getters.sessionId, getters.loanGuid)
      result.CanBeExtended = _.toNumber(result.CanBeExtended)

      commit('canBeExtended', result.CanBeExtended)
      commit('contractData', result)
      commit('sumRepayment', _.toNumber(result.PercentSum) + _.toNumber(result.Sum) + _.toNumber(result.Penalty))

      commit('sumPercent', _.toNumber(result.PercentSum) + _.toNumber(result.Penalty))

      if (!getters.email)
        await dispatch('loadContactData')
    },
  }
}
