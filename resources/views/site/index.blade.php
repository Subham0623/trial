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
                  src="{{$popup->photo?$popup->photo->url:''}}"
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
              src="{{$slider->photo?$slider->photo->url:''}}"
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