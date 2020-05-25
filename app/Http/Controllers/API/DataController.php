<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Exchange1C\API;
use Illuminate\Http\Request;

class DataController extends Controller
{
    private API $api;

    public function __construct(API $api)
    {

        $this->api = $api;
    }

    public function getUserData(Request $request)
    {
        return $this->api->getUserInfo($request['sessionId']);
    }

    public function setUserData(Request $request)
    {
        $this->api->setUserInfo($request['sessionId'], $request['data']);
    }
}
