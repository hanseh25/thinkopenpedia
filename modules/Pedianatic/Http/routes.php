<?php

Route::group(['prefix' => 'pedianatic', 'namespace' => 'Modules\Pedianatic\Http\Controllers', 'middleware' => 'auth.access:pedianatic'], function()
{
    Route::get('/', 'PedianaticController@index');
});
