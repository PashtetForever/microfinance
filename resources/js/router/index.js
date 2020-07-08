import Vue from 'vue'
import Router from 'vue-router'

import isExistLoan from "./middleware/isExistLoan"
import isAuth from "./middleware/isAuth";

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.MIX_ROUTER_PATH,
  routes: [
    {path: '/login', name: 'login', component: () => import('../components/Auth')},
    {path: '/verify', name: 'verify', component: () => import('../components/shared/CheckVerification')},
    {path: '/change-password', name: 'change-password', component: () => import('../components/ChangePassword')},
    {
      path: '', name: 'order-form', component: () => import('../components/OrderForm'),
      meta: {middleware: [isAuth]}
    },
    {
      path: '/data', name: 'dataTable', component: () => import('../components/DataTable'),
      meta: {middleware: [isAuth]}
    },
    {
      path: '/mandarin-card-binding',
      name: 'mandarin-card-binding',
      component: () => import('../components/MandarinCardBinding'),
      meta: {middleware: [isAuth]}
    },
    {
      path: '/personal-contacts', name: 'personal-contacts', component: () => import('../components/PersonalContacts'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/card-binding', name: 'card-binding', component: () => import('../components/CardBinding'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/checkout', name: 'checkout', component: () => import('../components/Checkout'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/verify-sms', name: 'verify-sms', component: () => import('../components/MandarinVerifySms'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/success', name: 'success', component: () => import('../components/Success'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/profile', name: 'profile', component: () => import('../components/Profile/PersonalLoan'),
      meta: {
        middleware: [isExistLoan, isAuth],
      }
    },
    {
      path: '/loan-repayment', name: 'loan-repayment', component: () => import('../components/Profile/LoanRepayment'),
      meta: {
        middleware: [isExistLoan, isAuth],
      }
    },
    {
      path: '/loan-extension', name: 'loan-extension', component: () => import('../components/Profile/Extension/Index'),
      meta: {
        middleware: [isExistLoan, isAuth],
      },
      children: [
        {path: 'choice', name: 'choice-date', component: () => import('../components/Profile/Extension/ChoiceDate')},
        {path: 'check-documents', name: 'check-documents', component: () => import('../components/Profile/Extension/Documents')},
      ]
    },
    {
      path: '/history', name: 'history', component: () => import('../components/Profile/LoanHistory'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/security', name: 'security', component: () => import('../components/Profile/Security'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/contact-data', name: 'contact-data', component: () => import('../components/ContactData'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/verify-email', name: 'verify-email', component: () => import('../components/VerifyEmail'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/thank-you', name: 'thank-you', component: () => import('../components/ThankYou'),
      meta: {
        middleware: [isAuth]
      }
    },
  ]
});
