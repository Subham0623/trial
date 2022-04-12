<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Authorization\User\User;
use DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordApiController extends Controller
{
    public function reset(Request $request)
    {
        // dd('here');
        $request->validate([
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'token' => 'required',
        ]);

        $token = $request->token;
        if(!$passwordResets = DB::table('password_resets')->where('token',$token)->first())
        {
            return response([
                'message'=>'Invalid token'
            ],400);
        }

        if(!$user = User::where('email',$passwordResets->email)->first())
        {
            return response([
                'message'=>'User not found'
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response([
            'message'=>'password changed successfully'
        ]);
    }
}
