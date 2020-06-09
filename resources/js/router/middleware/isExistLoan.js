export default async function isExistLoan({next, store}){
  const response = await store.dispatch('isExistLoan');
  if(!response.hasOwnProperty('data') && response.data !== false)
    return next({name: 'order-form'})
  return next();
}
