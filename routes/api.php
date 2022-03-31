<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product Categories
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\User', 'middleware' => ['auth:api']], function () {

    Route::get('/form','HomeApiController@form')->name('form');
    Route::post('/form','HomeApiController@store')->name('form-store');
    Route::get('/forms','HomeApiController@show')->name('forms-show');
    Route::get('/form/{form}','HomeApiController@edit')->name('form-edit');
    Route::patch('/form/{form}','HomeApiController@update')->name('form-update');
    Route::patch('/form/submit/{form}','HomeApiController@submit')->name('submit');
    Route::get('/profile','HomeApiController@profile')->name('profile');
    Route::post('/upload','HomeApiController@fileUpload')->name('upload');
    Route::get('/test','HomeApiController@test')->name('test');

    Route::patch('/form/{form}/reassign','HomeApiController@reassign')->name('form-reassign');
    Route::post('/feedback','HomeApiController@feedback')->name('feedback-store');
    Route::patch('/feedback/{feedback}','HomeApiController@feedbackStatus')->name('feedback-status-update');
});

Route::get('/', 'Api\V1\HomeApiController@index')->name('index');
Route::get('/province','Api\V1\HomeApiController@province')->name('province');

Route::post('/login','Api\V1\LoginApiController@login');
Route::middleware('auth:api')->post('/logout','Api\V1\LoginApiController@logout');


Route::post('/register','Api\V1\RegisterApiController@register');
Route::post('/password/reset','Api\V1\ResetPasswordController@reset');
// Route::post('/password/email','Api\V1\ForgetPasswordController@sendResetLinkResponse');
// Route::get('/usercart', 'CartApiController@usercart');