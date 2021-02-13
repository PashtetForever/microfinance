import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import router from './router'
import vuetify from './plugins/vuetify';
import Vuelidate from 'vuelidate';
import middlewarePipeline from "./router/middlewarePipeline"

import App from './components/App';
import Auth from './components/Login/Auth'
import OrderForm from './components/NewLoan/OrderForm'
import DataTable from "./components/NewLoan/DataTable"
import Navigation from './components/shared/Navigation'
import Headers from "./components/shared/Headers";
import OrderFormMin from "./components/shared/OrderFormMin";
import ContactData from "./components/NewLoan/ContactData";

Vue.config.productionTip = false;
Vue.use(VueRouter)
Vue.use(Vuelidate);

Vue.component('app-auth', Auth);
Vue.component('app-order-form', OrderForm);
Vue.component('app-data-table', DataTable);
Vue.component('app-nav', Navigation);
Vue.component('app-headers', Headers);
Vue.component('app-order-form-min', OrderFormMin);
Vue.component('app-contact-data', ContactData);

router.beforeEach((to, from, next) => {
  if (!to.meta.middleware) {
    return next()
  }
  const middleware = to.meta.middleware
  const context = {
    to,
    from,
    next,
    store
  }
  return middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1)
  })
})

new Vue({
  store,
  router,
  render: h => h(App),
  vuetify,
  components: {App}
}).$mount('#app');
