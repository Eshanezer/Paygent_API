<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\MKDBInterface;

class MKDBController extends Controller
{
    protected $mkdbInterface;

    public function __construct(MKDBInterface $mkdbInterface)
    {
        $this->mkdbInterface = $mkdbInterface;
    }

    public function storeUser($openIdUserData,$sfdcUserData){
        $this->mkdbInterface->storeUserData([
            'request_no' => 'login',
            'entry_type'=>'',
            'club_cd' => $openIdUserData->club_cd,
            'card_type'=>'',
            'mkdb_id' => $openIdUserData->mkdb_id,
            'post_cd' => $sfdcUserData->POST_CD,
            'address_state' => $sfdcUserData->ADDRESS_STREET,
            'address_city' => $sfdcUserData->ADDRESS_CITY,
            'address_street' => $sfdcUserData->ADDRESS_STREET,
            'address_building' => $openIdUserData->address_building,
            'lastname' => $sfdcUserData->FirstName,
            'firstname' => $sfdcUserData->LastName,
            'member_last_nm_kana' => $sfdcUserData->MEMBER_LAST_NM_KANA,
            'member_first_nm_kana' => $sfdcUserData->MEMBER_FIRST_NM_KANA,
            'sex' => $sfdcUserData->SEX,
            'birthdate' => $sfdcUserData->Birthdate,
            'mobilephone' => $sfdcUserData->mkdb_Phoneid,
            'email' => $sfdcUserData->Email
        ]);
    }
}
