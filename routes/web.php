<?php



Route::get('/', 'HomeController@index')->name('index');
Route::get('/viewer', 'PDFViewerController@index')->name('viewer')->middleware('signed');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/contact', function () {
    return view('site.contact');
})->name('contact');
Route::get('cart', 'CartController@cart')->name('cart');
Route::get('add-to-cart/{id}', 'CartController@addToCart')->name('add.to.cart');
Route::patch('update-cart', 'CartController@update')->name('update.cart');
Route::delete('remove-from-cart', 'CartController@remove')->name('remove.from.cart');

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

Route::get('levels/get-specific-tags', 'HomeController@getSpecificTags')->name('levels.getSpecificTags');

Auth::routes(['verify'=>true]);

// User
Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'namespace' => 'User',
    'middleware' => ['auth','verified']
], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/review/{product}','ReviewController@store')->name('review');
    Route::post('/rating/{product}','ReviewController@rating')->name('rating');
    Route::get('/wishlist','WishlistController@index')->name('wishlist');
    Route::post('/add-to-wishlist','WishlistController@store')->name('add-to-wishlist');
    Route::delete('/remove-from-wishlist','WishlistController@remove')->name('remove-from-wishlist');
    Route::delete('/move-to-cart','WishlistController@moveToCart')->name('move-to-cart');
    Route::get('/checkout','OrderController@checkout')->name('checkout');
    Route::get('/orders','OrderController@index')->name('orders');
    Route::post('/order-store','OrderController@store')->name('order-store');


});

// Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
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

    // Product Tags
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Products
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::get('products/check-slug', 'ProductController@checkSlug')->name('products.checkSlug');
    // Route::post('products/image_upload', 'ProductController@upload')->name('upload');
    Route::resource('products', 'ProductController');

    //Authors
    Route::delete('authors/destroy', 'AuthorController@massDestroy')->name('authors.massDestroy');
    Route::post('authors/media', 'AuthorController@storeMedia')->name('authors.storeMedia');
    Route::post('authors/ckmedia', 'AuthorController@storeCKEditorImages')->name('authors.storeCKEditorImages');
    Route::get('authors/check-slug', 'AuthorController@checkSlug')->name('authors.checkSlug');
    Route::resource('authors','AuthorController');
    // Books
    Route::delete('books/destroy', 'BookController@massDestroy')->name('books.massDestroy');
    Route::post('books/media', 'BookController@storeMedia')->name('books.storeMedia');
    Route::post('books/ckmedia', 'BookController@storeCKEditorImages')->name('books.storeCKEditorImages');
    Route::get('books/check-slug', 'BookController@checkSlug')->name('books.checkSlug');
    Route::resource('books', 'BookController');

    // Levels
    Route::delete('levels/destroy', 'LevelController@massDestroy')->name('levels.massDestroy');
    Route::get('levels/get-specific-tags', 'LevelController@getSpecificTags')->name('levels.getSpecificTags');
    Route::resource('levels', 'LevelController');

    //Reviews
    Route::delete('reviews/destroy', 'ReviewController@massDestroy')->name('reviews.massDestroy');
    Route::resource('reviews','ReviewController');
    Route::get('reviews/{review}/approve', 'ReviewController@approve')->name('reviews.approve');
    Route::get('reviews/{review}/reject', 'ReviewController@reject')->name('reviews.reject');

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

    //License
    Route::delete('licenses/destroy', 'LicenseController@massDestroy')->name('licenses.massDestroy');
    Route::get('licenses/check-slug', 'LicenseController@checkSlug')->name('licenses.checkSlug');
    Route::resource('licenses', 'LicenseController');

    //Support
    Route::delete('supports/destroy', 'SupportController@massDestroy')->name('supports.massDestroy');
    Route::get('supports/check-slug', 'SupportController@checkSlug')->name('supports.checkSlug');
    Route::resource('supports', 'SupportController');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});

Route::get('/{product}/{productSlug}/{category}', 'HomeController@product')->name('product');
Route::get('/{category:slug}/{childCategory:slug?}/{childCategory2?}/{childCategory3?}', 'HomeController@category')->name('category');


// Route::get('/abc','ReviewController@r');

