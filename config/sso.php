<?php

return [
    'name' => 'OAuth 2.0 Single Sign On Laravel (Client)',
    'version' => '1.0.0',

    /*
    |--------------------------------------------------------------------------
    | Redirect to ???
    |--------------------------------------------------------------------------
    | Arahkan kemana Anda akan tuju setelah login berhasil
    |
    */
    'redirect_to' => env("SSO_REDIRECT_TO"),

    /*
    |--------------------------------------------------------------------------
    | Konfigurasi auth.php
    |--------------------------------------------------------------------------
    | Pilih guard auth default yang dipakai
    |
    */
    'guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Pengaturan Umum untuk Client
    |--------------------------------------------------------------------------

    |
    */
     //SSO credentials
    'client_id' => env("SSO_CLIENT_ID"),
    'client_secret' => env("SSO_CLIENT_SECRET"),
    'callback' => env("SSO_CLIENT_CALLBACK"),
    'scopes' => env("SSO_SCOPES"),
    'sso_host' => env("SSO_HOST"),

    /*
    |--------------------------------------------------------------------------
    | Custom for UserList
    |--------------------------------------------------------------------------
    | Tentukan Model User yang dipakai
    |
    */
    'model' => '\App\Models\User'
];