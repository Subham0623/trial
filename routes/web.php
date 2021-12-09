<?php

includeRouteFiles(__DIR__ . '/Site/');

Auth::routes(['verify'=>true]);

// User
Route::group([
        'prefix' => 'user',
        'as' => 'user.',
        'namespace' => 'User',
        'middleware' => ['auth','verified']
    ], function () {
        Route::get('/', 'HomeController@index')->name('home');
        includeRouteFiles(__DIR__ . '/UserBackend/');

});

// Admin
Route::group([
        'prefix' => 'admin', 
        'as' => 'admin.', 
        'namespace' => 'Admin', 
        'middleware' => ['auth', 'admin']
    ], function () {
        Route::get('/', 'HomeController@index')->name('home');
        includeRouteFiles(__DIR__ . '/AdminBackend/');
        
});

Route::group([
        'prefix' => 'profile', 
        'as' => 'profile.', 
        'namespace' => 'Auth', 
        'middleware' => ['auth']
    ], function () {
        // Change password
        if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
            Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
            Route::post('password', 'ChangePasswordController@update')->name('password.update');
        }

});

// categorywise switching pages
Route::get('/{category:slug}/{childCategory:slug?}/{childCategory2?}/{childCategory3?}', 'HomeController@category')->name('category');

