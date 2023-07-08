<?php

Route::prefix('sso')->namespace('n0izestr3am\\SSO\\Http\\Controllers')->middleware('web')->group(function()
{
	Route::get('/login', 'SSOController@getLogin')->name('sso.login');
	Route::get('/callback', 'SSOController@getCallback')->name('sso.callback');
	Route::get('/connect', 'SSOController@connectUser')->name('sso.connect');
});