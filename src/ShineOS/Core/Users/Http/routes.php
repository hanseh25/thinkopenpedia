<?php

# user management and user profile
Route::group(['prefix' => 'users', 'namespace' => 'ShineOS\Core\Users\Http\Controllers', 'middleware' => 'auth.access:users'], function()
{
    Route::get('/', 'UsersController@index');
    Route::get('/add', 'UsersController@adduser');
    Route::post('/add', 'UsersController@store');
    Route::get('/{id}', 'UsersController@profile');
    Route::post('/updateinfo/{id}', 'UsersController@updateInfo');
    Route::post('/updatebackground/{id}', 'UsersController@updateBackground');
    Route::get('/delete/{id}', 'UsersController@deleteUser');
    Route::get('/disable/{id}', 'UsersController@disableUser');
    Route::get('/enable/{id}', 'UsersController@enableUser');
    Route::post('/changepassword/{id}', 'UsersController@changeUserPassword');
    Route::get('/changeprofilepic/{id}', 'UsersController@changeprofilepic');
    Route::post('/changeprofilepic_update/{id}', 'UsersController@changeprofilepic_update');

    Route::get('/access/{id}', 'UsersController@access');
    Route::get('/facilities/{id}', 'UsersController@facilities');
    Route::get('/audittrail/{id}', 'UsersController@auditTrail');
    Route::post('/save_role/{id}', 'UsersController@saveRole');

});

# registration
Route::group(['prefix' => 'registration', 'namespace' => 'ShineOS\Core\Users\Http\Controllers'], function()
{
    Route::get('/', 'RegistrationController@index');
    Route::post('/register', 'RegistrationController@register');
    Route::get('/captcha', 'RegistrationController@captcha');
    Route::post('/check_captcha', 'RegistrationController@check_captcha');
    Route::post('/check_doh_code', 'RegistrationController@check_doh_code');
});

# activate account
Route::group(['prefix' => 'activateaccount', 'namespace' => 'ShineOS\Core\Users\Http\Controllers'], function()
{
    Route::get('/', 'RegistrationController@activate_account');
    Route::get('/admin/{activation_code}', 'RegistrationController@activate_admin');
    Route::get('/user/{activation_code}', 'RegistrationController@activate_account');
    Route::post('/verify/{activation_code}', 'RegistrationController@verify_user_account');
});

# logout
Route::group(['prefix' => 'logout', 'namespace' => 'ShineOS\Core\Users\Http\Controllers'], function()
{
    Route::get('/{id}', 'LoginController@logout');
});

# forgot password
Route::group(['prefix' => 'forgotpassword', 'namespace' => 'ShineOS\Core\Users\Http\Controllers'], function()
{
    Route::get('/', 'LoginController@forgotpassword');
    Route::post('/send', 'LoginController@forgotpasswordSend');
    Route::get('/changepassword/{password_code}', 'LoginController@changepassword');
    Route::post('/changepassword_request', 'LoginController@changepassword_request');
});

# login
Route::group(['prefix' => 'login', 'namespace' => 'ShineOS\Core\Users\Http\Controllers'], function()
{
    Route::get('/', 'LoginController@index');
    Route::post('/verify', 'LoginController@checkLogin');
});

# selectfacility
Route::group(['prefix' => 'selectfacility', 'namespace' => 'ShineOS\Core\Users\Http\Controllers'], function()
{
    Route::get('/', 'LoginController@select_facility');
    Route::get('/assign/{facility_id}', 'LoginController@assign_facility');
});
