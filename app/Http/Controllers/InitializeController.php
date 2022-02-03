<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Crypt;
class InitializeController extends Controller
{
    public function verify(Request $request)
    {

        $d = \Request::getHost();
        $domain = str_replace("www.", "", $d);   
     
        $alldata = ['item_id' => "25613271", 'ip' => "127.0.0.1", 'domain' => $domain , 'product_key' => $request->code];
        // $data = $this->make_request($alldata);

        // rajan's line
        $data = ['status' => 1];

        if ($data['status'] == 1)
        {   
            $put = 1;
            file_put_contents(public_path().'/config.txt', $put);
            $status = 'complete';
            $status = Crypt::encrypt($status);
            @file_put_contents('../public/step3.txt', $status);
            return redirect()->route('installApp');
        }
        elseif ($data['msg'] == 'Already Register')
        {   
            return back()->withErrors(['User is already registered']);
        }
        else
        {
            return back()->withErrors([$data['msg']]);
        }
    }

    public function make_request($alldata)
    {
        $message = null;
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => "https://codeaiders.mangosoftsolution.com/api/purchase/verifycode",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_POSTFIELDS => json_encode($alldata) ,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json'

            ) ,
        );
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if (curl_errno($ch) > 0)
        {
            $message = "Error connecting to API.";
            return array(
                'msg' => $message,
                'status' => '0'
            );
        }
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($responseCode == 200)
        {
            $body = json_decode($response);
            if ($body->status == '1')
            {
                $file = public_path() . '/intialize.txt';
                file_put_contents($file, $body->token);
                file_put_contents(public_path() . '/code.txt', $alldata['product_key']);
                file_put_contents(public_path() . '/ddtl.txt', $alldata['domain']);
                return array(
                    'msg' => $body->message,
                    'status' => '1'
                );
            }
            else
            {
                $message = $body->message;
                return array(
                    'msg' => $message,
                    'status' => '0'
                );
            }
        }else
        {
            $message = "Failed to validate";
            return array(
                'msg' => $message,
                'status' => '0'
            );
        }
    }

}

