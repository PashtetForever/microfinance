import api from '../api/Api'
import _ from 'lodash'

export default {
  state: {
    canBeExtended: false,
    contractData: undefined,
    sumPercent: 0
  },
  getters: {
    canBeExtended: (s) => s.canBeExtended,
    contractData: (s) => s.contractData,
    sumPercent: (s) => s.sumPercent
  },
  mutations: {
    canBeExtended: (s, payload) => s.canBeExtended = payload,
    contractData: (s, payload) => s.contractData = payload,
    sumPercent: (s, payload) => s.sumPercent = payload,
  },
  actions: {
    async getContractData({getters, commit, dispatch}) {
      let result = await api.getContractData(getters.sessionId, getters.loanGuid)
      result.CanBeExtended = _.toNumber(result.CanBeExtended)
      result.PercentSum = _.round(_.toNumber(result.PercentSum) + _.toNumber(result.Penalty), 2)

      commit('canBeExtended', result.CanBeExtended)
      commit('contractData', result)

      let summ = result.Sum;
      summ = +summ.replace(/\s/g, '');
      summ = _.ceil(_.toNumber(result.PercentSum) + _.toNumber(result.Penalty) + summ, 2)
      commit('sumPercent', summ)

      if (!getters.email)
        await dispatch('loadContactData')
    },
  }
}
