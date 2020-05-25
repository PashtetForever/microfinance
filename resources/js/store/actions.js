export default {
  state: {
    errorText: '',
    loading: false,
    snackbar: false
  },
  getters: {
    loading(state) {
      return state.loading
    },
    snackbar(state) {
      return state.snackbar;
    },
    errorText(state) {
      return state.errorText;
    }
  },
  mutations: {
    snackbar(state, payload) {
      state.snackbar = payload;
    },
    setLoading(state, payload) {
      state.loading = payload;
    },
    errorText(state, payload) {
      state.errorText = payload;
    },
  },
  actions: {
    //todo: При повторной ошибке снакбар не показывается
    error({commit}, errorText) {
      commit('snackbar', true);
      commit('errorText', errorText);
    }
  }
}
