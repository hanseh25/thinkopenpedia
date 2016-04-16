<?php

Route::group(['prefix' => 'pedia', 'namespace' => 'Modules\Pedia\Http\Controllers', 'middleware' => 'auth.access:pedia'], function()
{
    Route::get('/', 'PediaController@index');

    Route::get('/browse', 'PediaController@getEventData');
    Route::get('/read', 'PediaController@insertNewEvent');
    Route::post('/add', 'PediaController@update');
    Route::post('/edit', 'PediaController@moved');
    Route::post('/delete', 'PediaController@delete');

    Route::get('/growth/{patient_id}', 'GrowthProgressController@browse')
		->name('growth.browse');
    Route::get('/growth/read/{id}', 'GrowthProgressController@read');
    Route::get('/growth/add/{patient_id}', 'GrowthProgressController@add');
    Route::get('/growth/edit/{id}', 'GrowthProgressController@edit');
    Route::post('/growth/add/{patient_id}', 'GrowthProgressController@add');
    Route::post('/growth/edit/{id}', 'GrowthProgressController@edit');
    Route::get('/growth/delete/{id}', 'GrowthProgressController@delete');


    Route::group(['prefix' => 'healthcareservices', 'middleware' => 'auth.access:healthcareservices'], function()
    {

        Route::get('/', ['as' => 'healthcare.index', 'uses' => 'HealthcareservicesController@index']);
        Route::get('/{action}/{patiend_id}', ['as' => 'healthcare.add', 'uses' => 'HealthcareservicesController@index']);
        /** Follow up  */
        Route::get('/{action}/{patiend_id}/{hservice_id}', ['as' => 'pedia.healthcare.add', 'uses' => 'HealthcareservicesController@index']);
        Route::get('/{action}/{patiend_id}/{hservice_id}', ['as' => 'pedia.healthcare.edit', 'uses' => 'HealthcareservicesController@index']);

        Route::post('/insert', ['as' => 'pedia.healthcare.insert', 'uses' => 'HealthcareservicesController@insert']);
        Route::get('/view', ['as' => 'pedia.healthcare.view', 'uses' => 'HealthcareservicesController@view']);

        Route::post('/vitals/add', ['as' => 'vitals.insert', 'uses' => 'VitalsController@add']);
        Route::post('/vitals/edit', ['as' => 'vitals.edit', 'uses' => 'VitalsController@edit']);
        Route::post('/complaints/add', ['as' => 'complaints.insert', 'uses' => 'ComplaintsController@add']);
        Route::post('/complaints/edit', ['as' => 'complaints.edit', 'uses' => 'ComplaintsController@edit']);

        Route::post('/medorder/add', ['as' => 'medorder.insert', 'uses' => 'MedicalOrderController@UpdateCreate']);
        Route::get('/medorder/print/prescription/{id}', ['as' => 'medorder.printpresc', 'uses' => 'MedicalOrderController@printPrescription']);
        Route::get('/medorder/print/laboratory/{id}', ['as' => 'medorder.printlab', 'uses' => 'MedicalOrderController@printLaboratory']);

        Route::post('/disposition/add', ['as' => 'disposition.insert', 'uses' => 'DispositionController@add']);
        Route::post('/disposition/edit', ['as' => 'disposition.edit', 'uses' => 'DispositionController@edit']);

        Route::post('/impression-and-diagnosis/add', ['as' => 'imp.insert', 'uses' => 'ImpressionandDiagnosisController@UpdateCreate']);
        Route::post('/impression-and-diagnosis/edit', ['as' => 'imp.edit', 'uses' => 'ImpressionandDiagnosisController@UpdateCreate']);

        Route::post('/exam/add', ['as' => 'exam.insert', 'uses' => 'ExaminationsController@add']);
        Route::post('/exam/edit', ['as' => 'exam.edit', 'uses' => 'ExaminationsController@edit']);

        Route::post('/addendum/add', ['as' => 'addendum.add', 'uses' => 'AddendumController@add']);

    });

    Route::group(['prefix' => 'patients', 'middleware' => 'auth.access:patients'], function()
    {
        $r_alias = 'patients';
        Route::get('/', ['uses'=>'PatientsController@index', 'middleware' => 'auth.access:patients']);
        Route::post('/check', 'PatientsController@check');
        Route::get('/add', 'PatientsController@add');
        Route::post('/save', 'PatientsController@save');
        Route::get('/view/{id}', ['as'=>'pedia.patients.view', 'uses'=>'PatientsController@view', 'middleware' => 'auth.access:patients']);
        Route::get('/{id}', 'PatientsController@dashboard');
        Route::post('/{id}', 'PatientsController@save');
        Route::delete('/{id}', 'PatientsController@delete');
        Route::patch('/{id}/edit', 'PatientsController@update');
        Route::post('/{id}/update', 'PatientsController@update');
        Route::get('/{id}/delete', ['as' => "{$r_alias}.delete", 'uses' => 'PatientsController@delete']);
        Route::get('/delete/{id}', 'PatientsController@delete');

        Route::get('/consultations', 'PatientsController@consultations');
        Route::get('{id}/deathinfo', 'PatientsController@viewDeathInfo');
        Route::get('/{id}/checkPatientMorbidity', 'PatientsController@checkPatientMorbidity');
        Route::patch('{id}/saveDeathInfo', 'PatientsController@saveDeathInfo');
        Route::post('/{id}/deathinfo', 'PatientsController@saveDeathInfo');
        
    });
});
