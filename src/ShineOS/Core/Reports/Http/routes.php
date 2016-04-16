<?php

Route::group(['prefix' => 'reports', 'namespace' => 'ShineOS\Core\Reports\Http\Controllers', 'middleware' => 'auth.access:reports'], function()
{
    Route::get('/', 'ReportsController@index');
    //Route::any('/{type?}', array('as' => 'generate-report', 'uses' => 'ReportsController@generateReport')); //create 404 when not found
    Route::post('/getpatientinfo', 'ReportsController@getReportDataJSON');
    Route::post('/graph', 'ReportsController@getFilteredResults');
});
