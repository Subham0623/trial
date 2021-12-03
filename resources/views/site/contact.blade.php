@extends('layouts.website')
@section('styles')

@endsection

@section('content')
@if(session()->has('message'))
    <div class="alert alert-success" id = "successMessage">
        {{ session()->get('message') }}
    </div>
@endif
  <main>
    <section class="section section--description">
        <div class="section--description__image contact__image-container">
          <div class="section--description__image-1 contact__page">
            <img src="{{asset('site/img/contactUs.jpg')}}" alt="name" />
          </div>
        </div>

        <div class="section--description__body">
            <div class="description--head ">
                <h1 class="section__title bold">Contact Us</h1>
                <hr style="width:100%;">
            </div>
            <div class="u-default-padding-bottom contact__content">
                <p><span class='bold'> Address : </span><span class="take__space"> Putalisadak,Kathmandu </span></p>
                <p> <span class='bold'> Phone :</span> <span class="take__space"> 01-4168274, 01-4168216, 01-4168207, 01-4168220 </span> </p>
                <p> <span class='bold'>Mail :</span> <span class="take__space">  asmita.bpd@gmail.com</span></p>
                <p> <span class='bold'>info: </span> <span class="take__space">asmitapublication@gmail.com</span></p>
                <p> <span class='bold'>Facebook :</span> <span class="take__space"><a href="">www.facebook.com/asmitapublication</a></span></p>
                <p> <span class='bold'>Website :</span> <span class="take__space"> asmitapublication.com</span></p>
            </div>
        </div>
      </section>
  </main>
@endsection

@section('scripts')
    
@endsection
