import Vue from 'vue'
import Router from 'vue-router'

import isExistLoan from "./middleware/isExistLoan"
import isAuth from "./middleware/isAuth"
import isBlockedNewLoan from "./middleware/isBlockedNewLoan"

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.MIX_ROUTER_PATH,
  routes: [
    {path: '/login', name: 'login', component: () => import('../components/Login/Auth')},
    {path: '/register', name: 'register', component: () => import('../components/Registration/Registration')},
    {path: '/verify', name: 'verify', component: () => import('../components/Login/CheckVerification')},
    {path: '/change-password', name: 'change-password', component: () => import('../components/ChangePassword')},
    {
      path: '/new/',
      component: () => import('../components/NewLoan/NewLoan'),
      meta: {
        middleware: [isAuth, isBlockedNewLoan]
      },
      children: [
        {name: 'order-form', path: 'order-form', component: () => import('../components/NewLoan/OrderForm')},
        {path: 'contact-data', name: 'contact-data', component: () => import('../components/NewLoan/ContactData')},
        {path: 'verify-email', name: 'verify-email', component: () => import('../components/NewLoan/VerifyEmail')},
        {path: 'data', name: 'dataTable', component: () => import('../components/NewLoan/UserData/UserData')},
        {path: 'personal-contacts', name: 'personal-contacts', component: () => import('../components/NewLoan/PersonalContacts/PersonalContacts')},
        {path: 'mandarin-card-binding', name: 'mandarin-card-binding', component: () => import('../components/NewLoan/MandarinCardBinding')},
        {path: 'card-binding', name: 'card-binding', component: () => import('../components/NewLoan/CardBinding')},
        {path: 'checkout', name: 'checkout', component: () => import('../components/NewLoan/Checkout')},
        {path: 'verify-sms', name: 'verify-sms', component: () => import('../components/NewLoan/MandarinVerifySms')},
      ]
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
      path: '/thank-you', name: 'thank-you', component: () => import('../components/ThankYou'),
      meta: {
        middleware: [isAuth]
      }
    },
    {
      path: '/',
      redirect:  'login'
    }
  ]
});
