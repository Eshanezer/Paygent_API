<?php

return [
    'LOGIN'=>env('EXTERNAL_BASEURL').'test',
    'REGISTER'=>env('EXTERNAL_BASEURL').'register',
    'CHECK_USER_DATA'=>env('EXTERNAL_BASEURL').'checkUserData',
    'OPENID_AUTH_USER_INFO'=>env('OPENIDAUTH_BASEURL').'userinfo',
    'SFDC_AUTH_TOKEN'=>env('SFDCAUTH_BASEURL').'oauth2/token',
    'SFDC_READ_DATA'=>env('SFDC_BASEURL').'ReadApi'
];
