import api from "../api/Api";

export default {
  state: {
    userData: [],
    resultData: [],
    isChangedData: false,
  },
  getters: {
    userData(state) {
      return state.userData;
    },
    resultData(state) {
      return state.resultData;
    },
    isChangedData(state) {
      return state.isChangedData;
    },
    userDob(state) {
      return state.userData.find((item) => {
        return item.Name === 'Дата рождения'
      }).CurrentValue
    }
  },
  mutations: {
    userData(state, payload) {
      state.userData = payload
    },
    setResultData(state, payload) {
      state.resultData = payload
    },
    isChangedData(state, payload) {
      state.isChangedData = payload
    },
    updateProperty(state,{code, value}) {
      state.resultData.forEach((item, key) => {
        if(code === item.Code)
          state.resultData[key].Value = value
      })
    }
  },
  actions: {
    async requestUserData({getters, commit}) {
      const result = await api.getUserData(getters.sessionId)
      commit('userData', result);

      let resultData = []

      result.forEach(item => {
        if(item.Code === undefined && item.CurrentValue === undefined)
          return;

        resultData.push({
          Code: item.Code,
          Value: item.CurrentValue
        })
      })

      commit('setResultData', resultData)

      return result;
    },
    async setUserData({getters}) {
      await api.setUserData(getters.sessionId, getters.resultData)
    },
    isChangedData({commit}, payload) {
      commit('isChangedData', payload);
    },
  }
}
