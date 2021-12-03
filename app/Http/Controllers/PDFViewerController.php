<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PDFViewerController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $decrypted = Crypt::decrypt($request->query('b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'));
        } catch (DecryptException $e) {

        }
        $key = Str::random(32);
        $newEncrypter = new \Illuminate\Encryption\Encrypter( $key, Config::get( 'app.cipher' ) );
        // $encrypted = $newEncrypter->encrypt( 'testing' );

        $file = Storage::disk('local')->get(str_replace('storage','public',$decrypted));
        // $file = Storage::disk('local')->get(str_replace('storage','public',$request->query('file')));
        // dd($newEncrypter->encrypt(base64_encode($file)));
        $encrypted = $newEncrypter->encrypt(base64_encode($file));
        // $encrypted = base64_encode($file);
        $test = base64_encode('testing');
        // $encrypted = $newEncrypter->encrypt($test);
        $key = base64_encode($key);
        return view('viewer',compact('key','encrypted','test'));
    }
}
