# Integrasi SSO-Client Laravel

Package ini berbasis pada [Simple PHP SSO skeleton](https://github.com/zefy/php-simple-sso) dan dibuat khusus agar dapat berjalan dan digunakan di framework Laravel.

### Requirements
* Laravel 7+
* PHP 7.3+

### How it works?
Client visits Broker and unique token is generated. When new token is generated we need to attach Client session to his session in Broker so he will be redirected to Server and back to Broker at this moment new session in Server will be created and associated with Client session in Broker's page. When Client visits other Broker same steps will be done except that when Client will be redirected to Server he already use his old session and same session id which associated with Broker#1.

![flow](https://sso.samarindakota.go.id/img/flow.jpg)

# Installation

#### 1. Install Package


```shell
$ composer require n0izestr3am/sso-client
```

#### 2. Publish Vendor

Salin file config `sso.php` ke dalam folder `config/` pada projek Anda dengan menjalankan:
```shell
$ php artisan vendor:publish --provider="Novay\SSO\Providers\SSOServiceProvider"
``` 
Berikut adalah isi konten default dari file konfigurasi yang disalin:
```php
//config/sso.php

return [
    'name' => 'Single Sign On - Broker (Client)', 
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
<a href="{{ route('sso.authorize') }}">Login</a>
```

b) Logout

```html
<a href="{{ route('sso.logout') }}">Logout</a>
```

c) Manual Usage (Optional)

Untuk penggunaan secara manual, Anda bisa menyisipkan potongan script berikut kedalam fungsi login dan logout pada class controller Anda.
```php
protected function attemptLogin(Request $request)
{
    $broker = new \Novay\SSO\Services\Broker;
    
    $credentials = $this->credentials($request);
    return $broker->login($credentials['username'], $credentials['password']);
}

public function logout(Request $request)
{
    $broker = new \Novay\SSO\Services\Broker;
    $broker->logout();
    
    $this->guard()->logout();
    $request->session()->invalidate();
    
    return redirect('/');
}
```

Demikian. Untuk halaman Broker lain Anda harus mengulang semuanya dari awal hanya dengan mengubah nama dan secret Broker Anda di file konfigurasi.

Contoh tambahan pada file `.env`:
```shell
SSO_SERVER_URL=server
SSO_BROKER_NAME=client
SSO_BROKER_SECRET=XXXXXXXXXXXXXXXX
```
