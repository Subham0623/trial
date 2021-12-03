@extends('layouts.website')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
    integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
    crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('plugins/pdfjs-flipbook/build/jquery.fancybox.min.css') }}">
<!-- current page css file -->
<!-- <link rel="stylesheet" href="{{ asset('site/css/insidePage.css')}}" /> -->
<!-- owl carousel edit -->
<link rel="stylesheet" href="{{ asset('site/css/owlCarouselCustom.css')}}" />

<script src="{{ asset('site/js/tabbed.js')}}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.0/crypto-js.min.js"
    integrity="sha512-c7oz5IHPam1DSQt1VLmsg2Mo4Aal0OacrRP6+uqW1XKFaUZOuGHD66kOqfx0XZA9Vl4UEKIjBjpcctLH7huv3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
@if(session()->has('message'))
<div class="alert alert-success" id="successMessage">
    {{ session()->get('message') }}
</div>
@endif
<main class="catch">
    @if ($errors->any())   
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
    <!-- section breadcrum -->
    <!-- <section class="section section--breadcrum">
      <p>
        <a href="#">Home</a> /
        <a href=""> T.U</a> /
        <a href="">5th Semester(BIM, T.U)</a> /
        <a href="">2nd Semester(BBAF, T.U)</a> /
        <a href="">Macro Economics For BBA/BBM/BIM T.U</a>
      </p>
    </section> -->

    <div class="main--padding">
        <!-- book description -->
        <section class="section section--description">
            <div class="section--description__image">
                <div class="section--description__image-1">
                    <img src="{{ $product->photo->url ?? 'http://placehold.it/525x570' }}" alt="{{$product->name}}" />
                </div>
                <div class="section--description__image-container">
                    <div class="review__image">
                        <img src="{{ $product->photo ? $product->photo->getUrl('thumb') : 'http://placehold.it/525x570' }}"
                            alt="{{$product->name}}">
                    </div>
                </div>
            </div>
            <div class="section--description__body cart-container">
                <div class="description--head">
                    <h3 class="section__title">
                        <span>{{$product->name}} </span>
                        <div class="top-picks__rating">
                            <i class="fas fa-star"
                                style="color:{{($product->average_rating >= 1)?'#5f5f62':'#b8b9b9'}}"></i>
                            <i class="fas fa-star"
                                style="color:{{($product->average_rating >= 2)?'#5f5f62':'#b8b9b9'}}"></i>
                            <i class="fas fa-star"
                                style="color:{{($product->average_rating >= 3)?'#5f5f62':'#b8b9b9'}}"></i>
                            <i class="fas fa-star"
                                style="color:{{($product->average_rating >= 4)?'#5f5f62':'#b8b9b9'}}"></i>
                            <i class="fas fa-star"
                                style="color:{{($product->average_rating >= 5)?'#5f5f62':'#b8b9b9'}}"></i>
                        </div>
                    </h3>
                    <div class="section__summary u-default-padding-bottom">
                        <span>Author:</span>
                        @foreach($product->authors as $author)
                        <a href="" class="author-link">{{$author->name}}</a>
                        @endforeach

                    </div>
                    <div class="" style="text-align:justify;">
                        {!! Str::limit($product->description, 1000) !!}
                    </div>
                    <!-- <div class="action u-default-padding-bottom">
              <a href="">
                <i class="fas fa-shopping-bag"></i><span> Read More</span>
              </a>
            </div> -->
                    <div class="links-section">
                        <div class="social-link__container">
                            <div class="social-links facebook">
                                <a href="">
                                    <i class="fab fa-facebook-f icon"></i>
                                </a>
                            </div>
                            <div class="social-links twitter">
                                <a href="">
                                    <i class="fab fa-twitter icon"></i>
                                </a>
                            </div>
                            <div class="social-links linkeden">
                                <a href="">
                                    <i class="fab fa-linkedin-in icon"></i>
                                </a>
                            </div>
                            <div class="social-links">
                                <a href="">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                            <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                        </div>
                        
                        
                        
                        <!-- <button class="btn-top">
                            <i class="fas fa-chevron-up"></i>
                        </button> -->
                    </div>
                    <!-- side by side arrow -->
                    <div class =  "wishlist-content">
                        <input type="hidden" class = "product_id" value="{{$product->id}}">
                        <button type="button"  class="add-to-wishlist-btn"><i class="far fa-heart"></i></button>
                    </div>
                </div>
                <!-- add to cart -->
            {{--<div class="card__payment-details">
                    <h2>Rs. 1400</h2>
                    <!--  -->
                    <ul class="important__items">
                        <li class="important__items-list">
                        <div class="list__icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <span class="list__text"> Free Delivery Inside Valley </span>
                        </li>
                    </ul>
                    <!--  -->
                    <div class="list__actions">
                        <button class="list__action-btn">Add To Cart</button
                        ><button class="list__action-btn">Add To Wishlist</button>
                    </div>
                </div>--}}
            </div>
            
            

            
            <!-- side by side arrow -->
          </div>
        </div>
      </section>

        <?php
        $user = auth()->user();
        if($user) {
          $user_roles = $user->roles;
          $roles = $user_roles->pluck('id');
          $roles = $roles->toArray();
        //   dd($roles);
        }
        $product_roles = $product->roles->pluck('id')->toArray();
        // dd(array_intersect($product_roles,$roles));
    ?>
        <!-- section tabbed component -->
        <section class="section section__tabbed">
            <div class="operations">
                <div class="operations__tab-container">
                    <button class="btn--operations operations__tab operations__tab--2 operations__tab--active"
                        data-tab="2">
                        Description
                    </button>
                    @if($user)
                        @if($user->is_admin)
                            <button class="
                                    btn--operations
                                    operations__tab operations__tab--1
                                "   data-tab="1">
                                Read Book
                            </button>
                            <button class="
                                    btn--operations
                                    operations__tab operations__tab--6
                                "   data-tab="6">
                                Manuals
                            </button>
                            <button class="btn--operations operations__tab operations__tab--5" data-tab="5">
                                Learning Materials
                            </button>
                        @elseif(array_intersect($product_roles,$roles))
                            <button class="
                                    btn--operations
                                    operations__tab operations__tab--1
                                "   data-tab="1">
                                Read Book
                            </button>
                            <button class="
                                    btn--operations
                                    operations__tab operations__tab--6
                                "   data-tab="6">
                                Manuals
                            </button>
                            <button class="btn--operations operations__tab operations__tab--5" data-tab="5">
                                Learning Materials
                            </button>
                        @else
                            @if(in_array('3',$roles) && !$product->level_id == null)
                                @foreach($user->levels as $level)
                                    @if($level->id == $product->level_id)
                                        @foreach($product->tags as $product_tag)
                                            @if($level->pivot->product_tag_id == $product_tag->id)
                                                <button class="
                                                            btn--operations
                                                            operations__tab operations__tab--1
                                                        " data-tab="1">
                                                    Read Book
                                                </button>
                                                <button class="
                                                        btn--operations
                                                        operations__tab operations__tab--6
                                                    "   data-tab="6">
                                                    Manuals
                                                </button>
                                                <button class="btn--operations operations__tab operations__tab--5" data-tab="5">
                                                    Learning Materials
                                                </button>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    @endif
                    <button class="btn--operations operations__tab operations__tab--3" data-tab="3">
                        Meet the author
                    </button>
                    <button class="btn--operations operations__tab operations__tab--4" data-tab="4">
                        Review
                    </button>
                    
                </div>

                <div class="operations__content operations__content--2 operations__content--active">
                    <h5 class="operations__header" data-click="2">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Description
                    </h5>
                    <div class="hide-content display--2">
                        <table id="table__data">
                            <tr>
                                <td>Categories</td>
                                <td>
                                    @foreach($selectedCategories as $key => $category)
                                    @if($category)
                                    <!-- <a href="{{ route('category', [ $category[$key-3]??'', $category[$key-2]??'', $selectedCategories[$key-1]??'', $category->slug ]) }}">{{$category->name}}</a>, -->
                                    @if($category != end($selectedCategories))
                                    {{$category->name}} &nbsp;/&nbsp;
                                    @else
                                    {{$category->name}}
                                    @endif
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Tags</td>
                                <td>
                                    @foreach($product->tags as $tag)
                                    <!-- <a href="">{{$tag->name}}</a> -->
                                    @if($tag != $product->tags->last())
                                    {{$tag->name}} &nbsp;|&nbsp;
                                    @else
                                    {{$tag->name}}
                                    @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>{{$product->price}}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($user)
                @if($user->is_admin)
                <div class="
                    operations__content
                    operations__content--1
                    ">
                    <h5 class="operations__header" data-click="1">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Read Book
                    </h5>
                    <div class="book__reader hide-content display--1">
                        @if(isset($product->book))
                        <iframe class="book__reader-iframe"
                            src="{{URL::signedRoute('viewer',['b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'=> Crypt::encrypt($product->book->getFirstMedia('book')->getUrl())],Carbon\Carbon::now()->addMinutes(5))}}"
                            frameborder="0"></iframe>
                        @else
                        No book to read.
                        @endif
                    </div>
                </div>

                <div class="
                    operations__content
                    operations__content--6
                    ">
                    <h5 class="operations__header" data-click="6">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Manuals
                    </h5>
                    <div class="book__reader hide-content display--6">
                        @if(isset($product->manual))
                        <iframe class="book__reader-iframe"
                            src="{{URL::signedRoute('viewer',['b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'=> Crypt::encrypt($product->manual->getFirstMedia('manual')->getUrl())],Carbon\Carbon::now()->addMinutes(5))}}"
                            frameborder="0"></iframe>
                        @else
                        No manual to read.
                        @endif
                    </div>
                </div>

                <div class="operations__content operations__content--5">
                    <h5 class="operations__header" data-click="5">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Learning Materials
                    </h5>
                    <small class="text-muted">Please click to view the manual!</small>
                    <div class="hide-content display--5">

                        @if($product->resource->count())
                        <table id="table__data">
                            <tbody>
                                @foreach($product->resource as $res)
                                <tr>
                                    <td> <a data-fancybox class="fancybox" data-type="iframe"
                                            data-src="{{URL::signedRoute('viewer',['b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'=> Crypt::encrypt($res->url)],Carbon\Carbon::now()->addMinutes(31))}}"
                                            href="javascript:;">{{substr(strstr($res->name,'_'), 1)}}</a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <span>Sorry... No manuals available here at the moment.</span>
                        @endif
                    </div>
                </div>
                @elseif(array_intersect($product_roles,$roles))
                <div class="
                              operations__content
                              operations__content--1
                              ">
                    <h5 class="operations__header" data-click="1">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Read Book
                    </h5>
                    <div class="book__reader hide-content display--1">
                        @if(isset($product->book))
                        <iframe class="book__reader-iframe"
                            src="{{URL::signedRoute('viewer',['b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'=> Crypt::encrypt($product->book->getFirstMedia('book')->getUrl())],Carbon\Carbon::now()->addMinutes(5))}}"
                            frameborder="0"></iframe>
                        @else
                        No book to read.
                        @endif
                    </div>
                </div>

                <div class="
                              operations__content
                              operations__content--6
                              ">
                    <h5 class="operations__header" data-click="6">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Manual
                    </h5>
                    <div class="book__reader hide-content display--6">
                        @if(isset($product->manual))
                        <iframe class="book__reader-iframe"
                            src="{{URL::signedRoute('viewer',['b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'=> Crypt::encrypt($product->manual->getFirstMedia('manual')->getUrl())],Carbon\Carbon::now()->addMinutes(5))}}"
                            frameborder="0"></iframe>
                        @else
                        No manual to read.
                        @endif
                    </div>
                </div>

                <div class="operations__content operations__content--5">
                    <h5 class="operations__header" data-click="5">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Learning Materials
                    </h5>
                    <small class="text-muted">Please click to view the manual!</small>
                    <div class="hide-content display--5">

                        @if($product->resource->count())
                        <table id="table__data">
                            <tbody>
                                @foreach($product->resource as $res)
                                <tr>
                                    <td> <a data-fancybox class="fancybox" data-type="iframe"
                                            data-src="{{URL::signedRoute('viewer',['b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'=> Crypt::encrypt($res->url)],Carbon\Carbon::now()->addMinutes(31))}}"
                                            href="javascript:;">{{substr(strstr($res->name,'_'), 1)}}</a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <span>Sorry... No manuals available here at the moment.</span>
                        @endif
                    </div>
                </div>
                @else
                @if(in_array('3',$roles) && !$product->level_id == null)
                @foreach($user->levels as $level)
                @if($level->id == $product->level_id)
                @foreach($product->tags as $product_tag)
                @if($level->pivot->product_tag_id == $product_tag->id)
                <div class="
                              operations__content
                              operations__content--1
                              ">
                    <h5 class="operations__header" data-click="1">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Read Book
                    </h5>
                    <div class="book__reader hide-content display--1">
                        @if(isset($product->book))
                        <iframe class="book__reader-iframe"
                            src="{{URL::signedRoute('viewer',['b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'=> Crypt::encrypt($product->book->getFirstMedia('book')->getUrl())],Carbon\Carbon::now()->addMinutes(5))}}"
                            frameborder="0"></iframe>
                        @else
                        No book to read.
                        @endif
                    </div>
                </div>

                <div class="
                              operations__content
                              operations__content--6
                              ">
                    <h5 class="operations__header" data-click="6">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Manual
                    </h5>
                    <div class="book__reader hide-content display--6">
                        @if(isset($product->manual))
                        <iframe class="book__reader-iframe"
                            src="{{URL::signedRoute('viewer',['b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'=> Crypt::encrypt($product->manual->getFirstMedia('manual')->getUrl())],Carbon\Carbon::now()->addMinutes(5))}}"
                            frameborder="0"></iframe>
                        @else
                        No manual to read.
                        @endif
                    </div>
                </div>

                <div class="operations__content operations__content--5">
                    <h5 class="operations__header" data-click="5">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Learning Materials
                    </h5>
                    <small class="text-muted">Please click to view the manual!</small>
                    <div class="hide-content display--5">

                        @if($product->resource->count())
                        <table id="table__data">
                            <tbody>
                                @foreach($product->resource as $res)
                                <tr>
                                    <td> <a data-fancybox class="fancybox" data-type="iframe"
                                            data-src="{{URL::signedRoute('viewer',['b24324213455i5352352b623643e4656k85678r97897a06j8708a678006n606786khatriprajapati'=> Crypt::encrypt($res->url)],Carbon\Carbon::now()->addMinutes(31))}}"
                                            href="javascript:;">{{substr(strstr($res->name,'_'), 1)}}</a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <span>Sorry... No manuals available here at the moment.</span>
                        @endif
                    </div>
                </div>
                @endif
                @endforeach
                @endif
                @endforeach
                @endif
                @endif
                @endif
                <div class="operations__content operations__content--3">
                    <h5 class="operations__header" data-click="3">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Meet the author
                    </h5>
                    <div class="hide-content display--3">
                        @if($product->authors->count())
                        @foreach($product->authors as $author)
                        <h3 class="author-name">
                            <a href="" class="author-link">{{$author->name}}</a>
                        </h3>
                        <div class="author__sub-details">
                            <!-- <p>Date of birth: <span>1997/05/2</span></p> -->
                            <div>
                                <p>Bio:</p>
                                <span>
                                    {{$author->short_bio}}
                                </span>
                            </div>
                            <span></span>
                        </div>
                        @endforeach
                        @else
                        <span>Sorry... No details available here at the moment.</span>
                        @endif
                    </div>
                </div>
                <div class="operations__content operations__content--4">
                    <h5 class="operations__header" data-click="4">
                        <span><i class="fas fa-chevron-down"></i></span>
                        Review
                    </h5>

                    <div class="hide-content display--4">
                        <!-- <h3 class="review__topic">{{$product->name}}</h3> -->
                        <ul class="review__list">
                            @php
                            $reviews = $product->reviews()->where('status',1)->latest()->get();
                            @endphp

                            @if($reviews->count())
                            @foreach ($reviews as $review)
                            <li style="margin-bottom:2rem;">
                                <div class="img">
                                    <img src="{{ asset('gravatar.png')}}" alt="" />
                                </div>
                                <div class="list__description">
                                    <div class="comment">
                                        <h4 class="review__name">
                                            <!-- Rajan Prajapati -->
                                            {{$review->user->name}}
                                            <!-- <span>- june 6, 2021</span> -->
                                            <span>{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</span>
                                        </h4>
                                        <!-- <p class="comment__paragraph">it's a wonderful book.</p> -->
                                        <p class="comment__paragraph">{{ Str::limit($review->review,100)}}</p>
                                    </div>
                                    <div class="star__ratings">
                                        <!-- <input type="radio" name="rate" id="rate-5" />
                        <label for="rate-5" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-4" />
                        <label for="rate-4" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-3" checked />
                        <label for="rate-3" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-2" />
                        <label for="rate-2" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-1" />
                        <label for="rate-1" class="fas fa-star"></label> -->
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @else
                            <span style="color : red;">There are no comments yet.</span>
                            @endif
                        </ul>
                        <div class="review__form">
                            <h3 class="review__topic">Add Review</h3>
                            <div id="rating_message"></div>
                            <div class="comment__form comment__form-group" style="margin-bottom:2rem;">
                                <label for="">Your Rating</label>
                                @php
                                $ratings = App\Rating::where([['user_id',Auth::id()],
                                ['product_id',$product->id]])->first();

                                @endphp


                                <div class="star__ratings">

                                    <input type="radio" name="rate" id="5" onclick="rating('5')" />
                                    <label for="5" class="fas fa-star"></label>
                                    <input type="radio" name="rate" id="4" onclick="rating('4')" />
                                    <label for="4" class="fas fa-star"></label>
                                    <input type="radio" name="rate" id="3" onclick="rating('3')" />
                                    <label for="3" class="fas fa-star"></label>
                                    <input type="radio" name="rate" id="2" onclick="rating('2')" />
                                    <label for="2" class="fas fa-star"></label>
                                    <input type="radio" name="rate" id="1" onclick="rating('1')" />
                                    <label for="1" class="fas fa-star"></label>

                                </div>
                            </div>
                            <form method="POST" action="{{route('user.review',$product->id)}}" class="comment__form">
                                @csrf
                                <div class="comment__form-group">

                                    <div class="comment__form-group">
                                        <label for="description-review">Your Review</label>
                                        <textarea name="review" id="description-review" cols="" rows="5"
                                            class="{{ $errors->has('review') ? 'is-invalid' : '' }}"
                                            required></textarea>
                                        @if($errors->has('review'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('review') }}
                                        </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="required" for="type"></label><br>
                                            <input type="radio" name="type" value="0"
                                                class="{{ $errors->has('type') ? 'is-invalid' : '' }}"
                                                required>Publisher<br>
                                            <input type="radio" name="type" value="1"
                                                class="{{ $errors->has('type') ? 'is-invalid' : '' }}"
                                                required>Author<br>
                                            @if($errors->has('type'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('type') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- actions -->
                                    <div class="review__actions">
                                        <button class="review__cancel a-btn">Cancel</button>
                                        <button class="review__btn a-btn">Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>

        <!-- recent books owl carousel -->
        <section class="section section__recent-books-carousel">
            <div class="heading">
                <h4>Related Products</h4>
            </div>

            @if($related_products->count())
            <div class="owl-carousel owl-theme spacing-owl owl-help">
                @foreach($related_products as $related_product)
                <div class="item">
                    <div class="top-picks__card card__link">
                        <a href="{{ route('product', [
                                                  $related_product,
                                                  $related_product->slug,
                                                  $related_product->categories->first()->slug ?? '',
                                                ]) }}">
                            <div class="top-picks__image">
                                <img src="{{ $related_product->photo->url ?? 'http://placehold.it/525x570' }}"
                                    alt="{{$related_product->name}}" />
                            </div>
                            <div class="top-picks__body">
                                <!-- <a class="top-picks__info"
                            >10 +2 Books, Eleven, latest releases, love books</a
                        > -->
                                <a class="top-picks__title" href="{{ route('product', [
                                                  $related_product,
                                                  $related_product->slug,
                                                  $related_product->categories->first()->slug ?? '',
                                                ]) }}">{{$related_product->name}}</a>
                                <div class="top-picks__rating">
                                    <i class="fas fa-star"
                                        style="color:{{($related_product->average_rating >= 1)?'#5f5f62':'#b8b9b9'}}"></i>
                                    <i class="fas fa-star"
                                        style="color:{{($related_product->average_rating >= 2)?'#5f5f62':'#b8b9b9'}}"></i>
                                    <i class="fas fa-star"
                                        style="color:{{($related_product->average_rating >= 3)?'#5f5f62':'#b8b9b9'}}"></i>
                                    <i class="fas fa-star"
                                        style="color:{{($related_product->average_rating >= 4)?'#5f5f62':'#b8b9b9'}}"></i>
                                    <i class="fas fa-star"
                                        style="color:{{($related_product->average_rating >= 5)?'#5f5f62':'#b8b9b9'}}"></i>
                                </div>
                                <a href="#" class="card__btn">
                                    <i class="fas fa-arrow-right"></i>
                                    <span>Read More</span>
                                </a>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <span>Sorry... No related products found.</span>
            @endif
        </section>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
    integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
    crossorigin="anonymous"></script>
