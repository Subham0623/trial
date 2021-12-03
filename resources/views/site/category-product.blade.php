@extends('layouts.website')

@section('styles')
<!-- <link rel="stylesheet" href="{{ asset('site/css/commonPage.css')}}" /> -->
@endsection

@section('content')
    <main>
      <!-- <section class="section section--breadcrum">
        <p class="short-breadcrum">
          <a href="#">Home</a>/ <a href="">Shop</a> / <a href=""> School</a>
        </p>
      </section> -->
      <div class="main--padding">
        <section class="section section__common-section">
          <div class="product__shortlist">
            <h3 class="product-heading">{{($featured_products->count())?'Featured Products':'Latest Products'}}</h3>
            <!-- shortlist container -->
            <ul class="products__shortlist-container">
            @if($featured_products->count())
                @foreach($featured_products as $product)
                <li class="product">
                    <a  class="product-image" href="{{ route('product', [
                                                    $product,
                                                    $product->slug,
                                                    $product->categories->first()->slug ?? '',
                                                    ]) }}"
                    >
                    <img src="{{ $product->photo->url ?? 'http://placehold.it/525x570' }}" alt="{{$product->name}}" />
                    </a>
                    <div class="product-body">
                        <a class="product-body--title" href="{{ route('product', [
                                                    $product,
                                                    $product->slug,
                                                    $product->categories->first()->slug ?? '',
                                                    ]) }}"
                        >{{$product->name}}</a>
                    <div class="top-picks__rating">
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 1)?'#5f5f62':'#b8b9b9'}}"></i>
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 2)?'#5f5f62':'#b8b9b9'}}"></i>
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 3)?'#5f5f62':'#b8b9b9'}}"></i>
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 4)?'#5f5f62':'#b8b9b9'}}"></i>
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 5)?'#5f5f62':'#b8b9b9'}}"></i>
                    </div>
                    </div>
                </li>
                @endforeach
            @elseif($latest_products->count())
                @foreach($latest_products as $product)
                <li class="product">
                    <a  class="product-image" href="{{ route('product', [
                                                    $product,
                                                    $product->slug,
                                                    $product->categories->first()->slug ?? '',
                                                    ]) }}"
                    >
                    <img src="{{ $product->photo->url ?? 'http://placehold.it/525x570' }}" alt="{{$product->name}}" />
                    </a>
                    <div class="product-body">
                        <a class="product-body--title" href="{{ route('product', [
                                                    $product,
                                                    $product->slug,
                                                    $product->categories->first()->slug ?? '',
                                                    ]) }}"
                        >{{$product->name}}</a>
                    <div class="top-picks__rating">
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 1)?'#5f5f62':'#b8b9b9'}}"></i>
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 2)?'#5f5f62':'#b8b9b9'}}"></i>
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 3)?'#5f5f62':'#b8b9b9'}}"></i>
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 4)?'#5f5f62':'#b8b9b9'}}"></i>
                      <i class="fas fa-star" style="color:{{($product->average_rating >= 5)?'#5f5f62':'#b8b9b9'}}"></i>
                    </div>
                    </div>
                </li>
                @endforeach
            @else
                <p>No products to feature.</p>
            @endif
            </ul>
          </div>
          <!-- product main page -->
          <div class="product__main-page">
            <div class="product__main-page-top">
              <!-- <form action="" class="sort__form">
                <div class="form__container">
                  <label for="sort">Sort By:</label>
                  <select name="" id="sort">
                    <option value="" selected>Default Sorting</option>
                    <option value="">Sort by price high to low</option>
                    <option value="">Default Sorting</option>
                  </select>
                </div>
              </form> -->
              <!-- <div class="wrap__content">
                <form action="" class="sort__form">
                  <div class="form__container">
                    <label for="sortPage">Show:</label>
                    <select name="" id="sortPage">
                      <option value="" selected>10</option>
                      <option value="">16</option>
                      <option value="">32</option>
                    </select>
                  </div>
                </form>
              </div> -->
            </div>
            <div class="product__main-page-main">
            @if($products->count())
                @foreach($products as $product)
                <div class="top-picks__card card__link">
                    <a href="{{ route('product', [
                                                    $product,
                                                    $product->slug,
                                                    $product->categories->first()->slug ?? '',
                                                    ]) }}">
                    <div class="top-picks__image">
                        <img src="{{ $product->photo->url ?? 'http://placehold.it/525x720' }}" alt="{{$product->name}}" />
                    </div>
                    <div class="top-picks__body">
                        <!-- <a class="top-picks__info"
                        >10 +2 Books, Eleven, latest releases, love books</a
                        > -->
                        <a class="top-picks__title" href="{{ route('product', [
                                                    $product,
                                                    $product->slug,
                                                    $product->categories->first()->slug ?? '',
                                                    ]) }}"
                        >{{$product->name}}</a>
                        <div class="top-picks__rating">
                          <i class="fas fa-star" style="color:{{($product->average_rating >= 1)?'#5f5f62':'#b8b9b9'}}"></i>
                          <i class="fas fa-star" style="color:{{($product->average_rating >= 2)?'#5f5f62':'#b8b9b9'}}"></i>
                          <i class="fas fa-star" style="color:{{($product->average_rating >= 3)?'#5f5f62':'#b8b9b9'}}"></i>
                          <i class="fas fa-star" style="color:{{($product->average_rating >= 4)?'#5f5f62':'#b8b9b9'}}"></i>
                          <i class="fas fa-star" style="color:{{($product->average_rating >= 5)?'#5f5f62':'#b8b9b9'}}"></i>
                        </div>
                        <a href="{{ route('product', [
                                                    $product,
                                                    $product->slug,
                                                    $product->categories->first()->slug ?? '',
                                                    ]) }}"
                            class="card__btn">
                        <i class="fas fa-arrow-right"></i>
                        <span>Read More</span>
                        </a>
                    </div>
                    </a>
                </div>
                @endforeach
            @else
                <p style="text-align:center;">
                  @if(isset($selectedCategories))
                    <b>0 </b>books found in 
                    @foreach($selectedCategories as $selected)
                      <b>{{$selected->name}}</b>
                    @endforeach
                  @else
                    <b>0 </b>books found for your search of <b>{{request()->input('query')}}</b>
                  @endif
                </p>
            @endif
            </div>
            <div class="product__main-page-bottom">
              <div action="" class="sort__form">
                <!-- <div class="form__container">
                  <label for="sortPage">Show:</label>
                  <select name="" id="sortPage">
                    <option value="" selected>10</option>
                    <option value="">16</option>
                    <option value="">32</option>
                  </select>
                </div> -->
              </div>
              {{$products->links('vendor.pagination.asmita')}}
              
            </div>
          </div>
        </section>
      </div>
    </main>
@endsection

@section('scripts')

@endsection