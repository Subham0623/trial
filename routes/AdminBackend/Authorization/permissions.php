<?php

    // Permissions
    Route::delete('permissions/destroy', 'Authorization\PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'Authorization\PermissionsController');
