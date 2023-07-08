<?php

Route::prefix('oauth/sso')->namespace('n0izestr3am\\SSO\\Http\\Controllers')->middleware('web')->group(function()
{
	Route::get('/sso/login', 'SSOController@getLogin')->name('sso.login');
	Route::get('/sso/callback', 'SSOController@getCallback')->name('sso.callback');
	Route::get('/sso/connect', 'SSOController@connectUser')->name('sso.connect');
});