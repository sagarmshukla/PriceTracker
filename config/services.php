<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => 'sandbox2618aa8e03de4a57a05622e4a9c2da57.mailgun.org',
        'secret' => 'key-bf75c7d1a1429bed828bdff63adb9e8e',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => Trackyourprice\User::class,
        'key'    => '',
        'secret' => '',
    ],

    'google' => [
        'client_id' => '839285889802-3j9lhemc8cln7sk25iavde2vfvoqaako.apps.googleusercontent.com',
        'client_secret' => 'sOBjoMupEJvnpPmBX-n9hBp_',
        'redirect' => 'http://trackyourprice.dev/login/google',
    ],

    'facebook' => [
        'client_id' => '915381765176893',
        'client_secret' => 'bd705e21adc4ca16569a374725e13b1f',
        'redirect' => 'http://trackyourprice.dev/login/facebook',
    ],

];
