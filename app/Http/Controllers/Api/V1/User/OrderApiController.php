<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Order;
use App\Cart;
use App\CartProduct;
use Illuminate\Support\Facades\Auth;

class OrderApiController extends Controller
{
    public function index(){
        $orders = Auth::user()->orders;
        return $orders;
    }

    public function store(Request $request)
    {
        // dd(auth::user()->cart->products);

        $usercart = auth::user()->cart;
        
        if(isset($usercart->products)){
        $order = Order::create(
            [
                'user_id'=> auth::user()->id,
                'paymentmode' => $request->paymentmode,
                'total' => $request->total,
            ]
        );
        // dd($order);
        $userorder = auth::user()->orders()->find($order->id);
        // dd($userorder);
        // dd($usercart);
        // dd($cartproducts);
        $cartproducts = $usercart->products;
        foreach($cartproducts as $product){
            // dd($product);
            $s = $usercart->products()->detach($product->id);
            $orderproducts = $userorder->products()->attach($product->id,
          [
            'order_id'=> $userorder->id,
            'product_id'=> $product->id,
            // 'quantity'=>1,
          ]);
        // dd($cartproducts);

            

        }
    }
    
       return response(['message'=>'order placed']);
    }

    public function checkout()
    {
        return response(Auth::user());
    }

    
}
