import api from '../api/Api'

export default {
  getters: {
    personalContacts: (s) => {
      return s.personalContacts
    }
  },
  mutations: {
    setPersonalContacts(s, payload) {
      s.personalContacts = payload
    }
  },
  actions: {
    async loadPersonalContacts({getters, commit}) {
      const result = await api.getPersonalContacts(getters.sessionId);
      commit('setPersonalContacts', result);
      return result;
    },
    async setPersonalContacts({getters}, payload) {
      await api.setPersonalContacts(getters.sessionId, payload);
    }
  }
}
