<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Jumbojett\OpenIDConnectClient;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 123;
    // return view('welcome');
    $clientId = 'gatewayYM';
    $clientSecret = '2yyiWMytitpqKbwbjLsmPvHPTfAUnqTF';

    // $clientId = 'gatewayNG ';
    // $clientSecret = 'SKKhNQBAN8cwWVhPJ7z5FHPfgQtFuDMw';

    // $clientId = '3MVG9Gdzj3taRxuNZGYlwtt.Evj.0VjVDnNtSzjDxiZIgCnKjbmRyN.aM5PihW6pQtnnuquroeEo4nyXZ4jjg ';
    // $clientSecret = '598BB0BFAFAB69AF001F5C120F6F4D54073BDBBB2A0275F4CDE0F5EEF3B40E53';

    // $provider_url = 'https://jleague-platform--full2.my.salesforce.com/services/apexrest/%EF%BD%9E';
    // $provider_url = 'https://test.salesforce.com/services/oauth2/token';
    // $provider_url = 'https://jleague-platform--full2.my.salesforce.xn--com-r73bvbya2x1d8867a8fyg/';
    // $provider_url = 'http://127.0.0.1:8000/test';
    // $provider_url = 'https://login.jleague.jp/oauth/authorize';  // ! this link is provided in slide 7 - Login
    // $provider_url = 'https://login.jleague.jp/';
    $provider_url = 'https://login2.jleague.jp/';

    $oidc = new OpenIDConnectClient(
        $provider_url,
        $clientId,
        $clientSecret,
    );
    // $oidc->setCertPath('/path/to/my.cert');
    $oidc->authenticate();

    // $oidc->setVerifyHost(false);
    // $oidc->setVerifyPeer(false);

    $name = $oidc->requestUserInfo('given_name');


    return view('welcome');
});

Route::get('/auth/redirect', function (Request $request) {
    return $request;
});
