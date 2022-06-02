<?php

namespace App\Repositories;

use App\Interfaces\SFDCInterface;
use App\Traits\ResponseAPI;
use Illuminate\Support\Facades\Http;

class SFDCRepository implements SFDCInterface
{
    use ResponseAPI;

    public function getSFDCOAuthToken()
    {
        return Http::asForm()->post(config('externaApiRoutes.SFDC_AUTH_TOKEN'), [
            'username' => env('SFDC_USERNAME'),
            'password' => env('SFDC_PASSWORD'),
            'client_id' => env('SFDC_CLIENTID'),
            'client_secret' => env('SFDC_CLIENTSECRET'),
            'grant_type' => 'password'
        ])->json();
    }

    public function getSFDCUserData($mkdb_id, $token)
    {
        return Http::withHeaders(['Content-Type' => 'application/json', 'Request_No' => 'login', 'Authorization' => 'Bearer ' . $token])->withBody(json_encode(['MKDBID' => $mkdb_id, 'GroupExport_FLG' => true, 'ContainReservedClubMember_FLG' => true, 'ContainExpiredClubMember_FLG' => false]), 'application/json')->post(config('externaApiRoutes.SFDC_READ_DATA'))->json();
    }
}
