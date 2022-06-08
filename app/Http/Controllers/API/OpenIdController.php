<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\MKDBInterface;
use App\Interfaces\OpenIdInterface;
use App\Interfaces\SFDCInterface;
use Illuminate\Http\Request;
use App\Traits\ResponseAPI;

class OpenIdController extends Controller
{

    use ResponseAPI;

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
        $jLeagueUserCredentials = $this->getJLeagueUserInfo($oauthCredentials);
        $sfdcDataContact = $this->sfdcInterface->getSFDCUserData($jLeagueUserCredentials['mkdb_id'], $this->sfdcInterface->getSFDCOAuthToken()['access_token'])['Return_Data'][0];
        $link_type = ($sfdcDataContact['ClubMember']) ? 1 : 2;
        $user = $this->mkdbInterface->storeUserData([
            'request_no' => 'login',
            'entry_type' => 'non',
            'club_cd' => $jLeagueUserCredentials['club_cd'],
            'card_type' => 1,
            'mkdb_id' => $jLeagueUserCredentials['mkdb_id'],
            'post_cd' => $jLeagueUserCredentials['post_cd1'],
            'address_state' => $jLeagueUserCredentials['address_state'],
            'address_city' => $jLeagueUserCredentials['address_city'],
            'address_street' => $jLeagueUserCredentials['address_street'],
            'address_building' => $jLeagueUserCredentials['address_building'],
            'lastname' => $jLeagueUserCredentials['member_last_nm'],
            'firstname' => $jLeagueUserCredentials['member_first_nm'],
            'member_last_nm_kana' => $jLeagueUserCredentials['member_last_nm_lana'],
            'member_first_nm_kana' => $jLeagueUserCredentials['member_first_nm_kana'],
            'sex' => $jLeagueUserCredentials['sex_kbn'],
            'birthdate' => $jLeagueUserCredentials['birthday_ymd'],
            'mobilephone' => $jLeagueUserCredentials['tel_no_fixed'],
            'email' => $jLeagueUserCredentials['email']
        ]);
        $data = compact('jLeagueUserCredentials', 'oauthCredentials', 'link_type');
        return $this->successResponse(data: $data);
    }

    public function getJLeagueUserInfo($oauthCredentials)
    {
        return $this->openIdInterface->getJLeagueUserInfo($oauthCredentials);
    }

    public function updateJLeagueUserInfo(Request $request)
    {
    }
}
