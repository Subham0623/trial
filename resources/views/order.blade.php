@extends('layouts.website')
  
@section('content')
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Date</th>
            <!-- <th style="width:22%" class="text-center">Subtotal</th> -->
            <!-- <th style="width:10%"></th> -->
        </tr>
    </thead>
    
    
    
    @if(auth::user()!= null)
    
        @php 
            $total = 0;
            $user = auth()->user();
            
            
            
        @endphp
        
        <tbody>
        
        @foreach($user->orders as $order)
      
       @foreach($order->products as $product)
        
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
                    <td data-th="Date">{{ $order->created_at->format('m/d/Y') }}</td>

                    <!-- <td class="actions" data-th="">
                    <input type="hidden" class = "product_id" value="{{$product->id}}">
                        <button class="btn btn-danger btn-sm remove-from-wishlist-btn">Remove</button></br>
                        <button class="btn btn-primary btn-sm move-to-cart-btn">Add to Cart</button>
                    </td> -->
                </tr>
                @endforeach
                @endforeach
                
    </tbody>
    
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
  
