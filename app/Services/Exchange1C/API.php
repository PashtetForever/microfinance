<?php


namespace App\Services\Exchange1C;


use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

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

    public function getFile($sessionId, $filePath, $sinkFile)
    {
        $response = $this->receiver->request('POST', 'dunay/hs/cabinet/file/' . $sessionId, [
            'file' => $filePath
        ], ['sink' => storage_path('app') . '/' . $sinkFile]);
        Storage::put($sinkFile, $response);
    }

    public function requestCreateLoan($sessionId, int $sum, int $days)
    {
        return $this->receiver->request('GET', "dunay/hs/cabinet/request/$sessionId?sum=$sum&days=$days");
    }

    public function getCurrentLoan($sessionId, $loanGuid)
    {
        return $this->request('GET', "dunay/hs/cabinet/currentloan/$sessionId?GUID=$loanGuid");
    }

    public function requestSignContract($sessionId, $smsCode, $loanGuid)
    {
        return $this->receiver->request('POST', "dunay/hs/cabinet/signcontract/$sessionId", [
            'SMSCode' => $smsCode,
            'GUID' => $loanGuid
        ]);
    }

    public function getFillContract($sessionId, $loanGuid)
    {
        return $this->receiver->request('POST', 'dunay/hs/cabinet/fillcontract/' . $sessionId, [
            'GUID' => $loanGuid
        ]);
    }

    public function getLastContractData($sessionId, $loanGuid)
    {
        return $this->receiver->request('GET', "dunay/hs/cabinet/validcontract/$sessionId?GUID=$loanGuid");
    }

    public function requestReturnLoan($loanGuid, $sum)
    {
        return $this->receiver->request('POST', "dunay/hs/cabinet/loanreturn", [
            'GUID' => $loanGuid,
            'Sum' => $sum
        ]);
    }

    public function extendLoan($loanGuid, $returnDate)
    {
        return $this->receiver->request('POST', "dunay/hs/cabinet/extendcontract", [
            'GUID' => $loanGuid,
            'ReturnDate' => $returnDate
        ]);
    }

    public function changePassword($sessionId, $oldPassword, $newPassword)
    {
        return $this->request('POST', "dunay/hs/cabinet/changepassword/$sessionId", [
            'OldPassword' => $oldPassword,
            'NewPassword' => $newPassword
        ]);
    }

    public function restorePassword($lastName, $firstName, $middleName, $phone)
    {
        return $this->request('POST', "dunay/hs/cabinet/restorepassword", [
            'FIO' => "$lastName $firstName $middleName",
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
            return response()->json(['error' => $exception->getMessage()], 500);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
