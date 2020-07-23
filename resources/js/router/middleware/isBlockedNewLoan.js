export default function isBlockedNewLoan({next, store}){
  if(store.getters.isBlocked) {
    store.dispatch('error', 'В оформлении займа отказано. Вы сможете повторно оформить займ с ' + store.getters.blockedUntil)
    return next('/profile')
  } else {
    return next()
  }
}
