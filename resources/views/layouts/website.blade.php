<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Asmita Publication</title>
    <link rel="shortcut icon" href="{{asset('asmita_favicon.png')}}">
    <!-- bootstrap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
      integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l"
      crossorigin="anonymous"
    />

    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
      integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="{{ asset('site/css/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('site/css/insidePage.css')}}" />
    <link rel="stylesheet" href="{{ asset('site/css/commonPage.css')}}" />
    <script src="{{ asset('site/js/mobileNavigation.js')}}" defer></script>
    @yield('styles')
  </head>
  <body>
    <div class="content__wrapper">

      <section class="header-section section">
        <!-- logo -->
        <a href="{{route('index')}}" class="logo-link">
          <img src="{{ asset('site/img/asmita.png')}}" alt="" />
        </a>
        <form action="{{route('search')}}" class="header-section__form">
          <div class="form__group">
            <input type="text" name="query" placeholder="Search for books by keyword / title / author" value="{{ request()->input('query')}}" required/>
            <!-- <select id="Categories" class="select">
              <option value="hide">All Categories</option>
              <option value="all categories">All Categories</option>
              <option value="uncategorized">uncategorized</option>
              <option value="schoolLevel">School Level</option>
              <option value="one">One</option>
              <option value="two">two</option>
              <option value="three">three</option>
              <option value="four">four</option>
              <option value="five">five</option>
              <option value="six">six</option>
              <option value="seven">seven</option>
              <option value="eight">eight</option>
              <option value="nine">nine</option>
              <option value="ten">ten</option>
              <option value="ten">ten</option>
              <option value="MBBS">MBBS</option>
              <option value="BCA">BCA</option>
              <option value="BBS">BBS</option>
            </select> -->
              <div class="delete__search">
              <i class="fas fa-times"></i>
              </div>
            <button class="search-btn"><i class="fas fa-search"></i></button>
          </div>
        </form>
        <!-- search -->
      </section>
      <!-- mobile tablet search -->
      <a class="btn searchIcon">
        <i class="fas fa-search"></i>
        <form action="{{route('search')}}" class="header-section__form myForm">
          <div class="form__group">
            <input type="text" name="query" placeholder="Search for books by keyword / title / author" value="{{ request()->input('query')}}" required/>
            <!-- <select id="Categories" class="select">
              <option value="hide">All Categories</option>
              <option value="all categories">All Categories</option>
              <option value="uncategorized">uncategorized</option>
              <option value="schoolLevel">School Level</option>
              <option value="one">One</option>
              <option value="two">two</option>
              <option value="three">three</option>
              <option value="four">four</option>
              <option value="five">five</option>
              <option value="six">six</option>
              <option value="seven">seven</option>
              <option value="eight">eight</option>
              <option value="nine">nine</option>
              <option value="ten">ten</option>
              <option value="ten">ten</option>
              <option value="MBBS">MBBS</option>
              <option value="BCA">BCA</option>
              <option value="BBS">BBS</option>
            </select> -->
            <div class="delete__search">
              <i class="fas fa-times"></i>
              </div>
            <button class="search-btn"><i class="fas fa-search"></i></button>
          </div>
        </form>
      </a>
      <section class="sub-header__container">
        <!-- nav section -->
        <nav class="section-nav">
          <input type="checkbox" id="check" />
          <div class="hamburger-menu-container">
            <div class="hamburger-menu">
              <div></div>
            </div>
          </div>
          <div class="logo-container">
            <a href="{{route('index')}}" class="logo-container__link">
              <img src="{{ asset('site/img/asmita.png')}}" alt="" />
            </a>
          </div>
          <!-- desktop nav and then transformed into mobile now -->
          <div class="nav-btn">
            <!-- after sticky should be displayed -->
            <div class="logo-container">
              <a href="{{route('index')}}" class="logo-container__link">
                <img src="{{asset('site/img/asmita.png')}}" alt="" />
              </a>
            </div>
            <div class="nav-links">
              <ul>
                @foreach($frontCategories as $parentCategory)
                <li class="nav-link">
                  <a href="{{ route('category', [$parentCategory]) }}">{{$parentCategory->name}} <i class="fas fa-caret-down {{($parentCategory->childCategories->count())?'':'opacity'}}"></i></a>
                  @if($parentCategory->childCategories->count())              
                  <div class="dropdown">
                    <ul>
                      @foreach($parentCategory->childCategories as $category)
                      <li class="dropdown-link">
                        <a href="{{ route('category', [$parentCategory, $category]) }}"> {{$category->name}} <i class="fas fa-caret-right {{$category->childCategories->count()?'':'opacity'}}"></i></a>
                        @if($category->childCategories->count())
                        <div class="dropdown nested">
                          <ul>
                            @foreach($category->childCategories as $childCategory)
                            <li class="dropdown-link">
                              <a href="{{ route('category', [$parentCategory, $category, $childCategory->slug]) }}">
                                {{$childCategory->name}}
                                <i class="fas fa-caret-right {{$childCategory->childCategories->count()?'':'opacity'}}"></i
                              ></a>
                              @if($childCategory->childCategories->count())
                              <div class="dropdown nested">
                                <ul>
                                  @foreach($childCategory->childCategories as $subCategory)
                                  <li class="dropdown-link">
                                    <a href="{{ route('category', [$parentCategory, $category, $childCategory->slug, $subCategory->slug]) }}">
                                      {{$subCategory->name}}
                                    </a>
                                  </li>
                                  @endforeach
                                  <div class="arrow"></div>
                                </ul>
                              </div>
                              @endif
                            </li>
                            @endforeach
                            <div class="arrow"></div>
                          </ul>
                        </div>
                        @endif
                      </li>                  
                      @endforeach
                      <div class="arrow"></div>
                    </ul>
                  </div>
                  @endif
                </li>
                @endforeach
                <li class="nav-link">
                  <a href="{{ route('contact') }}">
                    Contact Us
                  </a>
                </li>
              </ul>
            </div>
            <div class="nav-sign">
              <div>
                <a href="{{route('cart')}}">
                  <i class="fa fa-shopping-cart" aria-hidden="true">
                  </i></a>
                 
                  
                  
                  @if(auth::user()==null)
                    <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                  @else
                    @php
                      $userCart = auth::user()->cart;
                    @endphp
                      @if(!isset($userCart))
                        <span class="badge badge-pill badge-danger">{{ count((array)$userCart) }}</span>
                      @else
                        <span class="badge badge-pill badge-danger">{{ count(auth::user()->cart->products) }}</span>
                      @endif
                  @endif

              </div>
                          
              @guest
                <a href="{{ route('login') }}" class="sign-in"
                  ><i class="fas fa-user"></i> <span> Sign In</span></a
                  >
                @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="register">
                    <i class="fas fa-user-plus"></i>
                    <span>Register</span></a
                  >
                @endif
              @else
                <a id="navbarDropdown" class="nav-link dropdown-toggle register" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                    <div class="dropdown-menu dropdown-menu-right dropdown" aria-labelledby="navbarDropdown">
                    <button class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                </a>
              @endguest
            </div>
              <!-- visible after sticky -->
            <a class="btn sticky-search">
              <i class="fas fa-search"></i>
              <form action="{{route('search')}}" class="header-section__form sticky-form">
                <div class="form__group">
                  <input type="text" name="query" placeholder="Search for books by keyword / title / author" value="{{ request()->input('query')}}" required/>
                  <!-- <select id="Categories" class="select">
                    <option value="hide">All Categories</option>
                    <option value="all categories">All Categories</option>
                    <option value="uncategorized">uncategorized</option>
                    <option value="schoolLevel">School Level</option>
                    <option value="one">One</option>
                    <option value="two">two</option>
                    <option value="three">three</option>
                    <option value="four">four</option>
                    <option value="five">five</option>
                    <option value="six">six</option>
                    <option value="seven">seven</option>
                    <option value="eight">eight</option>
                    <option value="nine">nine</option>
                    <option value="ten">ten</option>
                    <option value="ten">ten</option>
                    <option value="MBBS">MBBS</option>
                    <option value="BCA">BCA</option>
                    <option value="BBS">BBS</option>
                  </select> -->
                  <div class="delete__search">
                <i class="fas fa-times"></i>
                </div>
                  <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>
              </form>
            </a>
          </div>
        </nav>
      </section>
        @yield('content')
    </div>

    <footer class="footer utility-padding">
      <div class="logo--holder">
        <a href="#" class="logo-link">
          <img src="{{ asset('site/img/asmita.png')}}" alt="" />
        </a>
        <p>&#169; 2020.All Rights Reserved</p>
      </div>
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
          <div class="social-links youtube">
            <a href="">
              <i class="fab fa-youtube icon"></i>
            </a>
          </div>
          <div class="social-links instagram">
            <a href="">
              <i class="fab fa-instagram-square icon"></i>
            </a>
          </div>
        </div>
        <!-- <button class="btn-top">
          <i class="fas fa-chevron-up"></i>
        </button> -->
      </div>
    </footer>
    <!-- <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
      defer
    ></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
      defer
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
      defer
    ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('site/js/searchSelect.js')}}" defer></script>
    <script src="{{ asset('site/js/navigationFixed.js')}}" defer></script>
    @yield('scripts')
    
    <script>
      @if (\Illuminate\Support\Facades\App::environment('production'))
        // The environment is production

        document.onkeydown = function(e) {
          if(event.keyCode == 123) {
            console.log('You cannot inspect Element');
            return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            console.log('You cannot inspect Element');
            return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
            console.log('You cannot inspect Element');
            return false;
          }
          if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            console.log('You cannot inspect Element');
            return false;
          }
          if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            console.log('You cannot inspect Element');
            return false;
          }
          if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
            console.log('You cannot inspect Element');
            return false;
          }
          // if(e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80 ){
          //   console.log('You cannot inspect Element');
          //   return false;
          // }
        }

        // prevents right clicking
        document.addEventListener('contextmenu', e => e.preventDefault());
        document.addEventListener("keydown", function(e) {
          if (e.key === 's' && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
            e.preventDefault();
          }
        }, false);

      @endif
    </script>
  </body>
</html>
