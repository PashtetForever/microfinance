export default async function isExistLoan({next, store}){
  await store.dispatch('isExistLoan');
  if(!store.getters.isExistLoan) {
    store.commit('resetCurrentLoanData')
    return next({name: 'order-form'})
  }
  else
    return next();
}
