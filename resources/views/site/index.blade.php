@extends('layouts.website')
@section('content')
@foreach($popups as $key => $popup)

<div id="myModal{{$key}}" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$popup->name}}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <img
              class="d-block w-100"
              src="{{$popup->photo->url}}"
              alt=""
            />
                
            </div>
        </div>
    </div>
</div>

@endforeach
  <div class="section-background--slider">
      <div
        id="carouselExampleControls"
        class="carousel slide fix-height"
        data-ride="carousel"
      >
        <!-- <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              class="d-block w-100"
              src="site/img/slider-5.jpg"
              alt="First slide"
            />
          </div>
          <div class="carousel-item">
            <img
              class="d-block w-100"
              src="site/img/slider-3.jpg"
              alt="Third slide"
            />
          </div> -->

          <div class="carousel-inner">
          @php 
            $i = 1;
          @endphp
          @foreach($sliders as $slider)
          <div class="carousel-item {{$i == '1' ? 'active' : '' }} ">
          @php 
            $i++;
          @endphp
            <img
              class="d-block w-100"
              src="{{$slider->photo->url}}"
              alt=""
            />
          </div>
            @endforeach
        </div>
        <a
          class="carousel-control-prev"
          href="#carouselExampleControls"
          role="button"
          data-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a
          class="carousel-control-next"
          href="#carouselExampleControls"
          role="button"
          data-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  
  <main>
    <section class="section top-picks featured-book__container">
      <!-- <div class="overlay"></div> -->
      <h3 class="section__heading">Featured Books</h3>
      <div class="top-picks__container product__main-page-main">
        @foreach($featured_products as $product)
        <div class="top-picks__card">
          <a class="top-picks__title" href="{{ route('product', [
                                                  $product,
                                                  $product->slug,
                                                  $product->categories->first()->slug ?? '',
                                                ]) }}">
            <div class="top-picks__image">
              <img src="{{ $product->photo->url ?? 'http://placehold.it/525x570' }}" alt="{{$product->name}}" />
            </div>
            <div class="top-picks__body">
              <!-- @foreach($product->categories as $category)
                @if(isset($category->parentCategory))
                  @foreach($category->parentCategory as $parentCategory)
                    <a class="top-picks__info"> {{ $parentCategory->name ?? '' }}</a>
                  @endforeach
                @endif
                <a class="top-picks__info"> {{$category->name}}</a>
              @endforeach -->
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
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </section>

    <!-- all books section -->
    <section class="allBooks-section">
      <div class="title-seperator utility-padding">
        <h3 class="section__heading">All Books</h3>
        <a href="#"
          >View All Products
          <span><i class="fas fa-arrow-right"></i></span>
        </a>
      </div>
      <div class="gallery__container utility-padding">
        <div class="gallery__heading">
          <h2 class="gallery__heading-text">
            Ashmita Books Publishers & Distributors P. Ltd.
          </h2>
          <div class="gallery__heading-image">
            <img src="site/img/slider-1.jpg" alt="" />
          </div>
          <a href="" class="btn btn-link"
            >Explore Books
            <span><i class="fas fa-arrow-right"></i></span>
          </a>
        </div>
        <div class="product__main-page-main">
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
                  <a class="top-picks__title" href= "{{ route('product', [
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
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- small advertisment -->
    <section class="advertisment-section">
      <div class="advertisment-section__header">
        <h1 class="advertisement__text">
          Asmita Books Publishers & Distributors P .Ltd
        </h1>
        <a href="" class="btn btn-link-1"
          >Explore Books
          <span><i class="fas fa-arrow-right"></i></span>
        </a>
        <div class="image__section">
          <img src="site/img/slider-5.jpg" alt="" />
        </div>
      </div>
    </section>
    <!-- recent books -->
    <section class="recent-books">
      <div class="gallery__container utility-padding recent-books__container">
        <h3 class="section__heading">Recent Books</h3>
        <div class="product__main-page-main">
          @foreach($recent_products as $product)
          <div class="top-picks__card card__link">
            <a href="{{ route('product', [
                                            $product,
                                            $product->slug,
                                            $product->categories->first()->slug ?? '',
                                          ]) }}">
              <div class="top-picks__image">
                <!-- <img src="site/img/books.jpg" alt="" /> -->
                <img src="{{ $product->photo->url ?? 'http://placehold.it/525x720' }}" alt="{{$product->name}}" />
              </div>
              <div class="top-picks__body">
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
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>

  </main>

@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    const popups = <?php echo $popups?>;
    let key = 0;
    for(var popup in popups) {
      key = Object.keys(popups).indexOf(popup);
      $(`#myModal${key}`).modal('show');
    }
  });
</script>
@endsection