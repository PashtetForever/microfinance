import Request from "./Request";

export default class  {
  static async login(login, password, phone) {
    return await Request.request('POST', '/api/user/login', {login, password, phone})
  }
  static async registration(fio, birthday, gender, passportSeries, passportNumber, passportDate, passportUnit, passportUnitCode, email, phone, snils) {
    return await Request.request('POST', '/api/user/register', {
      fio, birthday, gender, passportSeries, passportNumber, passportDate, passportUnit, passportUnitCode, email, phone, snils
    })
  }
  static async restorePassword(lastName, firstName, middleName, phone) {
    return await Request.request('POST', '/api/user/restore-password', {lastName, firstName, middleName, phone})
  }
  static async changePassword(sessionId, oldPassword, newPassword) {
    return await Request.request('POST', '/api/user/change-password', {sessionId, oldPassword, newPassword})
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
  static async mandarinIdentify(data, mandarinLogin) {
    return await Request.request('POST', '/api/mandarin/identify-person', {data, mandarinLogin})
  }
  static async mandarinBinding(email, phone, mandarinLogin) {
    return await Request.request('POST', '/api/mandarin/binding', {email, phone, mandarinLogin})
  }
  static async mandarinCheckSms(mandarinSessionId, code, mandarinLogin) {
    return await Request.request('POST', '/api/mandarin/check-sms', {mandarinSessionId, code, mandarinLogin})
  }
  static async mandarinGetIdentify(smsId, mandarinLogin) {
    return await Request.request('POST', '/api/mandarin/result', {smsId, mandarinLogin})
  }
  static async setMandarinId(sessionId,mandarinId, phone, email) {
    return await Request.request('POST', '/api/user/set-mandarin', {sessionId, mandarinId, phone, email})
  }
  static async createLoan(sessionId, days, sum, smsCode, percent, userGuid) {
    return await Request.request('POST', '/api/loan/create', {sessionId, days, sum, smsCode, userGuid, percent})
  }
  static async getCurrentLoan(sessionId, userGuid) {
    return await Request.request('GET', `/api/loan/current?sessionId=${sessionId}&userGuid=${userGuid}`);
  }
  static async sendSmsCode(phone) {
    return await Request.request('POST', '/api/user/send-sms-verify', {phone});
  }
  static async getSignContract(userGuid, smsCode, sessionId) {
    return await Request.request('POST', '/api/loan/sign-contract', {userGuid, smsCode, sessionId});
  }
  static async getContractData(sessionId, loanGuid) {
    return await Request.request('GET', `/api/loan/contract?loanGuid=${loanGuid}&sessionId=${sessionId}`);
  }
  static async repayment(orderId, price, email, mandarinLogin) {
    return await Request.request('POST', `/api/mandarin/repayment-loan`, {orderId, price, email, mandarinLogin});
  }
  static async extensionPayPercent(orderId, price, email, mandarinLogin) {
    return await Request.request('POST', `/api/mandarin/payment-extension-percent`, {orderId, price, email, mandarinLogin});
  }
  static async extensionLoan(loanGuid, returnDate, smsCode) {
    return await Request.request('POST', `/api/loan/extension`, {loanGuid, returnDate, smsCode});
  }
  static async getExtensionLoanDocuments(sessionId, loanGuid, returnDate, smsCode) {
    return await Request.request('POST', `/api/loan/extension-documents`, {sessionId, loanGuid, returnDate, smsCode});
  }
  static async isExistLoan(userGuid) {
    return await Request.request('POST', `/api/loan/is-exist`, {userGuid});
  }
  static async getHistory(userGuid) {
    return await Request.request('POST', `/api/loan/history`, {userGuid});
  }
  static async cancelLoan(sessionId, loanGuid) {
    return await Request.request('POST', `/api/loan/cancel`, {sessionId, loanGuid});
  }
}
