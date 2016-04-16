<?php

Route::group(['prefix' => 'records', 'namespace' => 'ShineOS\Core\Records\Http\Controllers', 'middleware' => 'auth.access:records'], function()
{
    Route::get('/', 'RecordsController@index');
    Route::get('/search', 'RecordsController@search');
    Route::post('/search/getResults', 'RecordsController@getResults');
});
