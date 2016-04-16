<?php

Route::group(['prefix' => 'pedia', 'namespace' => 'Modules\Pedia\Http\Controllers', 'middleware' => 'auth.access:pedia'], function()
{
    Route::get('/', 'PediaController@index');

    Route::get('/browse', 'PediaController@getEventData');
    Route::get('/read', 'PediaController@insertNewEvent');
    Route::post('/add', 'PediaController@update');
    Route::post('/edit', 'PediaController@moved');
    Route::post('/delete', 'PediaController@delete');

    Route::get('/growth', 'GrowthProgressController@browse');
    Route::get('/growth/read/{id}', 'GrowthProgressController@read');
    Route::get('/growth/add/{id}', 'GrowthProgressController@addEdit');
    Route::get('/growth/edit/{id}', 'GrowthProgressController@addEdit');
    Route::post('/growth/add/{id}', 'GrowthProgressController@addEdit');
    Route::post('/growth/edit/{id}', 'GrowthProgressController@addEdit');
});
