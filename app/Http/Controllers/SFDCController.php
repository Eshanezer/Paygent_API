<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SFDCController extends Controller
{
    public function getNewToken()
    {
        //returns sfdc_token table record
        //includes
        $response = Http::asForm()->post(config('externaApiRoutes.SFDCAUTHTOKEN'), [
            'username' => env('SFDC_USERNAME'),
            'password' => env('SFDC_PASSWORD'),
            'client_id' => env('SFDC_CLIENTID'),
            'client_secret' => env('SFDC_CLIENTSECRET'),
            'grant_type' => 'password'
        ]);

        $token = null;

        switch ($response->status()) {
            case 200:
                $token = json_decode($response->body())->access_token;
                break;
            default:
                Log::error($response->body());
                abort(500);
                break;
        }
        return $token;
    }

    public function enrollUserData()
    {
    }

    public function getUserData($openid_data): array
    {
        $rawData = ['MKDBID' => $openid_data->mkdb_id, 'GroupExport_FLG' => true, 'ContainReservedClubMember_FLG' => true, 'ContainExpiredClubMember_FLG' => false];
        $header = ['Content-Type' => 'application/json', 'Request_No' => 'login', 'Authorization' => 'Bearer ' . $this->getNewToken()];
        $response = Http::withHeaders($header)->withBody(json_encode($rawData), 'application/json')->post(config('externaApiRoutes.SFDCREADDATA'));
        if ($response->status() == 200) {
            return $response->body();
            return User::makeUserDataUsingExternalSources($openid_data, json_decode($response->body()));
        } else {
            abort(500);
        }
    }
}
