<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    function __construct()
    {
        $this->responseModel = (new ResponseModel());
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return $this->responseModel->sendJSON(400,  __('auth.API400'), $validator->errors()->all());
        }

        if (!Auth::attempt(request(['email', 'password']))) {
            return $this->responseModel->sendJSON(401,  __('auth.API401'));
        }

        $user = $request->user();
        $tokenResult = $user->createToken(env(''));
        $token = $tokenResult->token;
        $token->save();

        return $this->responseModel->sendJSON(200,  __('auth.APILOGIN200'), [
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|min:6|string|confirmed',
        ]);

        if ($validator->fails()) {
            return $this->responseModel->sendJSON(400,  __('auth.API400'), $validator->errors()->all());
        }

        $request->only('name', 'email', 'password');

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return $this->responseModel->sendJSON(200,  __('auth.APIREGISTER200'), $user);
    }

    public function userinfo(Request $request)
    {
        $respData=Http::withHeaders([
            'Authorization' => 'Bearer ' . $request->access_token
        ])->get(config('externalapiroutes.OPENIDAUTHUSERINFO'));

        $data=[];

        User::create($data);

        
    }
}
