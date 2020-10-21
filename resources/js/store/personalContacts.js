import api from '../api/Api'
import Vue from 'vue'

export default {
  state: {
    personalContacts: [],
    personalContactsForRemoved: []
  },
  getters: {
    personalContacts: s => {
      return s.personalContacts
    },
    personalContactsForRemoved: s => {
      return s.personalContactsForRemoved
    },
    filledContacts: (s) => {
      return s.personalContacts.filter((item) => {
        return item.isValid === true
      })
    },
    isValidAllItems: (s) => {
      let isValid = true;

      for (let contact of s.personalContacts) {
        if(contact.isValid === false)
          isValid = false
      }

      return isValid
    }
  },
  mutations: {
    setPersonalContacts(s, payload) {
      s.personalContacts = payload
    },
    addPersonalContactForRemove(s, payload) {
      s.personalContactsForRemoved.push({
        GUID: payload.guid,
        PhoneNumber: null,
        Name: null
      })
    },
    addEmptyPersonalContact(s) {
      s.personalContacts.push({
        key: s.personalContacts.length,
        isValid: false
      })
    },
    removePersonalContactByKey(s, payload) {
      s.personalContacts = s.personalContacts.filter((item) => {
        return item.key !== payload
      })
    },
    updatePersonalContact(s, payload) {
      Vue.set(s.personalContacts, payload.key, payload)
    },
    clearContactsForRemove(s) {
      s.personalContactsForRemoved = []
    }
  },
  actions: {
    async loadPersonalContacts({getters, commit}) {
      let result = await api.getPersonalContacts(getters.sessionId);

      result = result.map((item, index) => {
        const name = item.Name.split(' ');
        return {
          lastName: name[0],
          firstName: name[1],
          middleName: name[2],
          isValid: !!(name[0] && name[1] && name[2] && item.PhoneNumber),
          guid: item.GUID,
          phone: item.PhoneNumber,
          key: index
        }
      });

      if (result.length < 2) {
        for (let i = result.length; i < 2; i++) {
          commit('addEmptyPersonalContact');
        }
      }

      commit('setPersonalContacts', result);
      return result;
    },
    async setPersonalContacts({getters}) {
      let data = getters.personalContacts.map((item) => {
        if(!item.isValid)
          return;

        return {
          Name: `${item.lastName} ${item.firstName} ${item.middleName}`,
          PhoneNumber: item.phone,
          GUID: item.guid ?? null
        }
      })

      data = data.concat(getters.personalContactsForRemoved);

      await api.setPersonalContacts(getters.sessionId, data);
    }
  }
}
