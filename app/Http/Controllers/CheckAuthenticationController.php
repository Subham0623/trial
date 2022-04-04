<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthenticationController extends Controller
{
    //
    public function checkToken(Request $request) {
        
        $user = $request->user();
        
        if($user) {
            Auth::guard('web')->login($user);
            if ($user->is_admin) {
                return redirect()->route('admin.home');
            }
            return redirect('http://mangosoftsolution.com:3930/');
        }

        // return $request->header('authorization');
    }

}
