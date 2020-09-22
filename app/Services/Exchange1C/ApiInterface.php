<?php


namespace App\Services\Exchange1C;


interface ApiInterface
{
    public function login($login, $password);
    public function registration($fio, $birthday, $gender, $passportSeries, $passportNumber, $passportDate, $passportUnit, $passportUnitCode, $email, $phone, $snils);
    public function getPersonalUserInfo($sessionId);
    public function setPersonalUserInfo($sessionId, $fio, $email);
    public function getUserInfo($sessionId);
    public function setUserInfo($sessionId, $data);
    public function getContactPersons($sessionId);
    public function setContactPersons($sessionId, $data);
    public function bindingMandarinId($sessionId, $name, $phone, $mandarinId, $email);
    public function getFileList($sessionId, $smsCode, $loanGuid);
    public function getFileExtendLoan($sessionId, $returnDate, $smsCode, $loanGuid);
    public function getFile($sessionId, $filePath, $sinkFile);
    public function requestCreateLoan($sessionId, int $sum, int $days);
    public function requestSignContract($sessionId, $smsCode, $loanGuid);
    public function getFillContract($sessionId, $loanGuid);
    public function getLastContractData($sessionId, $loanGuid);
    public function requestReturnLoan($loanGuid, $sum);
    public function extendLoan($loanGuid, $returnDate);
    public function changePassword($sessionId, $oldPassword, $newPassword);
    public function restorePassword($lastName, $firstName, $middleName, $phone);
    public function setMandarin($sessionId, $mandarinId, $phone, $email);
    public function cancelLoan($sessionId, $loanGuid);
}
