<?php

namespace App\Repositories;

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
        // $oauthCredentials = Http::withBasicAuth(
        //     'gatewayYM',
        //     '2yyiWMytitpqKbwbjLsmPvHPTfAUnqTF',
        // )->withHeaders([
        //     "Content-Type" => "application/x-www-form-urlencoded",
        // ])->asForm()->post('https://login2.jleague.jp/oauth/token', [
        //     'grant_type' => 'authorization_code',
        //     'redirect_uri' => 'http://fanengage.net/auth/redirect',
        //     'code' => $code,
        // ])->json();
        // return $oauthCredentials;
        $oauthCredentials = Http::withBasicAuth(
            config('openIdConfig.client_credentials.yokohama_marinos.client_id'),
            config('openIdConfig.client_credentials.yokohama_marinos.client_secret'),
        )->withHeaders([
            "Content-Type" => "application/x-www-form-urlencoded",
        ])->asForm()->post(config('openIdConfig.endpoints.get_oauth_token_endpoint'), [
            'grant_type' => 'authorization_code',
            'redirect_uri' => config('openIdConfig.endpoints.get_login_redirect_endpoint'),
            'code' => $code,
        ])->json();
        return $oauthCredentials;
    }

    public function getJLeagueUserInfo($oauthCredentials)
    {
        try {
            $access_token = $oauthCredentials['access_token'];
            // $jLeagueUserCredentials = Http::withToken($access_token)->get('https://login2.jleague.jp/userinfo')->json();
            // $data = compact('jLeagueUserCredentials', 'oauthCredentials');
            // return $this->successResponse(data:$data);

            // return Http::withToken($access_token)->get('https://login2.jleague.jp/userinfo')->json();
            return Http::withToken($access_token)->get(config('openIdConfig.endpoints.get_user_info_endpoint'))->json();

        } catch (Exception $e) {
            return $this->errorResponse(message: 'Failed to Login');
        }
    }

    public function updateJLeagueUserInfo($token)
    {
        // try {
        //     return Http::withToken($token)->get('https://login2.jleague.jp/userinfo')->json();

        // } catch (Exception $e) {
        //     return $this->errorResponse(message: 'Failed to Login');
        // }
    }
}
