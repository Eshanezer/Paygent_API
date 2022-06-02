<?php
namespace App\Interfaces;

interface SFDCInterface {
    public function getSFDCOAuthToken();
    public function getSFDCUserData($mkdb_id,$token);
}
