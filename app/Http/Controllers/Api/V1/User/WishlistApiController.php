<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Wishlist;
use App\User;
use App\Cart;
use App\CartProduct;
use App\Product;
use App\Http\Resources\WishlistResource;

class WishlistApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(wishlist::all());
        return WishlistResource::collection(Wishlist::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(isset(auth()->user()->id)){
            $user_id = auth()->user()->id;
            $userWishlist = Wishlist::where('user_id',$user_id)->first();
                // dd($userWishlist);
                
            
            if(!isset($userWishlist)){
            
            $userWishlist = Wishlist::create(
                        ['user_id'=> $user_id]
            );
                     
                    $userWishlist->products()->attach($request->product_id,
                    [
                            'wishlist_id'=> $userWishlist->id,
                            'product_id'=> $request->product_id,
                    ]);
            }
            else{
                // dd($userWishlist);
                $s = $userWishlist->products()->find($request->product_id);
                // dd($s);
                if(!isset($s)){
                    $userWishlist->products()->attach($request->product_id,
                    [
                            'wishlist_id'=> $userWishlist->id,
                            'product_id'=> $request->product_id,
                    ]);
                }
                else{
                    $userWishlist = Wishlist::where('user_id',$user_id)->first();
                    $s = $userWishlist->products()->detach($request->product_id);
                }
            }
             

            
        }
        // return response()->json(['message'=>'product added']);
        
    }

    public function moveToCart(Request $request)
    {
        $user_id = auth::user()->id;
        $userCart = Cart::where('user_id',$user_id)->first();
        $c = $userCart->products()->pluck('id','id');

        if($c->contains($request->product_id)){
          $s =  CartProduct::where('product_id',$request->product_id)->where('cart_id',$userCart->id)->first();
        //   dd($s->quantity);
          $status=$s->status;
          $newQuantity= $s->quantity+1;
        //   dd($newQuantity);
          $userCart->products()->detach($request->product_id);
          $userCart->products()->attach($request->product_id,
          [
            'cart_id'=> $userCart->id,
            'product_id'=> $request->product_id,
            'status'=>$status,
            'quantity'=>$newQuantity,
          ]);
        }else{
            $userCart->products()->attach($request->product_id,
            [
                    'cart_id'=> $userCart->id,
                    'product_id'=> $request->product_id,
                    'status'=>0,
                    'quantity'=>1,
            ]);

        }
        $userWishlist = Wishlist::where('user_id',$user_id)->first();
            $s = $userWishlist->products()->detach($request->product_id);
        
        return response(['message'=>'moved to cart']);
    }

    public function remove(Request $request)
    {
            $user_id = auth()->user()->id;
            $userWishlist = Wishlist::where('user_id',$user_id)->first();
            $s = $userWishlist->products()->detach($request->product_id);
            return response(['message'=>'removed from wishlist']);
    }
    
}
