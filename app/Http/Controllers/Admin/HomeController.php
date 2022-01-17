<?php

namespace App\Http\Controllers\Admin;
use Auth;

class HomeController
{
    public function index()
    {
        return view('home');
    }

    public function get_notifications(){
        return Auth::user()->unreadNotifications;
    }

    public function show_notifications($id){
        $notification = Auth::user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            return redirect($notification->data['url']);
        }
    }

    public function read_all_notifications()
    {
        Auth::user()->unreadNotifications()->get()->map(function($n) {
            $n->markAsRead();
        });
        return back();
    }
}
