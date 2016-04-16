<?php

Route::group(['prefix' => 'settings', 'namespace' => 'Modules\Settings\Http\Controllers', 'middleware' => 'auth.access:settings'], function()
{
	Route::get('/', 'SettingsController@index');
	Route::get('/modules', 'SettingsController@getModules');
	Route::post('/saveModules', 'SettingsController@saveModules');
});