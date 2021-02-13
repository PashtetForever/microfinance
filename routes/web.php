<?php
use Illuminate\Support\Facades\Route;

Route::get('/storage/documents/{loanGuid}/{file}', function ($loanGuid, $file) {
    return Response::make(Storage::get("documents/$loanGuid/$file"), 200, [
        'Content-Type' => 'application/pdf',
    ]);
});

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');

Route::get('{path}', 'HomeController')->where('path', '(.*)');
