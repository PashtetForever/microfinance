export default async function isExistLoan({next, store}){
  const response = await store.dispatch('isExistLoan');
  if(!response.hasOwnProperty('data'))
    return next({name: 'order-form'})
  return next();
}
