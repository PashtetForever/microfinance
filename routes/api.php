<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::post('/login', 'API\UserController@login');
    Route::post('/check-verify', 'API\UserController@checkLoginVerifyCode');
    Route::post('/send-email-verify', 'API\UserController@sendEmailVerify');
    Route::post('/check-email-verify', 'API\UserController@checkEmailVerify');
    Route::get('/personal-data', 'API\UserController@getContactData');
    Route::post('/personal-data', 'API\UserController@setContactData');
    Route::post('/set-mandarin', 'API\UserController@setMandarin');
    Route::post('/send-sms-verify', 'API\UserController@sendSmsCode');
    Route::post('/restore-password', 'API\UserController@restorePassword');
    Route::post('/change-password', 'API\UserController@changePassword');
});

Route::group(['prefix' => 'data'], function () {
    Route::get('/user-data', 'API\DataController@getUserData');
    Route::post('/user-data', 'API\DataController@setUserData');
    Route::get('/personal-contacts', 'API\PersonalContactsController@getPersonalContacts');
    Route::post('/personal-contacts', 'API\PersonalContactsController@setPersonalContacts');
});

Route::group(['prefix' => 'mandarin'], function () {
    Route::post('/identify-person', 'API\MandarinController@identify');
    Route::post('/binding', 'API\MandarinController@binding');
    Route::post('/check-sms', 'API\MandarinController@checkSms');
    Route::post('/result', 'API\MandarinController@getIdentifyResult');
    Route::post('/repayment-loan', 'API\MandarinController@repaymentLoan');
    Route::post('/repayment-loan-callback', 'API\MandarinController@callbackRepaymentLoan');
    Route::post('/payment-extension-percent', 'API\MandarinController@paymentExtensionPercent');
    Route::post('/payment-extension-percent-callback', 'API\MandarinController@callbackExtensionPercent');
});

Route::group(['prefix' => 'loan'], function () {
    Route::post('/create', 'API\LoanController@create');
    Route::post('/return', 'API\LoanController@returnLoan');
    Route::post('/cancel', 'API\LoanController@cancelLoan');
    Route::post('/sign-contract', 'API\LoanController@signContract');
    Route::get('/current', 'API\LoanController@getLoan');
    Route::post('/is-exist', 'API\LoanController@isExistLoan');
    Route::get('/contract', 'API\LoanController@getContractData');
    Route::post('/extension', 'API\LoanController@extendLoan');
    Route::post('/extension-documents', 'API\LoanController@getExtendLoanDocuments');
    Route::post('/history', 'API\LoanController@getHistoryLoans');
});

Route::group(['prefix' => 'documents'], function () {
    Route::get('/list', 'API\DocumentsController@getFiles');
    Route::post('/list', 'API\DocumentsController@loadFiles');
});
