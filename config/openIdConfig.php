<?php

$endpoints = [
    'j_league' => [
        'base_url' => 'https://login2.jleague.jp',
        'get_oauth_token' => '/oauth/token',
        'get_user_info' => '/userinfo',
    ],
    'frontend' => [
        'base_url' => 'http://fanengage.net',
        'redirect_login' => '/auth/redirect',
    ],
];

// * j league only
$j_league_endpoints =  $endpoints['j_league'];
$j_league_base_url = $j_league_endpoints['base_url'];
$get_oauth_token_endpoint = $j_league_base_url . $j_league_endpoints['get_oauth_token'] ;
$get_user_info_endpoint = $j_league_base_url . $j_league_endpoints['get_user_info'] ;

// * frontend only
$frontend_endpoints = $endpoints['frontend'];
$frontend_base_url = $frontend_endpoints['base_url'];
$get_login_redirect_endpoint = $frontend_base_url . $frontend_endpoints['redirect_login'] ;

return [

    'client_credentials' => [
        'yokohama_marinos' => [
            'client_id' => 'gatewayYM',
            'client_secret' => '2yyiWMytitpqKbwbjLsmPvHPTfAUnqTF',
        ],
        'nagoya_grampus' => [
            'client_id' => 'gatewayNG',
            'client_secret' => 'SKKhNQBAN8cwWVhPJ7z5FHPfgQtFuDMw',
        ],
    ],
    'endpoints' => [
        'get_oauth_token_endpoint' => $get_oauth_token_endpoint,
        'get_user_info_endpoint' => $get_user_info_endpoint,
        'get_login_redirect_endpoint' => $get_login_redirect_endpoint,
    ],
];

