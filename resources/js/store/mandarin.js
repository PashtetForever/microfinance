import api from '../api/Api'

export default {
  state: {
    mandarinId: '',
    smsId: '',
    userWebLink: '',
    smsCode: '',
  },
  mutations: {
    mandarinId: (state, payload) => state.mandarinId = payload,
    smsId: (state, payload) => state.smsId = payload,
    userWebLink: (state, payload) => state.userWebLink = payload,
    smsCode: (state, payload) => state.smsCode = payload,
  },
  getters: {
    mandarinId: (state) => state.mandarinId,
    smsId: (state) => state.smsId,
    userWebLink: (state) => state.userWebLink,
    smsCode: (state) => state.smsCode,
  },
  actions: {
    async startPersonIdentification({commit, getters}) {
      let nameArray = getters.fio.split(' ');

      let storeData = Object.values(getters.userData);
      let passportNumber;
      let passportSeries;
      for (let item of storeData) {
        if (item.Passport) {
          passportNumber = item.Passport.Number;
          passportSeries = item.Passport.Series;
        }
      }
      let snils = storeData.find((item) => item.Name === 'СНИЛС').CurrentValue;
      snils = snils.replace(' ', '').replace(/-/g, '');
      const phone = getters.phone.replace(/[^+\d]/g, '');
      const body = {
        lastName: nameArray[0],
        firstName: nameArray[1],
        patronymic: nameArray[2],
        passportNumber,
        passportSeries,
        snils,
        phone
      };
      const response = await api.mandarinIdentify(body);
      if (response.id)
        commit('smsId', response.id);
    },
    async fullBinding({getters, commit}) {
      const result = await api.mandarinBinding(getters.email, getters.phone);
      await api.setMandarinId(getters.sessionId, result.id, getters.phone, getters.email);
      commit('mandarinId', result.id);
      commit('userWebLink', result.userWebLink);
    },
    /**
     * setPersonConfirmCode
     * @param commit
     * @param getters
     * @param payload
     * @returns {Promise<void>}
     */
    async sendMandarinSmsCode({commit, getters}, payload) {
      const result = await api.mandarinCheckSms(getters.smsId, payload);
      if (result.id)
        commit('smsId', result.id)
    },
    async checkMandarinSmsStatus({getters}) {
      const result = await api.mandarinGetIdentify(getters.smsId);
      return result.phoneVerified;
    },
    async repayment({getters}, payload) {
      return await api.repayment(getters.loanGuid, payload, getters.email)
    },
    async extensionPayPercent({getters}, payload) {
      return await api.extensionPayPercent(getters.loanGuid, payload, getters.email)
    }
  }
}
