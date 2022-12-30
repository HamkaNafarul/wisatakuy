<!--

=========================================================
* Volt Free - Bootstrap 5 Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)
* License (https://themesberg.com/licensing)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal.

-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Primary Meta Tags -->
    <title>@yield('layout_title') | {{ config('app.name') }}</title>

    <!-- Favicon -->
    {{-- <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/favicon/apple-touch-icon.png"> --}}
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/brand/holiyou.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/brand/holiyou.png">
    <link rel="manifest" href="/assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="/vendor/notyf/notyf.min.css" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="/css/volt.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link type="text/css" href="/vendor/fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Leaflet -->
    <link type="text/css" href="/vendor/leaflet/leaflet.css" rel="stylesheet">

    <!-- Data Tables -->
    <link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link type="text/css" href="/css/app.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->


    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="{{ route('admin-page') }}">
            <img class="navbar-brand-dark" src="/assets/img/brand/light.svg" alt="Volt logo" /> <img
                class="navbar-brand-light" src="/assets/img/brand/dark.svg" alt="Volt logo" />
        </a>
        <div class="d-flex align-items-center">
            <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
        <div class="sidebar-inner px-4 pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                <div class="d-flex align-items-center">
                    <div class="avatar-lg me-4">
                        <img src="/assets/img/team/profile-picture-3.jpg"
                            class="card-img-top rounded-circle border-white" alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="d-block">
                        <h2 class="h5 mb-3">Hi, {{ Auth::user()->name }}</h2>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                                <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
                <div class="collapse-close d-md-none">
                    <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                        <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <a href="{{ route('index') }}" class="nav-link d-flex align-items-center">
                        <span class="sidebar-icon">
                            <img src="/assets/img/brand/holiyou.png" height="30" width="30" alt="Volt Logo">
                        </span>
                        <span class="mt-1 ms-1 sidebar-text">WISATAKUY</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : '' }}">
                    <a href="{{ route('admin-page') }}" class="nav-link">
                        <span class="sidebar-icon">
                            <i class="fas fa-chart-pie"></i>
                        </span>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <span class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-app">
                        <span>
                            <span class="sidebar-icon"><i class="fas fa-igloo"></i></span>
                            <span class="sidebar-text">Objek Wisata</span>
                        </span>
                        <span class="link-arrow"><i class="fas fa-arrow-right"></i></span>
                    </span>
                    <div class="multi-level collapse hide" role="list" id="submenu-app" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('kategori.index') }}">
                                    <span class="sidebar-text">Kategori</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pariwisata.index') }}">
                                    <span class="sidebar-text">Daftar Wisata</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="nav-item {{ (request()->is('dashboard/kategori*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('kategori.index') }}">
                        <span class="sidebar-icon">
                            <i class="fas fa-water"></i>
                        </span>
                        <span class="sidebar-text">Kategori</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('dashboard/kecamatan*')) ? 'active' : '' }}">
                    <a href="{{ route('kecamatan.index') }}" class="nav-link">
                        <span class="sidebar-icon">
                            <i class="fas fa-landmark"></i>
                        </span>
                        <span class="sidebar-text">Kecamatan</span>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('dashboard/pariwisata*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pariwisata.index') }}">
                        <span class="sidebar-icon">
                            <i class="fas fa-igloo"></i>
                        </span>
                        <span class="sidebar-text">Objek Wisata</span>
                    </a>
                </li>
                <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
                <li class="nav-item {{ (request()->is('dashboard/user*')) ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('user.index')}}">
                        <span class="sidebar-icon">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="sidebar-text">Pengguna</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content d-flex flex-column min-vh-100">

        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">
                    </div>
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown ms-lg-3">
                            <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="media d-flex align-items-center">
                                    <img class="avatar rounded-circle" alt="Image placeholder"
                                        src="/assets/img/team/profile-picture-3.jpg">
                                    <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                        <span
                                            class="mb-0 font-small fw-bold text-gray-900">{{ Auth::user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    My Profile
                                </a>
                                <div role="separator" class="dropdown-divider my-1"></div>
                                <form action="{{ route('logout') }}" method="get">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                        <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('layout_content')

        <footer class="bg-white rounded shadow mb-4 mt-auto" >
            <div class="row">
                {{-- <div class="col-12 mb-4 mb-md-0">
                    <p class="mb-0 text-end">©2021. Made with <i class="fas fa-heart text-danger"></i> by
                        {{ config('app.name') }} Team.</p>
                </div> --}}

                <footer class="text-center text-lg-start bg-dark text-white">
  <!-- Section: Social media -->
  <section
    class="d-flex justify-content-center justify-content-lg-between p-2 mt-1 border-bottom"
  >
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>

      <a href="" class="me-1 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-1 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-1 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-1 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-1 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
    </div>
    <!-- Left -->

    <!-- Right -->
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>WISATAKUY
          </h6>
          <p>
            Website yang bergerak di bidang pariwisata. Yang memiliki fitur untuk memesan tiket secara online dan
           bisa mendapat informasi destinasi wisata di Malang Raya.
          </p>
        </div>
        <img src="" width="" alt="">
        <!-- Grid column -->

        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fa-regular fa-circle-user"></i>
            Contact
          </h6>
          <p><i class="fas fa-home me-2"></i> Malang, ML 1102, INDONESIA</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            wisatakuy@gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 0341 5943</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2022 Copyright:
    <a class="text-reset fw-bold" href="https://mdbootstrap.com/">WISATAKUY</a>
  </div>
  <!-- Copyright -->
</footer>
    <!-- Core -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Vendor JS -->
    <script src="/vendor/onscreen/dist/on-screen.umd.min.js"></script>

    <!-- Slider -->
    <script src="/vendor/nouislider/dist/nouislider.min.js"></script>

    <!-- Smooth scroll -->
    <script src="/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

    <!-- Charts -->
    <script src="/vendor/chartist/dist/chartist.min.js"></script>
    <script src="/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

    <!-- Datepicker -->
    <script src="/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Sweet Alerts 2 -->
    <script src="/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

    <!-- Vanilla JS Datepicker -->
    <script src="/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

    <!-- Notyf -->
    <script src="/vendor/notyf/notyf.min.js"></script>

    <!-- Simplebar -->
    <script src="/vendor/simplebar/dist/simplebar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Volt JS -->
    <script src="/assets/js/volt.js"></script>

    <!-- Font Awesome -->
    <script src="/vendor/fontawesome/js/all.min.js"></script>

    <!-- Leaflet -->
    <script src="/vendor/leaflet/leaflet.js"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Data Tables -->
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <!-- CKEditor -->
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token='+document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='+document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };
    </script>
    <script>
        CKEDITOR.replace('my-editor', options);
    </script>

    @yield('layout_script')
</body>

</html>
