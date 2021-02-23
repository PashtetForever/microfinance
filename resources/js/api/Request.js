import axios from "axios"
import store from "../store"

export default class {
  static async request(method, url, data) {

    store.commit('setLoading', true);

    return await axios({
      method,
      url,
      data,
      baseURL: process.env.APP_URL
    })
      .then((response) => {
        return response.data.original ?? response.data;
      })
      .catch((error) => {
        throw store.dispatch('error', error.response.data.error ?? error.response.data.message)
      })
      .finally(() => {
        store.commit('setLoading', false)
      });
  }
}
