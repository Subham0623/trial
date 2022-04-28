<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Authorization\User\User;
use Auth;

class LoginApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        // dd('here');
        $login = $request->validate([
            'username' => 'required|string',
            'password'  => 'required|string',
        ]);
        
        $user = User::where('email',$request->username)->orwhere('token',$request->username)->first();
        
        if(isset($user))
        {

            if($user->status == 1)
            {
                if(filter_var($request->username, FILTER_VALIDATE_EMAIL))    
                {
                    if(!Auth::attempt(['email' => $request->username, 'password'=>$request->password])){
                        return response(['message'=>'invalid login credentials']);
                    }
                    else
                    {
                        $accessToken = Auth::user()->createToken('authToken')->accessToken;
                        return response(['user' => Auth::user()->load('roles'), 'access_token' => $accessToken]);
                    } 
                   
                }
                else
                {
                    if(!Auth::attempt(['token' => $request->username, 'password'=>$request->password])){
                        return response(['message'=>'invalid login credentials']);
                    }
                    else
                    {
                        $accessToken = Auth::user()->createToken('authToken')->accessToken;
                        return response(['user' => Auth::user()->load('roles'), 'access_token' => $accessToken]);
                    }
                }
            }
            else
            {
                return response(['status'=> '401',
                    'message'=> 'User is deactivated'
                ]);
            }
        }
        else
        {
            return response(['status'=> '401',
                'message'=> 'invalid login credentials'
            ]);
        }
    }
    
    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
