<?php

namespace App\Http\Controllers;

use App\Models\IPFilter;
use Illuminate\Http\Request;

class IPFilterController extends Controller
{
    public function block($ip)
    {
        return (IPFilter::where('block', 1)->where('ip', $ip)->first()) ? true : false;
    }
}
