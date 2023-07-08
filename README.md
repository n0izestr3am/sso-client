# OAuth 2.0 "Single Sign On" Laravel (Client)


### Requirements
* Laravel 7+
* PHP 7.3+


# Installation
#### 1. Install Package

```shell
$ composer require n0izestr3am/sso-client
```

#### 2. Publish Vendor

Copy file config `sso.php` ke dalam folder `config/` pada projek dengan menjalankan:
```shell
$ php artisan vendor:publish --provider="n0izestr3am\SSO\Providers\SSOServiceProvider"
``` 
Isi konten default dari file konfigurasi yang copy:
```php
//config/sso.php

return [
    'name' => 'OAuth 2.0 Single Sign On Laravel (Client',
    'version' => '1.0.0',

    /*
    |--------------------------------------------------------------------------
    | Redirect to ???
    |--------------------------------------------------------------------------
    | Redirect setelah login berhasil
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
    | Pengaturan untuk Client
    |--------------------------------------------------------------------------

    |
    */
     // SSO credentials
    'client_id' => env("SSO_CLIENT_ID"),
    'client_secret' => env("SSO_CLIENT_SECRET"),
    'callback' => env("SSO_CLIENT_CALLBACK"),
    'scopes' => env("SSO_SCOPES"),
    'sso_host' => env("SSO_HOST"),
];
```

#### 3. Edit Environment

Buat 3 opsi baru dalam file `.env` Anda:
```shell
SSO_CLIENT_ID=
SSO_CLIENT_SECRET=
SSO_CLIENT_CALLBACK=
SSO_SCOPES=
SSO_HOST=
SSO_REDIRECT_TO=
```
#### 5. Usage

a) Login

```html
<a href="{{ route('sso.login') }}">Login</a>
```

b) Logout

```html
<a href="{{ route('sso.logout') }}">Logout</a>
```

Untuk halaman Client lain cukup  tambahkan nama dan secret Client di file konfigurasi.

Contoh tambahan pada file `.env` versi Client:
```shell
SSO_CLIENT_ID="xxxx"
SSO_CLIENT_SECRET="xxx"
SSO_CLIENT_CALLBACK="http://localhost/callback"
SSO_SCOPES="view-user"
SSO_HOST="http://localhost/server"
SSO_REDIRECT_TO="/home"
```
