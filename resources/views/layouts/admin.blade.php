<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ($setting)?$setting->title:trans('panel.site_title') }}</title>
    @if(isset($setting))
    <link rel="shortcut icon" href="{{asset('storage/uploads/favicon/'.$setting->favicon)}}">
    @endif
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@2.1.16/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4194655f1d.js" crossorigin="anonymous"></script>

    <style>
      img[data-dz-thumbnail] {
          width: 100%;
          height: 100%;
          object-fit: cover;
      }
      .view-site {
        display: flex;
        align-items: center;
        gap: .4rem;
      }

      .chip.ml-3{
        display: none;
      }

      .custom__align{
          margin-right: 8px
        }

      @media (max-width: 400px){
        .view__site-container{
          position: absolute !important;
          right: 8px;
          bottom: 6px;
        }

        .app-header{
          height: 120px;
        }

        .app-header .navbar-nav .dropdown-menu-right{
          right: -77px;
        }

        .app-body{
          margin-top: 120px;
        }


      }

      .view-site i {
        font-size: .8rem;
      }

      .view-site:hover, 
      .view-site:hover i {
        color: blue !important;
      }

      .dropdown-menu .notification{
        overflow: hidden;
        white-space: inherit;
      }

    .dropdown-divider{
      display: none;
    }

    .dropdown-footer{
      background-color: #f0f3f5;
    }


    .sidebar .nav-dropdown-toggle::before{
      display: none !important;
    }

    .sidebar .nav-dropdown-toggle{
      display: flex !important;
      align-items: center !important;
    }

    .sidebar .nav-dropdown-toggle .fa-chevron-left{
      transition: all .3s;
      font-size: .8rem !important;
    }

    .sidebar .nav-dropdown-toggle span{
      flex: 1 !important;
      height: 15px;
      display: flex; 
    align-items: center;
    }

    .nav-dropdown-toggle.open .fa-chevron-left{
      transform: rotate(-90deg);
      transition: transform .3s;
    }
    </style>
    @yield('styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show" style="margin-right: 0 !important">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
          @if(isset($setting))
            <img class="navbar-brand-full" src="{{asset('storage/uploads/logo/'.$setting->logo)}}" alt="{{$setting->title}}" width="50">
            <img class="navbar-brand-minimized" src="{{asset('storage/uploads/favicon/'.$setting->favicon)}}" alt="{{$setting->title}}" width="40">
          @else 
            <span class="navbar-brand-full">{{ trans('panel.site_title') }}</span>
            <span class="navbar-brand-minimized">{{ trans('panel.site_title') }}</span>
          @endif
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show" >
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <ul class="nav navbar-nav ml-2">
          <li class="nav-item view__site-container">
              <a class="nav-link view-site" href="{{config('panel.homepage')}}" role="button" target="_blank">
                  View Site 
                  <i class="fas fa-share"></i>
              </a>
          </li>
        </ul>

        <ul class="nav navbar-nav ml-auto">
            @if(count(config('panel.available_languages', [])) > 1)
                <li class="nav-item dropdown d-md-down-none">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(config('panel.available_languages') as $langLocale => $langName)
                            <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                        @endforeach
                    </div>
                </li>
            @endif

        </ul>

        <ul class="navbar-nav ml-auto notification-nav">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <!-- <img src="{{asset('bell.png')}}" style="width: 1.6rem;"><span class="badge badge-danger navbar-badge notification-count"></span> -->
              <i class="fas fa-bell"></i><span class="badge badge-danger navbar-badge notification-count"></span>
            </a>
            <div class="dropdown-menu notification-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">15 Notifications</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
          </li>
        </ul>
        <div class="dropdown d-flex custom__align">
          <div class="align d-flex align-items-center">
            <span class="admin-name">Hi, {{Auth::user()->name}}</span>
            <a href="javascript:void(0)" class="chip ml-3" data-toggle="dropdown" aria-expanded="false">
              <span class="avatar" style="
                    background-image: url({{asset('User.png')}});
                    background-size: cover;
                  "></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="
                  position: absolute;
                  transform: translate3d(0px, 50px, 0px);
                  top: 0px;
                  left: 0px;
                  will-change: transform;
                ">
              {{-- <a class="dropdown-item" href="page-profile.html"><i class="dropdown-icon fe fe-user"></i> Profile</a>
              <a class="dropdown-item" href="app-setting.html"><i class="dropdown-icon fe fe-settings"></i> Settings</a>
              <a class="dropdown-item" href="app-email.html"><span class="float-right"><span
                    class="badge badge-primary">6</span></span><i class="dropdown-icon fe fe-mail"></i> Inbox</a>
              <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-send"></i> Message</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fe fe-help-circle"></i> Need
                help?</a> --}}
              <a class="dropdown-item" href="{{route('logout')}}"><i class="dropdown-icon fe fe-log-out"></i> Sign out</a>
            </div>
          </div>
        </div>
    </header>

    <div class="app-body">
        @include('partials.menu')
        <main class="main">


            <div style="padding-top: 20px; background: #f5f9fc !important; height: 100%" class="container-fluid">
                @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12" id="message">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                @endif
                @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')

            </div>


        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


    <script src="{{ asset('js/main.js') }}"></script>
    
    <script>
        $(function() {
          let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
          let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
          let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
          let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
          let printButtonTrans = '{{ trans('global.datatables.print') }}'
          let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
          let selectAllButtonTrans = '{{ trans('global.select_all') }}'
          let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

          let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
          };

          $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
          $.extend(true, $.fn.dataTable.defaults, {
            language: {
              url: languages['{{ app()->getLocale() }}']
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
              style:    'multi+shift',
              selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
              {
                extend: 'selectAll',
                className: 'btn-primary',
                text: selectAllButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'selectNone',
                className: 'btn-primary',
                text: selectNoneButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'copy',
                className: 'btn-default',
                text: copyButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'csv',
                className: 'btn-default',
                text: csvButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'excel',
                className: 'btn-default',
                text: excelButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'pdf',
                className: 'btn-default',
                text: pdfButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'print',
                className: 'btn-default',
                text: printButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              },
              {
                extend: 'colvis',
                className: 'btn-default',
                text: colvisButtonTrans,
                exportOptions: {
                  columns: ':visible'
                }
              }
            ]
          });

          $.fn.dataTable.ext.classes.sPageButton = '';


          // for notification
          function get_notification() {
              $.ajax({
              type: 'GET'
              , url: "{{ route('admin.get_notifications') }}"
              ,success: function(data) {
                if(data.length == 0){
                  $('.notification-menu').html(`
                      <span class="dropdown-item dropdown-header">No Notification</span>
                  `);
                } else {
                  $('.notification-menu').html('');
                  $('.notification-count').text(data.length);
                  $.each(data,function(i,ele){
                      $('.notification-menu').append(`
                              <a href="${"{{ route('admin.show_notifications','temp_id') }}".replace('temp_id',ele.id)}" class="dropdown-item notification">
                                  <p><i class="fas fa-envelope mr-2"></i>${ele.data.message}</p>
                                  <span class="float-right text-muted text-sm">${moment(ele.created_at).fromNow()}</span>
                              </a>
                          <div class="dropdown-divider"></div>
                      `);
                  });
                  $('.notification-menu').append('<div class="dropdown-divider"></div><a href="{{ route("admin.read_all_notifications") }}" class="dropdown-item read-notification dropdown-footer">Mark all as read</a>');
                }
              }
            });
          }
          get_notification();
          setInterval(get_notification, 300000);
        });

    </script>
    @yield('scripts')
    <script>
      $('#message').delay(5000).slideUp(300);
     
    </script>
    <script defer>
      const navElements =  document.querySelectorAll('.nav-dropdown');
      navElements.forEach((element) => {
        element.addEventListener('click', function(e){
          const dropDownElement = e.target.closest('.nav-item');
           // console.log(dropDownElement, 'test');

          if (!dropDownElement) return;

          if(dropDownElement.classList.contains('open')){

            dropDownElement.classList.remove('open');
          } else{
            dropDownElement.classList.add('open');
          }

        });
      })
    </script>
</body>

</html>