<?php

//Installer Routes
Route::get('/install/proceed/consent','InstallerController@consent')->name('installer');
Route::post('/install/proceed/consent','InstallerController@storeconsent')->name('store.consent');
Route::get('/install/proceed/servercheck','InstallerController@serverCheck')->name('servercheck');
Route::post('/install/proceed/servercheck','InstallerController@storeserver')->name('store.server');
Route::get('verifylicense','InstallerController@verifylicense')->name('verifylicense');
Route::get('install/proceed/verifyapp','InstallerController@verify')->name('verifyApp');
Route::post('verifycode','InitializeController@verify');
Route::get('/install/proceed/step1','InstallerController@index')->name('installApp');
Route::post('store/step1','InstallerController@step1')->name('store.step1');
Route::get('get/step2','InstallerController@getstep2')->name('get.step2');
Route::post('store/step2','InstallerController@step2')->name('store.step2');
Route::get('get/step3','InstallerController@getstep3')->name('get.step3');
Route::post('store/step3','InstallerController@storeStep3')->name('store.step3');
Route::get('get/step4','InstallerController@getstep4')->name('get.step4');
Route::post('store/step4','InstallerController@storeStep4')->name('store.step4');
Route::get('get/step5','InstallerController@getstep5')->name('get.step5');
Route::post('store/step5','InstallerController@storeStep5')->name('store.step5');

Route::middleware(['IsInstalled'])->group(function () {

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
            'prefix' => 'admins', 
            'as' => 'admin.', 
            'namespace' => 'Admin', 
            'middleware' => ['auth', 'admin']
        ], function () {
            Route::get('/', 'HomeController@index')->name('home');
            includeRouteFiles(__DIR__ . '/AdminBackend/');

            
            //Subject Areas
            Route::delete('subject-areas/destroy', 'SubjectAreaController@massDestroy')->name('subject-areas.massDestroy');
            Route::get('subject-areas/check-slug', 'SubjectAreaController@checkSlug')->name('subject-areas.checkSlug');
            Route::resource('subject-areas','SubjectAreaController');
            
            //Parameters and options
            Route::delete('parameters/destroy', 'ParameterController@massDestroy')->name('parameters.massDestroy');
            Route::get('parameters/check-slug', 'ParameterController@checkSlug')->name('parameters.checkSlug');
            Route::resource('parameters','ParameterController');
            
            //Provinces and districts
            Route::delete('provinces/destroy', 'ProvinceController@massDestroy')->name('provinces.massDestroy');
            Route::get('provinces/check-slug', 'ProvinceController@checkSlug')->name('provinces.checkSlug');
            Route::resource('provinces','ProvinceController');
            
            //Organizations
            Route::get('organizations/organization-province','OrganizationController@organizationProvince')->name('organization-province');
            Route::delete('organizations/destroy', 'OrganizationController@massDestroy')->name('organizations.massDestroy');
            Route::get('organizations/check-slug', 'OrganizationController@checkSlug')->name('organizations.checkSlug');
            Route::resource('organizations','OrganizationController');
            
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
});
