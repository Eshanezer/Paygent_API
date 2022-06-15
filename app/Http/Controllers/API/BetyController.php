<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BetyController extends Controller
{
    public function testPurchaseStart(){

        $xml='<?xml version="1.0" encoding="UTF-8" standalone="yes"?><transactionRequest><timestamp>20110225121212<</timestamp></transactionRequest>';
        // $xml='';
        $checkSumHash=sha1($xml.config('betyCredentials.BETY_CHECKSUM'));
        $response=Http::withHeaders(['End-User-Agent'=>' Mozilla / 5.0 (Windows NT 6.1) AppleWebKit / 537.36 (KHTML, like Gecko) Chrome / 75.0.3770.142 Safari / 537.36'])->post(config('externaApiRoutes.BETY_PURCHASE_START').'?apikey='.config('betyCredentials.BETY_APIKEY').'&checksum='.$checkSumHash,$xml);
        return $response->body();
    }
}
