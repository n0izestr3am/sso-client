# OAuth 2.0 "Single Sign On" Laravel (Client)


### Requirements Minimum
* Laravel 7+
* PHP 7.3+


# Installation
#### 1. Install Package

```shell
$ composer require n0izestr3am/sso-client
```

#### 2. Publish Vendor

Copy file config `sso.php` ka  folder `config/` di project client :
```shell
$ php artisan vendor:publish --provider="n0izestr3am\SSO\Providers\SSOServiceProvider"
``` 
Conto konfigurasi file nu di copy ka folder `config` di Laravel:
```php
//config/sso.php

return [
    'name' => 'OAuth 2.0 Single Sign On Laravel | versi (Client)',
    'version' => '1.0.0',

    /*
    |--------------------------------------------------------------------------
    | Redirect to ???
    |--------------------------------------------------------------------------
    | Redirect lamun login tos berhasil di app klien na
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
     // SSO credentials //lokasi di folder config/sso.php
    'client_id' => env("SSO_CLIENT_ID"),
    'client_secret' => env("SSO_CLIENT_SECRET"),
    'callback' => env("SSO_CLIENT_CALLBACK"),
    'scopes' => env("SSO_SCOPES"),
    'sso_host' => env("SSO_HOST"),


];
```

#### 3. Edit Environment

jieun 5 opsi di file `.env` aplikasi versi klien na:
```shell
SSO_CLIENT_ID=
SSO_CLIENT_SECRET=
SSO_CLIENT_CALLBACK=
SSO_SCOPES=
SSO_HOST=
SSO_REDIRECT_TO=
```
#### 5. Cara make

a) Login //

```html
<a href="{{ route('sso.login') }}">Login</a>
```

b) Logout

```html
<a href="{{ route('sso.logout') }}">Logout</a>
```

Mun Nambah Aplikasi Client anu lain cukup tambahkeun we secret Client (nu di jieun di server SSO na)di file konfigurasi na .

Contoh parameter di `.env` versi Client:
```shell
SSO_CLIENT_ID="xxxx"
SSO_CLIENT_SECRET="xxx"
SSO_CLIENT_CALLBACK="http://localhost/callback"
SSO_SCOPES="view-user"
SSO_HOST="http://localhost/server"
SSO_REDIRECT_TO="/home"
```
