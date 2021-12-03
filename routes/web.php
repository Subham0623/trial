<?php



Route::get('/', 'HomeController@index')->name('index');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/contact', function () {
    return view('site.contact');
})->name('contact');

Route::get('/home', function () {
    if(auth()->user()->is_admin) {
        if (session('status')) {
            return redirect()->route('admin.home')->with('status', session('status'));
        }

        return redirect()->route('admin.home');
    } else {
        return redirect()->route('user.home');
    }
});

Auth::routes(['verify'=>true]);

// User
Route::group([
        'prefix' => 'user',
        'as' => 'user.',
        'namespace' => 'User',
        'middleware' => ['auth','verified']
    ], function () {
    Route::get('/', 'HomeController@index')->name('home');

});

// Admin
Route::group([
        'prefix' => 'admin', 
        'as' => 'admin.', 
        'namespace' => 'Admin', 
        'middleware' => ['auth', 'admin']
    ], function () {
    Route::get('/', 'HomeController@index')->name('home');
    
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::get('users/manage-access/{user}', 'UsersController@manageAccessToBook')->name('users.manageAccessToBook');
    Route::post('users/add-more-subjects/{user}', 'UsersController@addMoreSubject')->name('users.addMoreSubject');
    Route::resource('users', 'UsersController');
    Route::get('users/can-read-book/{user}/{level}/{tag}/{flag}', 'UsersController@canReadBook')->name('users.can-read-book');

    // settings
    Route::resource('settings', 'SettingsController');

    // Product Categories
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::get('product-categories/check-slug', 'ProductCategoryController@checkSlug')->name('product-categories.checkSlug');
    Route::get('product-categories/list', 'ProductCategoryController@sortList')->name('product-categories.list');
    Route::post('product-categories/save-nested-categories', 'ProductCategoryController@saveNestedCategories')->name('product-categories.save-nested-categories');
    Route::resource('product-categories', 'ProductCategoryController');

    //Sliders
    Route::delete('sliders/destroy', 'SliderController@massDestroy')->name('sliders.massDestroy');
    Route::post('sliders/media', 'SliderController@storeMedia')->name('sliders.storeMedia');
    Route::post('sliders/ckmedia', 'SliderController@storeCKEditorImages')->name('sliders.storeCKEditorImages');
    Route::resource('sliders','SliderController');

    //Popup
    Route::delete('popups/destroy', 'PopupController@massDestroy')->name('popups.massDestroy');
    Route::post('popups/media', 'PopupController@storeMedia')->name('popups.storeMedia');
    Route::post('popups/ckmedia', 'PopupController@storeCKEditorImages')->name('popups.storeCKEditorImages');
    Route::resource('popups','PopupController');

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

Route::get('/{category:slug}/{childCategory:slug?}/{childCategory2?}/{childCategory3?}', 'HomeController@category')->name('category');


