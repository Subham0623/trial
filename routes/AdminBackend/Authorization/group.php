<?php

    // Groups
    Route::delete('groups/destroy', 'GroupsController@massDestroy')->name('groups.massDestroy');
    Route::resource('groups', 'GroupsController');
