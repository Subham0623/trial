<?php

    // Users
    Route::delete('users/destroy', 'Authorization\UsersController@massDestroy')->name('users.massDestroy');
    // Route::get('users/manage-access/{user}', 'UsersController@manageAccessToBook')->name('users.manageAccessToBook');
    // Route::post('users/add-more-subjects/{user}', 'UsersController@addMoreSubject')->name('users.addMoreSubject');
    Route::resource('users', 'Authorization\UsersController');
    // Route::get('users/can-read-book/{user}/{level}/{tag}/{flag}', 'UsersController@canReadBook')->name('users.can-read-book');
