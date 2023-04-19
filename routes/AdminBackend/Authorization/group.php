<?php

    // Groups
    Route::delete('groups/destroy', 'Authorization\GroupsController@massDestroy')->name('groups.massDestroy');
    Route::resource('groups', 'Authorization\GroupsController');
