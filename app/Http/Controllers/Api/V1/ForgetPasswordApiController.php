<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Authorization\User\User;
use Auth;
use DB;
use Mail;
use Illuminate\Support\Str;

class ForgetPasswordApiController extends Controller
{
    public function forget(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $email = $request->email;
        if(User::where('email',$email)->doesntExist())
        {
            return response(['message'=>'User not found']);
        }
        
        try{

            $token = Str::random(10);
    
            DB::table('password_resets')->insert([
                'email'=> $email,
                'token' => $token,
            ]);
    
            Mail::send('mails.forget', ['token'=>$token], function($message) use ($email) {
                $message->to($email);
                $message->subject('reset your password');
             });

            return response(['message'=>'check your email']);
        }
        catch(\Exception $exception){
            return response(['message'=>$exception->getMessage()],400);
        }

    }
}
