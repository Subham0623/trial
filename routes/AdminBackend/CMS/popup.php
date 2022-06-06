<?php

    //Popup
    Route::delete('popups/destroy', 'PopupController@massDestroy')->name('popups.massDestroy');
    Route::post('popups/media', 'PopupController@storeMedia')->name('popups.storeMedia');
    Route::post('popups/ckmedia', 'PopupController@storeCKEditorImages')->name('popups.storeCKEditorImages');
    Route::resource('popups','PopupController');
