<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\OpenIdInterface;
use Illuminate\Http\Request;

class OpenIdController extends Controller
{
    protected $openIdInterface;

    public function __construct(OpenIdInterface $openIdInterface)
    {
        $this->openIdInterface = $openIdInterface;
    }

    public function getOpenIdCode(Request $request){
        $code =  $this->openIdInterface->getOpenIdCode($request);
        return $this->getOauthToken($code);
    }

    public function getOauthToken(string $code){
        $oauthCredentials =  $this->openIdInterface->getOauthToken($code);
        return $this->getJLeagueUserInfo($oauthCredentials);
    }

    public function getJLeagueUserInfo($oauthCredentials){
        return $this->openIdInterface->getJLeagueUserInfo($oauthCredentials);
    }
}
