@extends('layouts.website')

@section('styles')
  <link rel="stylesheet" href="{{ asset('site/css/login.css')}}" />
@endsection

@section('content')
  <section class="section-log">
    <div class="row-log">
      <div class="brandLogo">
        <img src="site/img/asmita.png" alt="" />
      </div>
      <div class="logIn__form">
        @if(session('error'))
          <div class="alert alert-info" role="alert">
              {{ session('error') }}
          </div>
        @endif

        <form class="form" method="POST" action="{{ route('login') }}">
          @csrf

          <div class="form__group">
            <input
              type="email"
              class="form__input @error('email') is-invalid @enderror"
              placeholder="Email Address"
              id="email"
              name="email"
              required
            />
            <label for="email" class="form__label">Email Address</label>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="form__group">
            <input
              type="password"
              class="form__input @error('password') is-invalid @enderror"
              placeholder="Password"
              id="password"
              name="password"
              required
            />
            <label for="password" class="form__label ">Password</label>
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form__group align-center">
            <input type="submit" class="btn__log btn--log" value="Log In" />
          </div>

          <div class="form__group">
            <div class="other--option">
              <ul class="options__links">
                <li>
                  <a href="{{ route('register') }}">
                    <span class="icon-2"
                      ><i class="fas fa-arrow-right"></i
                    ></span>
                    <span class="effect">Register</span>
                  </a>
                </li>
                <li>
                  @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                      <span class="icon-2"
                        ><i class="fas fa-arrow-right"></i
                      ></span>
                      <span class="effect">Reset Password</span>
                    </a>
                  @endif
                </li>
                <li>
                  <a href="{{ route('index') }}">
                    <span class="icon-2"
                      ><i class="fas fa-arrow-right"></i
                    ></span>
                    <span class="effect">Home</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <!-- <div class="form-group">
            <span>Or Sign In With</span>
          </div> -->
        </form>
      </div>
    </div>
  </section>
@endsection