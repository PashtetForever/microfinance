export default async function isExistLoan({next, store}){
  await store.dispatch('isExistLoan');
  if(!store.getters.isExistLoan)
    return next({name: 'order-form'})
  return next();
}
