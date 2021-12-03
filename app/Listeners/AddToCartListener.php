<?php

namespace App\Listeners;

use lluminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Cart;
use App\CartProduct;



class AddToCartListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  IlluminateAuthEventsLogin  $event
     * @return void
     */
    public function handle($event)
    {
        // dd($event->user);
        $cart = session()->get('cart');
        // dd($cart);
        if(isset($cart)) {
            $user_id = $event->user->id;
            $userCart = Cart::where('user_id',$user_id)->first();
            if(!isset($userCart)){
                
                $userCart = Cart::create(
                            ['user_id'=> $user_id]
                );
                        foreach($cart as $cart_item){
                        $userCart->products()->attach($cart_item['cart_product_id'],
                        [
                                'cart_id'=> $userCart->id,
                                'product_id'=> $cart_item['cart_product_id'],
                                'status'=>0,
                                'quantity'=>1,
                        ]); 
                    } 
                    }
            else{
                $c = $userCart->products()->pluck('id','id');
                // dd($c);
                foreach($cart as $cart_item){
                    // dd($c->contains($cart_item['cart_product_id']));
                if($c->contains($cart_item['cart_product_id'])){
                    $s =  CartProduct::where('product_id',$cart_item['cart_product_id'])->where('cart_id',$userCart->id)->first();
                    // dd($s);
                    $status=$s->status;
                    $newQuantity= $s->quantity+1;
                    $userCart->products()->detach($cart_item['cart_product_id']);
                    $userCart->products()->attach($cart_item['cart_product_id'],
                    [
                        'cart_id'=> $userCart->id,
                        'product_id'=> $cart_item['cart_product_id'],
                        'status'=>$status,
                        'quantity'=>$newQuantity,
                    ]);
                }
                else{
                    $userCart->products()->attach($cart_item['cart_product_id'],
                    [
                            'cart_id'=> $userCart->id,
                            'product_id'=> $cart_item['cart_product_id'],
                            'status'=>0,
                            'quantity'=>1,
                    ]);
                    }
                }
                }
        }
       
        
    }
}
