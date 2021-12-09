<?php

    Route::get('/', 'HomeController@index')->name('index');
    
    // product search
    Route::get('/search', 'HomeController@search')->name('search');

    // contact page
    Route::get('/contact', function () {
        return view('site.contact');
    })->name('contact');

    // redirecting to admin or user portal after logging in
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
