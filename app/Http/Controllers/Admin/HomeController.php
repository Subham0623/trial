<?php

namespace App\Http\Controllers\Admin;
use Auth;
use App\Organization;
use App\Province;
use App\District;
use App\Models\Authorization\User\User;
use Illuminate\Http\Request;


class HomeController
{
    public function index()
    {
        // dd('hello');
        $province_id = 1;
        $district_id = 1;
        $provinces = Province::all();
        $districts = District::all();
        // $districts = District::where('province_id',$province_id);
        $organizations = Organization::all()->count();

        $auditors = User::wherehas('roles',function($query){
            $query->where('title','Auditor');
        })->count();

        $finalVerifiers = User::wherehas('roles',function($query){
            $query->where('title','Final Verifier');
        })->count();

        $org = Organization::where('district_id',$district_id)->get();
        return view('home',compact('organizations','provinces','districts','auditors','finalVerifiers'));
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

    public function district(Request $request)
    {
        $district = District::findOrFail($request->district);
        
        $organizations = Organization::where('district_id',$request->district)->with('district','province')->get();
        
        return $organizations;
        
    }

    public function provinceDistrict($id)
    {
        $province = Province::findOrFail($id);
        $districts = $province->districts()->pluck('name','id');
        return $districts;

    }

    public function search(Request $request)
    {
        // dd($request->all());

        if((isset($request->province)) && (isset($request->district)))
        {
            $organizations = Organization::where('province_id',$request->province)->where('district_id',$request->district)->get();
            return $organizations;
        }
        elseif((isset($request->province)) && $request->district == NULL)
        {
            $organizations = Organization::where('province_id',$request->province)->get();
            return $organizations;
        }
        else
        {
            $organizations = Organization::where('district_id',$request->district)->get();
            return $organizations;
        }
       
    }
}
