<?php

    // Roles
    Route::delete('roles/destroy', 'Authorization\RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'Authorization\RolesController');

