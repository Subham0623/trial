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
    // Route::get('/wishlist','WishlistApiController@index')->name('wishlist');
    // Route::post('/add-to-wishlist','WishlistApiController@store');
    // Route::delete('/remove-from-wishlist','WishlistApiController@remove');
    // Route::delete('/move-to-cart','WishlistApiController@moveToCart');

    // Route::get('/checkout','OrderApiController@checkout');
    // Route::get('/orders','OrderApiController@index');
    // Route::post('/order-store','OrderApiController@store');
});

    // Route::middleware('auth:api')->get('/cart','Api\V1\CartApiController@cart');
    // Route::middleware('auth:api')->get('/add-to-cart/{id}','Api\V1\CartApiController@addToCart');
    // Route::middleware('auth:api')->patch('update-cart', 'Api\V1\CartApiController@update');
    // Route::middleware('auth:api')->delete('remove-from-cart', 'Api\V1\CartApiController@remove');



Route::get('/', 'Api\V1\HomeApiController@index')->name('index');
Route::get('/province','Api\V1\HomeApiController@province')->name('province');

// Route::get('/{product}/{productSlug}/{category}', 'HomeApiController@product')->name('product');
// Route::get('/{category:slug}/{childCategory:slug?}/{childCategory2?}/{childCategory3?}', 'HomeApiController@category')->name('category');

// Route::get('employees','HomeApiController@hello');




// Route::get('/hello', 'Api\V1\LoginApiController@hello');


Route::post('/login','Api\V1\LoginApiController@login');
Route::post('/reset','Api\V1\ResetPasswordApiController@reset');
Route::post('/password/forget','Api\V1\ForgetPasswordApiController@forget');
Route::middleware('auth:api')->post('/logout','Api\V1\LoginApiController@logout');


Route::post('/register','Api\V1\RegisterApiController@register');
Route::post('/password/reset','Api\V1\ResetPasswordController@reset');
// Route::post('/password/email','Api\V1\ForgetPasswordController@sendResetLinkResponse');
// Route::get('/usercart', 'CartApiController@usercart');