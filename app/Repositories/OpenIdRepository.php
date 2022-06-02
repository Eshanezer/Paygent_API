<?php

namespace App\Repositories;

use App\Http\Controllers\SFDCController;
use App\Interfaces\OpenIdInterface;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenIdRepository implements OpenIdInterface
{

    use ResponseAPI;

    public function getOpenIdCode(Request $request)
    {
        return $request->code;
    }

    public function getOauthToken(string $code)
    {
        $oauthCredentials = Http::withBasicAuth(
            'gatewayYM',
            '2yyiWMytitpqKbwbjLsmPvHPTfAUnqTF',
        )->withHeaders([
            "Content-Type" => "application/x-www-form-urlencoded",
        ])->asForm()->post('https://login2.jleague.jp/oauth/token', [
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'http://fanengage.net/auth/redirect',
            'code' => $code,
        ])->json();
        return $oauthCredentials;
    }

    public function getJLeagueUserInfo($oauthCredentials)
    {
        try {
            $access_token = $oauthCredentials['access_token'];
            $jLeagueUserCredentials = Http::withToken($access_token)->get('https://login2.jleague.jp/userinfo')->json();
            (new SFDCController)->getUserData($jLeagueUserCredentials);
            $data = compact('jLeagueUserCredentials', 'oauthCredentials');
            return $this->successResponse(data:$data);
        } catch (Exception $e) {
            return $this->errorResponse(message: 'Failed to Login');
        }
    }
}
