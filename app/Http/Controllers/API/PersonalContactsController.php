<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\Exchange1C\API;
use Illuminate\Http\Request;

class PersonalContactsController extends Controller
{
    private API $api;

    public function __construct(API $api)
    {
        $this->api = $api;
    }

    public function getPersonalContacts(Request $request)
    {
       return $this->api->getContactPersons($request['sessionId']);
    }
    public function setPersonalContacts(Request $request)
    {
        return $this->api->setContactPersons($request['sessionId'], $request['data']);
    }
}