<script src="{{ asset('plugins/pdfjs-flipbook/build/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript">
    $('.fancybox').fancybox();
      $(".owl-help").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        autoPlay: true,
        autoPlayTimeout: 1,
        // navText: [
        //   "<div class='nav---btn prev-slide'><</div>",
        //   "<div class='nav---btn next-slide'>></div>",
        // ],
        responsive: {
          0: {
            items: 1,
          },
          600: {
            items: 2,
          },
          800: {
            items: 3,
          },
          1000: {
            items: 4,
          },
        },
      });

      setTimeout(function() {
        $('#successMessage').fadeOut('fast');
        }, 3000);

        function rating(value) {
            $.ajax({
               method:'POST',
               url:'{{route('user.rating',$product->id)}}',
               data: {
	                    name: value,
	                    },
               headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
               success:function(data) {
                  $('#rating_message').append("<p class='msg alert alert-success'>Thanks for your rating</p>");

                  setTimeout(function() {
                  $('.msg').remove();
                  }, 3000);
                }
            });
         }

        //  to show user rating
         $ratings = <?php echo (isset($ratings))?$ratings:'null' ?>;

          if($ratings) {
            $rating = $ratings.rate;
            const checkedStar = document.getElementById(`${$rating}`);

            checkedStar.checked = true;
          }

          timeInervl = 0.001;
          var blink1 = function() {
                for (let index = 0; index < 100; index++) {
                    $('.blink').css({'opacity':'0'});
                }
                for (let index = 0; index < 100; index++) {
                    $('.blink').css({'opacity':'100'});
                }
            };
                setInterval(blink1, timeInervl+timeInervl);


                $(document).ready(function(){
                    $('.add-to-wishlist-btn').click(function(e){
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
                        method:'POST',
                        url:'/user/add-to-wishlist',
                        data: {
	                        product_id: product_id,
	                        },
                            error: function (xhr) {
                                if (xhr.status == 401) {
                                window.location.href = '/login';
                                }
}
                        
                    });
                    });
                });
</script>
@endsection
