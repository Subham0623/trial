<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Organization;
use App\Province;
use App\District;
use Illuminate\Http\Request;


class HomeController
{
    public function index()
    {
        // dd('hello');
        $province_id = 1;
        $district_id = 1;
        $provinces = Province::all();
        $districts = District::where('province_id',$province_id);
        $organizations = Organization::all()->count();
        $org = Organization::where('district_id',$district_id)->get();
        return view('home',compact('organizations','provinces'));
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

    public function list(Request $request)
    {
        $province = Province::findOrFail($request->province);
        
        $organizations = Organization::where('province_id',$request->province)->with('province','district')->get();
        
        return $organizations;
        
    }
}
