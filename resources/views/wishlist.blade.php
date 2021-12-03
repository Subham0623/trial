@extends('layouts.website')
  
@section('content')
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <!-- <th style="width:8%">Quantity</th> -->
            <!-- <th style="width:22%" class="text-center">Subtotal</th> -->
            <th style="width:10%"></th>
        </tr>
    </thead>
    
    
    
    @if(auth::user()!= null)
    
        @php 
            $total = 0;
            $user_id = auth()->user()->id;
            $userWishlist = App\Wishlist::where('user_id',$user_id)->with('products')->first();
            
            
        @endphp
        @if(!isset($userWishlist))
        <tbody>
            There is no product in your wishlist.
        </tbody>
       @else
        <tbody>
        
        @foreach($userWishlist->products as $product)
       
       
        
        <tr data-id="{{ $product->id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $product->photo->geturl() }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $product->name }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $product->price }}</td>
                    <td class="actions" data-th="">
                    <input type="hidden" class = "product_id" value="{{$product->id}}">
                        <button class="btn btn-danger btn-sm remove-from-wishlist-btn">Remove</button></br>
                        <button class="btn btn-primary btn-sm move-to-cart-btn">Add to Cart</button>
                    </td>
                </tr>
                @endforeach
                
    </tbody>
    @endif
    @endif
    
    <tfoot>
        
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <!-- <button class="btn btn-success">Checkout</button> -->
            </td>
        </tr>
    </tfoot>
</table>
@endsection
  
@section('scripts')
<script type="text/javascript">
  
    
    
  
    
        $('.remove-from-wishlist-btn').click(function(e){
                        e.preventDefault();
                        console.log('here');
                        $.ajaxSetup({
                            headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                     }
                        });

                        var product_id = $('.product_id').val();
                       console.log(product_id)

                    $.ajax({
                        method:'DELETE',
                        url:'/user/remove-from-wishlist',
                        data: {
	                        product_id: product_id,
	                        },
                            success: function (response) {
                                 window.location.reload();
                }
                    });
    });

    $(document).ready(function(){
                    $('.move-to-cart-btn').click(function(e){
                        e.preventDefault();
                        console.log('here');
                        $.ajaxSetup({
                            headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                     }
                        });

                        var product_id = $('.product_id').val();
                       console.log(product_id)

                    $.ajax({
                        method:'DELETE',
                        url:'/user/move-to-cart',
                        data: {
	                        product_id: product_id,
	                        },
                            success: function (response) {
                                 window.location.href = "/cart";
                }
                        
                    });
                    });
                });
  
</script>
@endsection