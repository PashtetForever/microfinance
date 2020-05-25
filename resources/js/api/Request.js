import Vue from "vue"
import axios from "axios"
import store from "../store"

export default class {
  static async request(method, url, data) {
    store.commit('setLoading', true);

    return await axios({
      method,
      url,
      data
    })
      .then((response) => {
        return response.data.original ?? response.data;
      })
      .catch((error) => {
      return store.dispatch('error', error.response.data.error)
    })
      .finally(() => {
        store.commit('setLoading', false)
    });
  }
}
