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




Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1'], function () {

Route::get('/index', 'HomeApiController@index')->name('index');
Route::get('/index/filter','HomeApiController@filter')->name('filter-index');
// Route::get('/filter/{organization}','HomeApiController@organizationDetail');
Route::get('organization/detail/{organization}','HomeApiController@organizationDetail')->name('organization-details');

Route::get('/province','HomeApiController@province')->name('province');

Route::post('/login','LoginApiController@login');
Route::post('/reset','ResetPasswordApiController@reset');
Route::post('/password/forget','ForgetPasswordApiController@forget');
Route::middleware('auth:api')->post('/logout','LoginApiController@logout');


Route::post('/register','RegisterApiController@register');
Route::post('/password/reset','ResetPasswordController@reset');
});

// Route::post('/password/email','ForgetPasswordController@sendResetLinkResponse');
// Route::get('/usercart', 'CartApiController@usercart');