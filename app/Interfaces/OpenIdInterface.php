<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface OpenIdInterface {
    public function getOpenIdCode(Request $request);
    public function getOauthToken(string $code);
    public function getJLeagueUserInfo($oauthCredentials);
}




