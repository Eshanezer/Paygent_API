<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\MKDBInterface;
use App\Interfaces\SFDCInterface;

class SFDCController extends Controller
{
    protected $SFDCInterface;
    protected $mkdbInterface;

    public function __construct(SFDCInterface $SFDCInterface,MKDBInterface $mkdbInterface)
    {
        $this->SFDCInterface = $SFDCInterface;
        $this->mkdbInterface = $mkdbInterface;
    }

    public function getSFDCUserData($mkdb_id){
        return $this->SFDCInterface->getSFDCUserData($mkdb_id,$this->SFDCInterface->getSFDCOAuthToken()['access_token']);
    }

    public function createUser($openIdUserData){
        //sfdc data
        // $sfdcUserData=[];
        //  $this->mkdbInterface->storeUserData([
        //     'request_no' => 'login',
        //     'entry_type'=>'',
        //     'club_cd' => $openIdUserData->club_cd,
        //     'card_type'=>'',
        //     'mkdb_id' => $openIdUserData->mkdb_id,
        //     'post_cd' => $sfdcUserData->POST_CD,
        //     'address_state' => $sfdcUserData->ADDRESS_STREET,
        //     'address_city' => $sfdcUserData->ADDRESS_CITY,
        //     'address_street' => $sfdcUserData->ADDRESS_STREET,
        //     'address_building' => $openIdUserData->address_building,
        //     'lastname' => $sfdcUserData->FirstName,
        //     'firstname' => $sfdcUserData->LastName,
        //     'member_last_nm_kana' => $sfdcUserData->MEMBER_LAST_NM_KANA,
        //     'member_first_nm_kana' => $sfdcUserData->MEMBER_FIRST_NM_KANA,
        //     'sex' => $sfdcUserData->SEX,
        //     'birthdate' => $sfdcUserData->Birthdate,
        //     'mobilephone' => $sfdcUserData->mkdb_Phoneid,
        //     'email' => $sfdcUserData->Email
        // ]);

        (new MKDBController(new MKDBInterface()))->storeUser([],[]);

    }
}
