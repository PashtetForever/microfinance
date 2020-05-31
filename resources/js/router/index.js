import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.MIX_ROUTER_PATH,
    routes: [
        {
            path: '/login',
            name: 'login',
            component: () => import('../components/Auth')
        },
        {
            path: '/verify',
            name: 'verify',
            component: () => import('../components/shared/CheckVerification')
        },
        {
            path: '/change-password',
            name: 'change-password',
            component: () => import('../components/ChangePassword')
        },
        {
            path: '',
            name: 'order-form',
            component: () => import('../components/OrderForm'),
            meta: {requiresAuth: true}
        },
        {
            path: '/data',
            name: 'dataTable',
            component: () => import('../components/DataTable'),
            meta: {requiresAuth: true}
        },
        {
            path: '/mandarin-card-binding',
            name: 'mandarin-card-binding',
            component: () => import('../components/MandarinCardBinding'),
            meta: {requiresAuth: true}
        },
        {
            path: '/personal-contacts',
            name: 'personal-contacts',
            component: () => import('../components/PersonalContacts'),
            meta: {requiresAuth: true}
        },
        {
            path: '/card-binding',
            name: 'card-binding',
            component: () => import('../components/CardBinding'),
            meta: {requiresAuth: true}
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: () => import('../components/Checkout'),
            meta: {requiresAuth: true}
        },
        {
            path: '/verify-sms',
            name: 'verify-sms',
            component: () => import('../components/MandarinVerifySms'),
            meta: {requiresAuth: true}
        },
        {
            path: '/success',
            name: 'success',
            component: () => import('../components/Success'),
            meta: {requiresAuth: true}
        },
        {
            path: '/profile',
            name: 'profile',
            component: () => import('../components/Profile/PersonalLoan'),
            meta: {requiresAuth: true}
        },
        {
            path: '/loan-repayment',
            name: 'loan-repayment',
            component: () => import('../components/Profile/LoanRepayment'),
            meta: {requiresAuth: true}
        },
        {
            path: '/loan-extension',
            name: 'loan-extension',
            component: () => import('../components/Profile/LoanExtension'),
            meta: {requiresAuth: true}
        },
        {
            path: '/history',
            name: 'history',
            component: () => import('../components/Profile/LoanHistory'),
            meta: {requiresAuth: true}
        },
        {
            path: '/security',
            name: 'security',
            component: () => import('../components/Profile/Security'),
            meta: {requiresAuth: true}
        },
        {
            path: '/contact-data',
            name: 'contact-data',
            component: () => import('../components/ContactData'),
            meta: {requiresAuth: true}
        },
        {
            path: '/verify-email',
            name: 'verify-email',
            component: () => import('../components/VerifyEmail'),
            meta: {requiresAuth: true}
        },
        {
            path: '/thank-you',
            name: 'thank-you',
            component: () => import('../components/ThankYou'),
            meta: {requiresAuth: true}
        },
    ]
});
