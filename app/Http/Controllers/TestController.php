<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function check()
    {
        $testText='2022-05-19T06:42:16+0000';
        return Carbon::parse($testText,'UTC')->format('Y-m-d h:i:s');
    }
}
