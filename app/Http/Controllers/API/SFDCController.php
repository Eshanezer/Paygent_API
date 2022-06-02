<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Interfaces\SFDCInterface;

class SFDCController extends Controller
{
    protected $SFDCInterface;

    public function __construct(SFDCInterface $SFDCInterface)
    {
        $this->SFDCInterface = $SFDCInterface;
    }

    public function getSFDCUserData(){
        $mkdb_id='0031m00000NhgEkAAJ';
        $code =  $this->SFDCInterface->getSFDCOAuthToken();
        return $code;
        return $this->SFDCInterface->getSFDCUserData($mkdb_id,$code['access_token']);
    }
}
