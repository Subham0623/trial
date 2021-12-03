<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Cart;
use App\Product;
use App\Cartproduct;

class CartApiController extends Controller
{
    public function cart(){
        return response(Auth::user());
    }

    public function addToCart($id)
    {
        // dd(Auth::user()->token());
        $product = Product::findOrFail($id);
        //   dd($product->photo);
        $cart = session()->get('cart', []);
        
        // dd($user = auth()->user()->id);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->photo->geturl(),
                "cart_product_id" =>$product->id
            ];
        }   
        // dd($product->photo->geturl());
        //   dd($cart[$id]['quantity']);
        // dd($cart);
        if(isset(auth()->user()->id)){
            $user_id = auth()->user()->id;
            $userCart = Cart::where('user_id',$user_id)->first();
            // dd($userCart->products);
            // dd($userCart);
            
            if(!isset($userCart)){
            // dd('here');
    //    dd( $user_id_cart = auth()->user()->cart()->id);

            // dd( $cart_id = DB::table('carts')->orderby('id','desc')->get()->first());
           
            // $userCart = DB::table('carts')->insert(
            //         ['user_id'=> $user_id]
            //         );
            $userCart = Cart::create(
                        ['user_id'=> $user_id]
            );
                    // dd($cart);  
                    $userCart->products()->attach($id,
                    [
                            'cart_id'=> $userCart->id,
                            'product_id'=> $product->id,
                            'status'=>0,
                            'quantity'=>1,
                    ]);

                
                    
                    
                }
        //    $cart_id = DB::table('carts')->orderby('id','desc')->get()->first();
        // $cart_id = $user->cart->id;
        // dd($cart);
        else{
    // first ma yo tala ko lae usercart maa vako sabai item euta array ma halae
        $c = $userCart->products()->pluck('id','id');
        // ani tyo array ma tala mathi ko product xa ki xaina check garyo contains lae
        // tes paxi simple xa timi lae laga ko logic naiho else ko taw
        if($c->contains($product->id)){
          $s =  CartProduct::where('product_id',$product->id)->where('cart_id',$userCart->id)->first();
        //   dd($s);
          $status=$s->status;
          $newQuantity= $s->quantity+1;
          $userCart->products()->detach($product->id);
          $userCart->products()->attach($id,
          [
            'cart_id'=> $userCart->id,
            'product_id'=> $product->id,
            'status'=>$status,
            'quantity'=>$newQuantity,
          ]);
        }else{
            $userCart->products()->attach($id,
            [
                    'cart_id'=> $userCart->id,
                    'product_id'=> $product->id,
                    'status'=>0,
                    'quantity'=>1,
            ]);

        }
        // dd($cart);
        
            // foreach($cart as $key => $cart_item){
            //     // dd($key);
            //     foreach($c as $s){
            //         // dd($c);
            //         // dd('here');
            //         // dd($id == $s->id);
            //         // dd($s->pivot->quantity);
            //         if($id == $s->id){
            //             // dd('its here');
            //             // dd($s);
            //             // DB::table('cart_product')->update(
            //             //     ['quantity' => $s->pivot->quantity + $cart_item['quantity']]
            //             // );
            //             $s->pivot->quantity = $s->pivot->quantity+$cart_item['quantity'];
            //             // dd($s->pivot->quantity);
            //             $s->pivot->update();
            //             // dd($s->pivot->quantity);
            //             // dd($cart_item);
            //         }
            //         else{
                        
            //             $a = Cart::where('id',$userCart)
            //             ->whereHas('products',function($q){
            //             $q->where('product_id',$id);
            //  })->get();
            // dd($a);
            //             // dd('here');
            //             $userCart->products()->attach($id,
            //             [
            //                     'cart_id'=> $userCart->id,
            //                     'product_id'=> $product->id,
            //                     'status'=>0,
            //                     'quantity'=>1,
            //             ]);
            //         }   
            //             // dd($userCart->products()->get());
            //     }
            // }
                
            
            // dd('not here');
                    // dd($cart);
               
                
           
         
            
        }
    }
        else{
            // dd($cart);
        session()->put('cart', $cart);
        // event(new UserLoggedInEvent($cart));
        
        }
        return response(['success'=> 'Product added to cart successfully!']);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        // dd($request->all());
        if($request->id && $request->quantity){
            $this->validate($request,[
                'quantity'=>'required|integer|gt:0',
            ]);
            if(auth::user()==null){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    
            
        else{
            $user_id = auth()->user()->id;
            $userCart = Cart::where('user_id',$user_id)->first();
            // $s = $userCart->products()->attach($request->id, ['quantity' => $request->quantity]);
            // $s =  CartProduct::where('product_id',$request->id)->where('cart_id',$userCart->id)->first();
            // dd($userCart->products()->updateOrCreate([
            //     'product_id' => $request->id
            // ]));
            
            // dd($s->pivot->quantity);
            // $userCart->products()->pivot->updateOrCreate([
            //     'product_id' => $request->id
            // ],
            // [
            //     'quantity' => $request->quantity
            // ]);
            
            $s = $userCart->products()->find($request->id);
            $s->pivot->quantity = $request->quantity;
            $s->pivot->save();
            
        }
    }
        return response(['message'=>'cart updated successfully!']);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            if(auth::user()==null){
                $cart = session()->get('cart');
                if(isset($cart[$request->id])) {
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);
                }
                session()->flash('success', 'Product removed successfully');
            }
        
        else{

            $user_id = auth()->user()->id;
            $userCart = Cart::where('user_id',$user_id)->first();
            $s = $userCart->products()->detach($request->id);

            
            
            }
        }
        return response(['message'=>'product removed from cart']);
    }
}
