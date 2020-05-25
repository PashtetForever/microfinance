import Request from "./Request";

export default class  {
  static async login(login, password, phone) {
    return await Request.request('POST', '/api/user/login', {login, password, phone})
  }
  static async checkAuthVerifyCode(phone, code) {
    return await Request.request('POST', '/api/user/check-verify', {phone, code})
  }
  static async getContactData(sessionId) {
    return await Request.request('GET', '/api/user/personal-data?sessionId=' + sessionId)
  }
  static async setContactData(sessionId, fio, email) {
    return await Request.request('POST', '/api/user/personal-data', {sessionId, fio, email})
  }
  static async sendVerifyMail(email, userGuid) {
    return await Request.request('POST', '/api/user/send-email-verify', {email, userGuid})
  }
  static async checkVerifyMail(userGuid, code) {
    return await Request.request('POST', '/api/user/check-email-verify', {userGuid, code})
  }
  static async getUserData(sessionId) {
    return await Request.request('GET', '/api/data/user-data?sessionId=' + sessionId)
  }
  static async setUserData(sessionId, data) {
    return await Request.request('POST', '/api/data/user-data', {sessionId, data})
  }
  static async getPersonalContacts(sessionId, data) {
    return await Request.request('GET', '/api/data/personal-contacts?sessionId=' + sessionId)
  }
  static async setPersonalContacts(sessionId, data) {
    return await Request.request('POST', '/api/data/personal-contacts', {sessionId, data})
  }
  static async mandarinIdentify(data) {
    return await Request.request('POST', '/api/mandarin/identify-person', {data})
  }
  static async mandarinBinding(email, phone) {
    return await Request.request('POST', '/api/mandarin/binding', {email, phone})
  }
  static async mandarinCheckSms(mandarinSessionId, code) {
    return await Request.request('POST', '/api/mandarin/check-sms', {mandarinSessionId, code})
  }
  static async mandarinGetIdentify(smsId) {
    return await Request.request('POST', '/api/mandarin/result', {smsId})
  }
  static async setMandarinId(sessionId,mandarinId, phone, email) {
    return await Request.request('POST', '/api/user/set-mandarin', {sessionId, mandarinId, phone, email})
  }
  static async createLoan(sessionId, days, sum) {
    return await Request.request('POST', '/api/loan/create', {sessionId, days, sum})
  }
}
