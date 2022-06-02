<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\MKDBInterface;
use App\Interfaces\OpenIdInterface;
use App\Interfaces\SFDCInterface;
use Illuminate\Http\Request;

class OpenIdController extends Controller
{
    protected $openIdInterface;
    protected $sfdcInterface;
    protected $mkdbInterface;

    public function __construct(OpenIdInterface $openIdInterface, SFDCInterface $sfdcInterface, MKDBInterface $mkdbInterface)
    {
        $this->openIdInterface = $openIdInterface;
        $this->sfdcInterface = $sfdcInterface;
        $this->mkdbInterface = $mkdbInterface;
    }

    public function getOpenIdCode(Request $request)
    {
        $code =  $this->openIdInterface->getOpenIdCode($request);
        return $this->getOauthToken($code);
    }

    public function getOauthToken(string $code)
    {
        $oauthCredentials =  $this->openIdInterface->getOauthToken($code);

        //openid user data 1
        $jLeagueUserCredentials = $this->getJLeagueUserInfo($oauthCredentials);
        // $sfdcUserData = $this->sfdcInterface->getSFDCUserData($jLeagueUserCredentials['mkdb_id'], $this->sfdcInterface->getSFDCOAuthToken()['access_token'])['Return_Data'][0]['Contact'];
        // $this->mkdbInterface->storeUserData([
        //     'request_no' => 'login',
        //     'entry_type' => 'non',
        //     'club_cd' => $jLeagueUserCredentials['club_cd'],
        //     'card_type' => 'non',
        //     'mkdb_id' => $jLeagueUserCredentials['mkdb_id'],
        //     'post_cd' => $sfdcUserData['POST_CD'],
        //     'address_state' => $sfdcUserData['ADDRESS_STREET'],
        //     'address_city' => $sfdcUserData['ADDRESS_CITY'],
        //     'address_street' => $sfdcUserData['ADDRESS_STREET'],
        //     'address_building' => $jLeagueUserCredentials['address_building'],
        //     'lastname' => $sfdcUserData['FirstName'],
        //     'firstname' => $sfdcUserData['LastName'],
        //     'member_last_nm_kana' => $sfdcUserData['MEMBER_LAST_NM_KANA'],
        //     'member_first_nm_kana' => $sfdcUserData['MEMBER_FIRST_NM_KANA'],
        //     'sex' => $sfdcUserData['SEX'],
        //     'birthdate' => $sfdcUserData['Birthdate'],
        //     'mobilephone' => $sfdcUserData['mkdb_Phoneid'],
        //     'email' => $sfdcUserData['Email']
        // ]);
        $data = compact('jLeagueUserCredentials', 'oauthCredentials');
        return $this->successResponse(data:$data);
        //end openid user data
    }

    public function getJLeagueUserInfo($oauthCredentials)
    {
        return $this->openIdInterface->getJLeagueUserInfo($oauthCredentials);
    }
}
