<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SFDCController;
use App\Models\ResponseModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $responseModel;
    protected $sfdcController;

    function __construct()
    {
        $this->responseModel = (new ResponseModel);
        $this->sfdcController=(new SFDCController);
    }

    public function userinfo(Request $request)
    {
        return $this->sfdcController->getUserData(null);


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->access_token
        ])->get(config('externalapiroutes.OPENIDAUTHUSERINFO'));

        if ($response->status()==200) {
            $data=[];
            //GET SFDC DATA TOKEN & GET SFDC DATA
            return $this->sfdcController->getUserData($response->body());

            //CHECK USER EXISTS OR NOT
            //CREATE USER
            // User::create($data);
            return $this->responseModel->sendJSON(200,  __('auth.APIFETCH200'), $data);
        } else {
            return $this->responseModel->sendJSON($response->status(),  json_decode($response->body()));
        }
    }
}
