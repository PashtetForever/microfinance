import Vuetify from "vuetify";

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import router from './router'
import vuetify from './plugins/vuetify';
import Vuelidate from 'vuelidate';

import App from './components/App';
import Auth from './components/Auth'
import OrderForm from './components/OrderForm'
import DataTable from "./components/DataTable"
import Navigation from './components/shared/Navigation'
import Headers from "./components/shared/Headers";
import OrderFormMin from "./components/shared/OrderFormMin";
import ContactData from "./components/ContactData";

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
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.isAuthorized)
            next('/login');
        else
            next()
    } else next()
});

new Vue({
    store,
    router,
    render: h => h(App),
    vuetify,
    components: {App}
}).$mount('#app');
