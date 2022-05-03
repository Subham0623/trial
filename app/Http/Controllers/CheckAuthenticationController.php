<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Authorization\User\User;

class CheckAuthenticationController extends Controller
{
    //
    public function checkToken(Request $request) {
        
        // $user = $request->user();
        // $user = auth('web')->user();
        $access_token = $request->token;
        // $auth_header = explode(' ', $access_token);
        // $token = $auth_header[1];
        $token_parts = explode('.', $access_token);
        $token_header = $token_parts[1];
        $token_header_json = base64_decode($token_header);
        $token_header_array = json_decode($token_header_json, true);
        $token_id = $token_header_array['jti'];

        $user_with_token = \DB::table('oauth_access_tokens')->where('id', $token_id)->first();
        $user = User::findOrFail($user_with_token->user_id);
        
        if($user) {
            Auth::guard('web')->login($user);
            if ($user->is_admin) {
                return redirect()->route('admin.home');
            }
            return redirect(config('panel.homepage'));
        }

        // return $request->header('authorization');
    }

}
