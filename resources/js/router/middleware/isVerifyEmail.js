export default async function isVerifyEmail({next, store}){
  const response = await store.getters.isVerifyEmail;
  if(!response)
    return next({name: 'contact-data'})
  return next();
}
