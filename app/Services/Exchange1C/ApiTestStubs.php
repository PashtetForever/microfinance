<?php


namespace App\Services\Exchange1C;


class ApiTestStubs implements ApiInterface
{

    public function login($login, $password)
    {
        return [
            "SessionId" => "41e28a39f4a349f4af767c9182e642f8",
            "GUID" => "b9592292-f14c-11e8-bb9c-283b82c7d45c",
            "LoanPercent" => "1",
            "Mandarin" => ["Login" => "2677"]
        ];
    }

    public function registration($fio, $birthday, $gender, $passportSeries, $passportNumber, $passportDate, $passportUnit, $passportUnitCode, $email, $phone, $snils)
    {
        // TODO: Implement registration() method.
    }

    public function getPersonalUserInfo($sessionId)
    {
        // TODO: Implement getPersonalUserInfo() method.
    }

    public function setPersonalUserInfo($sessionId, $fio, $email)
    {
        // TODO: Implement setPersonalUserInfo() method.
    }

    public function getUserInfo($sessionId)
    {
        // TODO: Implement getUserInfo() method.
    }

    public function setUserInfo($sessionId, $data)
    {
        // TODO: Implement setUserInfo() method.
    }

    public function getContactPersons($sessionId)
    {
        // TODO: Implement getContactPersons() method.
    }

    public function setContactPersons($sessionId, $data)
    {
        // TODO: Implement setContactPersons() method.
    }

    public function bindingMandarinId($sessionId, $name, $phone, $mandarinId, $email)
    {
        // TODO: Implement bindingMandarinId() method.
    }

    public function getFileList($sessionId, $smsCode, $loanGuid)
    {
        // TODO: Implement getFileList() method.
    }

    public function getFileExtendLoan($sessionId, $returnDate, $smsCode, $loanGuid)
    {
        // TODO: Implement getFileExtendLoan() method.
    }

    public function getFile($sessionId, $filePath, $sinkFile)
    {
        // TODO: Implement getFile() method.
    }

    public function requestCreateLoan($sessionId, int $sum, int $days)
    {
        // TODO: Implement requestCreateLoan() method.
    }

    public function requestSignContract($sessionId, $smsCode, $loanGuid)
    {
        // TODO: Implement requestSignContract() method.
    }

    public function getFillContract($sessionId, $loanGuid)
    {
        // TODO: Implement getFillContract() method.
    }

    public function getLastContractData($sessionId, $loanGuid)
    {
        // TODO: Implement getLastContractData() method.
    }

    public function requestReturnLoan($loanGuid, $sum)
    {
        // TODO: Implement requestReturnLoan() method.
    }

    public function extendLoan($loanGuid, $returnDate)
    {
        // TODO: Implement extendLoan() method.
    }

    public function changePassword($sessionId, $oldPassword, $newPassword)
    {
        // TODO: Implement changePassword() method.
    }

    public function restorePassword($lastName, $firstName, $middleName, $phone)
    {
        // TODO: Implement restorePassword() method.
    }

    public function setMandarin($sessionId, $mandarinId, $phone, $email)
    {
        // TODO: Implement setMandarin() method.
    }

    public function cancelLoan($sessionId, $loanGuid)
    {
        // TODO: Implement cancelLoan() method.
    }
}
