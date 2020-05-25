<?php


namespace App\Services\Exchange1C;


class API
{
    private Receiver $receiver;

    public function __construct(Receiver $receiver)
    {
        $this->receiver = $receiver;
    }

    public function login($login, $password)
    {
        return $this->request('POST', 'dunay/hs/cabinet/login', [
            'Login' => $login,
            'Password' => $password
        ]);
    }

    public function getPersonalUserInfo($sessionId)
    {
        return $this->request('GET', 'dunay/hs/cabinet/info/' . $sessionId);
    }

    public function setPersonalUserInfo($sessionId, $fio, $email)
    {
        return $this->request('POST', 'dunay/hs/cabinet/info/' . $sessionId, [
            'FIO' => $fio,
            'Email' => $email
        ]);
    }

    public function getUserInfo($sessionId)
    {
        return $this->request('GET', 'dunay/hs/cabinet/data/' . $sessionId);
    }

    public function setUserInfo($sessionId, $data)
    {
        return $this->request('POST', 'dunay/hs/cabinet/data/' . $sessionId, $data);
    }

    public function getContactPersons($sessionId)
    {
        return $this->request('GET', 'dunay/hs/cabinet/contactperson/' . $sessionId);
    }

    public function setContactPersons($sessionId, $data)
    {
        return $this->request('POST', 'dunay/hs/cabinet/contactperson/' . $sessionId, $data);
    }

    public function bindingMandarinId($sessionId, $name, $phone, $mandarinId, $email)
    {
        return $this->request('POST', 'dunay/hs/cabinet/mandarinid/' . $sessionId, [
            'Name' => $name,
            'PhoneName' => $phone,
            'MandarinID' => $mandarinId,
            'Email' => $email
        ]);
    }

    public function getFileList($sessionId, $smsCode, $loanGuid)
    {
        return $this->request('POST', 'dunay/hs/cabinet/filelist/' . $sessionId, [
            'SMSCode' => $smsCode,
            'GUID' => $loanGuid
        ]);
    }

    public function getFile($sessionId, $filePath)
    {
        return $this->request('POST', 'dunay/hs/cabinet/file/' . $sessionId, [
            'file' => $filePath
        ]);
    }

    public function requestCreateLoan($sessionId, int $sum, int $days)
    {
        return $this->request('GET', "dunay/hs/cabinet/request/$sessionId?sum=$sum&days=$days");
    }

    public function getCurrentLoan($sessionId, $loanGuid)
    {
        return $this->request('GET', "dunay/hs/cabinet/currentloan/$sessionId?GUID=$loanGuid");
    }

    public function requestSignContract($sessionId, $smsCode, $loanGuid)
    {
        return $this->request('POST', "dunay/hs/cabinet/signcontract/$sessionId", [
            'SMSCode' => $smsCode,
            'GUID' => $loanGuid
        ]);
    }

    public function getFillContract($sessionId, $loanGuid)
    {
        return $this->request('POST', 'dunay/hs/cabinet/fillcontract/' . $sessionId, [
            'GUID' => $loanGuid
        ]);
    }

    public function getLastContractData($sessionId, $loanGuid)
    {
        return $this->request('GET', "dunay/hs/cabinet/validcontract/$sessionId?GUID=$loanGuid", [
            'GUID' => $loanGuid
        ]);
    }

    public function requestReturnLoan($sessionId, $loanGuid)
    {
        return $this->request('GET', "dunay/'/hs/cabinet/loanreturn/$sessionId,", [
            'GUID' => $loanGuid
        ]);
    }

    public function requestChangePassword($sessionId, $oldPassword, $newPassword)
    {
        return $this->request('POST', "dunay/hs/cabinet/changepassword/$sessionId", [
            'OldPassword' => $oldPassword,
            'NewPassword' => $newPassword
        ]);
    }

    public function requestRestorePassword($fio, $phone)
    {
        return $this->request('POST', "dunay/hs/cabinet/restorepassword", [
            'FIO' => $fio,
            'PhoneNumber' => $phone
        ]);
    }

    public function setMandarin($sessionId, $mandarinId, $phone, $email)
    {
        return $this->request('POST', 'dunay/hs/cabinet/mandarinid/' . $sessionId, [
            'PhoneNumber' => $phone,
            'Email' => $email,
            'MandarinID' => $mandarinId
        ]);
    }

    private function request($method, $urn, $data = null)
    {
        try {
            return response()->json($this->receiver->request($method, $urn, $data));
        } catch (\DomainException $exception) {
            return response()
                ->json(['message' => $exception->getMessage()])
                ->setStatusCode(500);
        }
    }
}
