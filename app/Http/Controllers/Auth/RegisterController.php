<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // public function redirectPath()
    // {
    //     if (auth()->user()->is_admin) {
    //         return route('admin.home');
    //     }

    //     return route('user.home');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        // dd($data);
        if($data['role'] == 3){
        return Validator::make($data, [   
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
            // 'teaching_level' => ['required'],
            // 'subject-0' => ['required'],
            'institute' => ['required'],
            // 'institute_contact' => ['required'],
            // 'institute_province' => ['required'],
            // 'institute_district' => ['required'],
            // 'institute_muncipality' => ['required'],
            // 'institute_ward' => ['required'],
            // 'institute_street_name' => ['required'],
            // 'institute_principal' => ['required'], 
            'card' => ['required'],
        ]);
        
        }
        else{
            return Validator::make($data, [   
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required'],
                   
            ]);
        }
        // $validator->sometimes(['institute_district', 'teaching_level'], 'required', function ($data) {
        //     return $data['role'] == 3;
        // });
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        
        $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

        $user->roles()->sync($data['role']);

        // if($data['role'] == 3) {
        //     $levels = collect($data['teaching_level']);
        //     $levels->map(function($level,$i) use ($user, $data) {
        //         $subjects = collect($data['subject-'.$i]);
        //         $subjects->map(function($subject) use ($user, $level) {
        //             $user->levels()->attach([ $level => ['product_tag_id' => $subject] ]);
        //         });
        //     });
        // }
        
        $card = null;
        if(request()->hasFile('card')) {
            $card = request()->file('card')->getClientOriginalName();
            request()->file('card')->storeAs('public/cards', $user->id.'/'.$card); 
        }

        $user->user_detail()->create([  
            'contact' => $data['contact'],
            'institute' => $data['institute'],
            'institute_contact' => $data['institute_contact'],
            'institute_province' => $data['institute_province'],
            'institute_district' => $data['institute_district'],
            'institute_muncipality' => $data['institute_muncipality'],
            'institute_ward' => $data['institute_ward'],
            'institute_street_name' => $data['institute_street_name'],
            'institute_principal' => $data['institute_principal'],
            'card' => $card,
            'notes' => $data['notes'],
        ]);


        // email data
        // $email_data = array(
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        // );
        
        // send email with the template
        // Mail::send('welcome_email', $email_data, function ($message) use ($email_data) {
        //     $message->to($email_data['email'], $email_data['name'])
        //         ->subject('Welcome to Asmita Publication');
        // });
        return $user;
        
    }
}
