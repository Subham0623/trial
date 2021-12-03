<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;
use App\Order;
use App\Cart;
use App\CartProduct;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order');
        
    }

    public function checkout()
    {
        return view('checkout');
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
        // dd(auth::user()->cart->products);
        // dd($request->all());
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
        $cartproducts = $usercart->products;
        // dd($cartproducts);
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
    
       return redirect('/');
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
