export default async function isExistLoan({next, store}){
  const response = await store.dispatch('isExistLoan');
  if(!response)
    return next({name: 'order-form'})
  return next();
}
