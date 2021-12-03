<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Product;
use App\Review;
use App\Rating;
use Gate;

use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{

   

    public function store(Request $request, Product $product)
    {
        $this->validate($request,[
            'review' => 'required',
            'type' => 'required',
        ]);
        
         $review = new Review;
         $review->review = $request->review;
         $review->type = $request->type;
         $review->user_id = Auth::id();
         $review->product_id = $product->id;
         $review->status = 0;
         $review->save();
        return redirect()->back()->with('message','Your review has been submitted for approvement.');
    }

    public function rating(Request $request, Product $product)
    {        
        $rating = Rating::updateOrCreate(
            ['user_id' =>  Auth::id() , 'product_id'=>$product->id],
            ['rate' => request('name')]
        );
        
        // find sum of rating and total no. of raters
        $total_rating = \App\Rating::selectRaw("sum(rate) as sum, count(*) as total")
        ->where('product_id',$product->id)
        ->first();
        
        // calculate average
        $average_rating = round($total_rating->sum  / $total_rating->total);
        // dd($average_rating);
        
        // update average rating of product
        $product->average_rating = $average_rating;
        $product->update();

        return $rating;
       
    }

    
}