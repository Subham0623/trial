<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Cart;


class CartApiController extends Controller
{
    public function usercart(){
        return response(Auth::user());
    }
}
