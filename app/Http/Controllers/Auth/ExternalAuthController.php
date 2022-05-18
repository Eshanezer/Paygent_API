<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    protected $externalAPIController;

    function __construct() {
        parent::__construct();
        // $this->externalAPIController=(new ExternalAuthController);
    }

    public function refreshAPIToken(){

        // $response = Http::withHeaders([
        //     'Accept' => 'application/json',
        // ])->post('http://example.com/users', [
        //     'name' => 'Steve',
        //     'role' => 'Network Administrator',
        // ]);
        return true;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        //checking internal
        if (Auth::attempt($credentials)) {
            return true;
        }

        //checking external
       return $this->externalAPIController->login();
    }
}
