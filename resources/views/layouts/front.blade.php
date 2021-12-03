<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ trans('panel.site_title') }}</title>

  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
  <link href="{{ asset('css/shop-homepage.css') }}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}">{{ trans('panel.site_title') }}</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">{{ trans('panel.site_title') }}</h1>
        <ul class="list-group" id="categories">
          @foreach($frontCategories as $parentCategory)
            <li class="list-group-item" data-id="{{ $parentCategory->id }}">
              <i class="fa fa-arrow-right"></i>
              <a href="{{ route('category', [$parentCategory]) }}">{{ $parentCategory->name }} </a>
            </li>
            @if($parentCategory->childCategories->count())
              <div class="list-second-level" data-id="{{ $parentCategory->id }}" style="display:none;">
                @foreach($parentCategory->childCategories as $category)
                  <li class="list-group-item" data-id="{{ $category->id }}">
                    <i class="fa fa-arrow-right"></i>
                    <a href="{{ route('category', [$parentCategory, $category]) }}">{{ $category->name }} </a>
                  </li>
                  @if($category->childCategories->count())
                    <div class="list-third-level" data-id="{{ $category->id }}" style="display:none;">
                      @foreach($category->childCategories as $childCategory)
                        <li class="list-group-item" data-id="{{ $childCategory->id }}">
                          <i class="fa fa-arrow-right"></i>
                          <a href="{{ route('category', [$parentCategory, $category, $childCategory->slug]) }}">{{ $childCategory->name }} </a>
                        </li>
                        @if($childCategory->childCategories->count())
                          <div class="list-fourth-level" data-id="{{ $childCategory->id }}" style="display:none;">
                            @foreach($childCategory->childCategories as $subCategory)
                            <a
                              href="{{ route('category', [$parentCategory, $category, $childCategory->slug, $subCategory->slug]) }}"
                              class="list-group-item{{ $loop->last ? ' mb-1' : '' }}"
                              data-id="{{ $subCategory->id }}"
                            >
                              {{ $subCategory->name }} 
                            </a>
                            @endforeach
                          </div>
                        @endif
                      @endforeach
                  </div>
                  @endif
                @endforeach
              </div>
            @endif
          @endforeach
        </ul>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        @yield('content')

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; {{ trans('panel.site_title') }} {{ date('Y') }}</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    $(function () {
      $('#categories li').click(function () {
        var $this = $(this);
        var id = $this.data('id');

        // Collapse siblings
        $this.siblings('li[data-id!="' + id + '"]').children('i').addClass('fa-arrow-right').removeClass('fa-arrow-down');
        $this.siblings('div[data-id!="' + id + '"]').hide();

        $this.children('i').toggleClass('fa-arrow-right').toggleClass('fa-arrow-down');
        $this.siblings('div[data-id="' + id + '"]').toggle();
      });

      @if(isset($selectedCategories))
        @foreach($selectedCategories as $selected)
          @if($loop->index < 3)
            $('#categories .list-group-item[data-id="{{ $selected }}"]').click();
          @endif
          @if($loop->last)
            $('#categories .list-group-item[data-id="{{ $selected }}"]').toggleClass('active');
          @endif
        @endforeach
      @endif
    });
  </script>
</body>
<script>
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
}
// prevents right clicking
document.addEventListener('contextmenu', e => e.preventDefault());
</script>
</html>
