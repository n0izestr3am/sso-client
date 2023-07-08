<?php

return [
    'name' => 'Single Sign On (Client)',
    'version' => '1.0.0',

    /*
    |--------------------------------------------------------------------------
    | Redirect to ???
    |--------------------------------------------------------------------------
    | Arahkan kemana Anda akan tuju setelah login berhasil
    |
    */
    'redirect_to' => '/home', 

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
    'server_url'      => env('SSO_HOST', null),
    'client_id'       => env('SSO_CLIENT_ID', null),
    'client_secret'   => env('SSO_CLIENT_SECRET', null),
    'client_callback' => env('SSO_CLIENT_CALLBACK', null),
    'client_scopes'   => env('SSO_SCOPES', null),

    /*
    |--------------------------------------------------------------------------
    | Custom for UserList
    |--------------------------------------------------------------------------
    | Tentukan Model User yang dipakai
    |
    */
    'model' => '\App\Models\User'
];