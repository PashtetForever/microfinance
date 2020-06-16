export default function isExistLoan({next, store}){
  if(!store.getters.isAuthorized)
    return next('/login')
  else
    return next()
}
