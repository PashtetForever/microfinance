import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";

import user from './user';
import contactData from "./contactData";
import userData from "./userData";
import personalContacts from "./personalContacts";
import mandarin from "./mandarin";
import loan from "./loan";
import contract from "./contract";
import actions from "./actions";

Vue.use(Vuex);

export default new Vuex.Store({
  plugins: [createPersistedState({
    storage: window.sessionStorage,
    paths: ['user', 'contactData', 'userData', 'mandarin', 'personalContacts', 'loan', 'contract']
  })],
  modules: {user, contactData, userData, personalContacts, mandarin, actions, loan, contract}
})
