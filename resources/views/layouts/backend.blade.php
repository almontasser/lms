<!doctype html>
<html lang="{{ config('app.locale') }}" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <title>مكتبة كلية التقنية الصناعية مصراته</title>

  <meta name="description"
    content="OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
  <meta name="author" content="pixelcave">
  <meta name="robots" content="noindex, nofollow">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Icons -->
  <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
  <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

  <!-- Fonts and Styles -->
  @yield('css_before')
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" id="css-main" href="{{ mix('/css/oneui.css') }}">

  <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
  <!-- <link rel="stylesheet" id="css-theme" href="{{ mix('/css/themes/amethyst.css') }}"> -->
  @yield('css_after')

  <!-- Scripts -->
  <script>
    window.Laravel = {
            'csrfToken': '{{ csrf_token() }}'
        };

  </script>

</head>

<body>
  {{-- Page Loader --}}
  <div id="page-loader" class="show"></div>

  <div id="page-container"
    class="rtl-support sidebar-r sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">

    <nav id="sidebar" aria-label="Main Navigation">
      <!-- Side Header -->
      <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual text-center" style="width: 100%; text-align: center;" href="/">
          <img src="{{ asset('media/cit-logo.png') }}"
            style="background-color: white; border-radius: 50%; padding: 4px; width: 80px; height: 80px; object-fit: contain; display: block; margin: 0 auto;"
            alt="">
          <span class="smini-visible">
            <img src="{{ asset('media/cit-logo.png') }}"
              style="background-color: white; border-radius: 50%; padding: 4px; width: 24px;" alt="">
          </span>
          <span class="smini-hide font-size-h5 tracking-wider text-center"
            style="padding-top: 8px; display:inline-block;">
            مكتبة كلية التقنية الصناعية مصراته
          </span>
        </a>
        <!-- END Logo -->
        <!-- Extra -->
        <div>
          <!-- Close Sidebar, Visible only on mobile screens -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <a class="d-lg-none btn btn-sm btn-dual mr-1" data-toggle="layout" data-action="sidebar_close"
            href="javascript:void(0)">
            <i class="fa fa-fw fa-times"></i>
          </a>
          <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
      </div>
      <!-- END Side Header -->

      <!-- Sidebar Scrolling -->
      <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
          <ul class="nav-main">
            <li class="nav-main-item">
              <a class="nav-main-link{{ request()->is('/') ? ' active' : '' }}" href="{{ route('home') }}">
                <i class="nav-main-link-icon si si-cursor"></i>
                <span class="nav-main-link-name">الرئيسية</span>
              </a>
            </li>
            <li class="nav-main-heading">المكتبة</li>

            @isAdmin()
            <li class="nav-main-item{{ request()->is('books/*') ? ' open' : '' }}">
              <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="true" href=" #">
                <i class="nav-main-link-icon si si-book-open"></i>
                <span class="nav-main-link-name">الكتب</span>
              </a>
              <ul class="nav-main-submenu">
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('books/list') ? ' active' : '' }}"
                    href="{{ route('books-list') }}">
                    <span class="nav-main-link-name">عرض الكتب</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('books/index') ? ' active' : '' }}"
                    href="{{ route('books') }}">
                    <span class="nav-main-link-name">قائمة الكتب</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('books/insert') ? ' active' : '' }}"
                    href="{{ route('books-insert') }}">
                    <span class="nav-main-link-name">إضافة كتاب</span>
                  </a>
                </li>
              </ul>
            </li>
            @_else()
            <li class="nav-main-item open">
              <a class="nav-main-link" href="{{ route('books-list') }}">
                <i class="nav-main-link-icon si si-book-open"></i>
                <span class="nav-main-link-name">الكتب</span>
              </a>
            </li>
            @endisAdmin()

            @isAdmin()
            <li class="nav-main-item{{ request()->is('papers/*') ? ' open' : '' }}">
              <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="true" href=" #">
                <i class="nav-main-link-icon si si-book-open"></i>
                <span class="nav-main-link-name">الأوراق البحثية</span>
              </a>
              <ul class="nav-main-submenu">
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('papers/list') ? ' active' : '' }}"
                    href="{{ route('papers-list') }}">
                    <span class="nav-main-link-name">عرض الأوراق البحثية</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('papers/index') ? ' active' : '' }}"
                    href="{{ route('papers') }}">
                    <span class="nav-main-link-name">قائمة الأوراق البحثية</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('papers/insert') ? ' active' : '' }}"
                    href="{{ route('paper-insert') }}">
                    <span class="nav-main-link-name">إضافة ورقة بحثية</span>
                  </a>
                </li>
              </ul>
            </li>
            @_else()
            <li class="nav-main-item open">
              <a class="nav-main-link" href="{{ route('papers-list') }}">
                <i class="nav-main-link-icon si si-doc"></i>
                <span class="nav-main-link-name">الأوراق البحثية</span>
              </a>
            </li>
            @endisAdmin()

            @isAdmin()
            <li class="nav-main-item{{ request()->is('projects/*') ? ' open' : '' }}">
              <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="true" href=" #">
                <i class="nav-main-link-icon si si-book-open"></i>
                <span class="nav-main-link-name">المشاريع</span>
              </a>
              <ul class="nav-main-submenu">
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('projects/list') ? ' active' : '' }}"
                    href="{{ route('projects-list') }}">
                    <span class="nav-main-link-name">عرض المشاريع</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('projects/index') ? ' active' : '' }}"
                    href="{{ route('projects') }}">
                    <span class="nav-main-link-name">قائمة المشاريع</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('projects/insert') ? ' active' : '' }}"
                    href="{{ route('project-insert') }}">
                    <span class="nav-main-link-name">إضافة مشروع</span>
                  </a>
                </li>
              </ul>
            </li>
            @_else()
            <li class="nav-main-item open">
              <a class="nav-main-link" href="{{ route('projects-list') }}">
                <i class="nav-main-link-icon si si-doc"></i>
                <span class="nav-main-link-name">المشاريع</span>
              </a>
            </li>
            @endisAdmin()

            @isAdmin()
            <li class="nav-main-heading">الإدارة</li>
            <li class="nav-main-item{{ request()->is('users/*') ? ' open' : '' }}">
              <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                aria-expanded="true" href="#">
                <i class="nav-main-link-icon si si-user"></i>
                <span class="nav-main-link-name">المستخدمين</span>
              </a>
              <ul class="nav-main-submenu">
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('users/index') ? ' active' : '' }}"
                    href="{{ route('users') }}">
                    <span class="nav-main-link-name">لوحة المعلومات</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('users/registrations') ? ' active' : '' }}"
                    href="{{ route('users-registrations') }}">
                    <span class="nav-main-link-name">طلبات التسجيل</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('users/list') ? ' active' : '' }}"
                    href="{{ route('users-list') }}">
                    <span class="nav-main-link-name">قائمة المستخدمين</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('users/insert') ? ' active' : '' }}"
                    href="{{ route('users-insert') }}">
                    <span class="nav-main-link-name">إضافة مستخدم</span>
                  </a>
                </li>
                <li class="nav-main-item">
                  <a class="nav-main-link{{ request()->is('users/import') ? ' active' : '' }}"
                    href="{{ route('users-import') }}">
                    <span class="nav-main-link-name">إستيراد بيانات الطلبة</span>
                  </a>
                </li>
              </ul>
            </li>
            @endisAdmin()
          </ul>
        </div>
        <!-- END Side Navigation -->
      </div>
      <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
      <!-- Header Content -->
      <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
          <!-- Toggle Sidebar -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
          <button type="button" class="btn btn-sm btn-dual ml-2 d-lg-none" data-toggle="layout"
            data-action="sidebar_toggle">
            <i class="fa fa-fw fa-bars"></i>
          </button>
          <!-- END Toggle Sidebar -->

          <!-- Open Search Section (visible on smaller screens) -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout"
            data-action="header_search_on">
            <i class="fa fa-fw fa-search"></i>
          </button>
          <!-- END Open Search Section -->

          <!-- Search Form (visible on larger screens) -->
          <form class="d-none d-sm-inline-block" action="{{ route('search') }}" method="GET">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control form-control-alt" placeholder="بحث..."
                id="search" name="s" value="{{app('request')->input('s')}}">
              <div class="input-group-append">
                <span class="input-group-text bg-body border-0">
                  <i class="fa fa-fw fa-search"></i>
                </span>
              </div>
            </div>
          </form>
          <!-- END Search Form -->
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-flex align-items-center">
          <!-- User Dropdown -->
          @auth
          <div class="dropdown d-inline-block ml-2">
            <button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="rounded-circle" src="{{Auth::user()->getPicture()}}" alt="Header Avatar" style="width: 21px;">
              <span class="d-none d-sm-inline-block mr-2">{{ Auth::user()->name }}</span>
              <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block mr-1 mt-1"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0"
              aria-labelledby="page-header-user-dropdown">
              <div class="p-3 text-center bg-primary-dark rounded-top">
                <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{Auth::user()->getPicture()}}" alt="">
                <p class="mt-2 mb-0 text-white font-w500">{{ Auth::user()->name }}</p>
                <p class="mb-0 text-white-50 font-size-sm">{{ Auth::user()->position }}</p>
              </div>
              <div class="p-2">
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                  <span class="font-size-sm font-w500">صندوق الرسائل</span>
                  <span class="badge badge-pill badge-primary mr-2">3</span>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                  <span class="font-size-sm font-w500">البروفايل</span>
                  <span class="badge badge-pill badge-primary mr-2">1</span>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                  <span class="font-size-sm font-w500">الإعدادت</span>
                </a>
                <div role="separator" class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  @method('delete')
                  <button class="dropdown-item d-flex align-items-center justify-content-between" type="submit">
                    <span class="font-size-sm font-w500">تسجيل الخروج</span>
                  </button>
                </form>
              </div>
            </div>
          </div>
          @else
          <div class="dropdown d-inline-block ml-2">
            <a class="btn btn-primary btn-sm d-flex align-items-center" id="page-header-login"
              href="{{ route('login') }}">
              <span class="d-sm-inline-block">تسجيل الدخول</span>
            </a>
          </div>
          <div class="dropdown d-inline-block ml-2">
            <a class="btn btn-primary btn-sm d-flex align-items-center" id="page-header-login"
              href="{{ route('register') }}">
              <span class="d-sm-inline-block">إنشاء حساب</span>
            </a>
          </div>
          @endauth
          <!-- END User Dropdown -->

          <!-- Notifications Dropdown -->
          {{-- <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="text-primary">•</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-2 bg-primary-dark text-center rounded-top">
                        <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>
                    </div>
                    <ul class="nav-items mb-0">
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="ml-2 ml-3">
                                    <i class="fa fa-fw fa-check-circle text-success"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">You have a new follower</div>
                                    <span class="font-w500 text-muted">15 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="ml-2 ml-3">
                                    <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">1 new sale, keep it up</div>
                                    <span class="font-w500 text-muted">22 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="ml-2 ml-3">
                                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">Update failed, restart server</div>
                                    <span class="font-w500 text-muted">26 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="ml-2 ml-3">
                                    <i class="fa fa-fw fa-plus-circle text-primary"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">2 new sales, keep it up</div>
                                    <span class="font-w500 text-muted">33 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="ml-2 ml-3">
                                    <i class="fa fa-fw fa-user-plus text-success"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">You have a new subscriber</div>
                                    <span class="font-w500 text-muted">41 min ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="ml-2 ml-3">
                                    <i class="fa fa-fw fa-check-circle text-success"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">You have a new follower</div>
                                    <span class="font-w500 text-muted">42 min ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
                            <i class="fa fa-fw fa-arrow-down ml-1"></i> Load More..
                        </a>
                    </div>
                </div>
            </div> --}}
          <!-- END Notifications Dropdown -->
        </div>
        <!-- END Right Section -->
      </div>
      <!-- END Header Content -->

      <!-- Header Search -->
      <div id="page-header-search" class="overlay-header bg-white">
        <div class="content-header">
          <form class="w-100" action="/dashboard" method="POST">
            @csrf
            <div class="input-group">
              <div class="input-group-prepend">
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
                  <i class="fa fa-fw fa-times-circle"></i>
                </button>
              </div>
              <input type="text" class="form-control" placeholder="بحث..." id="page-header-search-input"
                name="page-header-search-input">
            </div>
          </form>
        </div>
      </div>
      <!-- END Header Search -->

      <!-- Header Loader -->
      <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
      <div id="page-header-loader" class="overlay-header bg-white">
        <div class="content-header">
          <div class="w-100 text-center">
            <i class="fa fa-fw fa-circle-notch fa-spin"></i>
          </div>
        </div>
      </div>
      <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
      @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
      <div class="content py-3">
        <div class="row font-size-sm">
          <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
            برمجة وتصميم <i class="fa fa-heart text-danger"></i> <a class="font-w600"
              href="https://fb.me/MahmoudAlmontasser" target="_blank">محمود المنتصر</a>
          </div>
          <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
            <a class="font-w600" href="https://facebook.com/كلية-التقنية-الصناعية-مصراتة-309978059153182/"
              target="_blank">كلية التقنية
              الصناعية</a> &copy; <span data-toggle="year-copy"></span>
          </div>
        </div>
      </div>
    </footer>
    <!-- END Footer -->

    <x-barcode-input-modal />
  </div>
  <!-- END Page Container -->

  <!-- OneUI Core JS -->
  <script src="{{ mix('js/oneui.app.js') }}"></script>

  <script src="{{asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
  @yield('js_after')
</body>

</html>
