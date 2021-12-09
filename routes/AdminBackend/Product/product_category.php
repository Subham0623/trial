<?php

    // Product Categories
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::get('product-categories/check-slug', 'ProductCategoryController@checkSlug')->name('product-categories.checkSlug');
    Route::get('product-categories/list', 'ProductCategoryController@sortList')->name('product-categories.list');
    Route::post('product-categories/save-nested-categories', 'ProductCategoryController@saveNestedCategories')->name('product-categories.save-nested-categories');
    Route::resource('product-categories', 'ProductCategoryController');
 