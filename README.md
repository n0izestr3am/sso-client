# Integrasi SSO-Client Laravel

Package ini berbasis pada [Simple PHP SSO skeleton](https://github.com/zefy/php-simple-sso) dan dibuat khusus agar dapat berjalan dan digunakan di framework Laravel.

### Requirements
* Laravel 7+
* PHP 7.3+


# Installation

#### 1. Install Package


```shell
$ composer require n0izestr3am/sso-client
```

#### 2. Publish Vendor

Salin file config `sso.php` ke dalam folder `config/` pada projek Anda dengan menjalankan:
```shell
$ php artisan vendor:publish --provider="n0izestr3am\SSO\Providers\SSOServiceProvider"
``` 
Berikut adalah isi konten default dari file konfigurasi yang disalin:
```php
//config/sso.php

return [
    'name' => 'Single Sign On - (Client)',
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
    | Pengaturan Umum untuk Broker
    |--------------------------------------------------------------------------
    | Beberapa parameter yang dibutuhkan untuk broker. Bisa ditemukan di
    | https://sso.samarindakota.go.id
    |
    */
    'server_url' => env('SSO_SERVER_URL', null),
    'broker_name' => env('SSO_BROKER_NAME', null),
    'broker_secret' => env('SSO_BROKER_SECRET', null),
];
```

#### 3. Edit Environment

Buat 3 opsi baru dalam file `.env` Anda:
```shell
SSO_SERVER_URL=
SSO_BROKER_NAME=
SSO_BROKER_SECRET=
```

#### 4. Register Middleware

Edit file `app/Http/Kernel.php` dan tambahkan `\n0izestr3am\SSO\Http\Middleware\SSOAutoLogin::class` ke grup `web` middleware. Contohnya seperti ini:
```php
protected $middlewareGroups = [
	'web' => [
		...
	    \n0izestr3am\SSO\Http\Middleware\SSOAutoLogin::class,
	],

	'api' => [
		...
	],
];
```


a) Buat Middleware Baru

```shell
$ php artisan make:middleware SSOAutoLogin
```

b) Extend **Default Middleware** ke **Custom Middleware**

```php
<?php

namespace App\Http\Middleware;

use n0izestr3am\SSO\Http\Middleware\SSOAutoLogin as Middleware;
use App\Models\User;

class SSOAutoLogin extends Middleware
{
    /**
     * Manage your users models as your default credentials
     *
     * @param Broker $response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleLogin($response)
    {
        $user = User::updateOrCreate(['uid' => $response['data']['id']], [
            'name' => $response['data']['name'], 
            'email' => $response['data']['email'], 
            'password' => 'default', 
        ]);

        auth()->login($user);

        return;
    }
}
```

c) Edit **Kernel.php**

```php
protected $middlewareGroups = [
    'web' => [
        ...
        // \Novay\SSO\Http\Middleware\SSOAutoLogin::class,
        \App\Http\Middleware\SSOAutoLogin::class,
    ],

    'api' => [
        ...
    ],
];
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

Demikian. Untuk halaman Broker lain Anda harus mengulang semuanya dari awal hanya dengan mengubah nama dan secret Broker Anda di file konfigurasi.

Contoh tambahan pada file `.env`:
```shell
SSO_CLIENT_ID="xxxx"
SSO_CLIENT_SECRET="xxx"
SSO_CLIENT_CALLBACK="http://localhost/callback"
SSO_SCOPES="view-user"
SSO_HOST="http://localhost/server"
```
