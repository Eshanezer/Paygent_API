<?php

namespace App\Http\Controllers;

use App\Models\t_mkdb_entry;
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

            $sfdcData = json_decode($response->body())->Return_Data[0]->Contact;

            return t_mkdb_entry::create([
                'request_no' => 'login',
                'entry_type'=>'',
                'club_cd' => $openid_data->club_cd,
                'card_type'=>'',
                'mkdb_id' => $openid_data->mkdb_id,
                'post_cd' => $sfdcData->POST_CD,
                'address_state' => $sfdcData->ADDRESS_STREET,
                'address_city' => $sfdcData->ADDRESS_CITY,
                'address_street' => $sfdcData->ADDRESS_STREET,
                'address_building' => $openid_data->address_building,
                'lastname' => $sfdcData->FirstName,
                'firstname' => $sfdcData->LastName,
                'member_last_nm_kana' => $sfdcData->MEMBER_LAST_NM_KANA,
                'member_first_nm_kana' => $sfdcData->MEMBER_FIRST_NM_KANA,
                'sex' => $sfdcData->SEX,
                'birthdate' => $sfdcData->Birthdate,
                'mobilephone' => $sfdcData->mkdb_Phoneid,
                'email' => $sfdcData->Email
            ]);
        } else {
            abort(500);
        }
    }
}
