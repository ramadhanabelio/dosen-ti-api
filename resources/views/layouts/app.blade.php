<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dosen Teknik Informatika POLBENG | @yield('title')</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" />
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon" />
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />
    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet" />
    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="" class="logo d-flex align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo POLBENG" class="me-3" />
                <span class="d-none d-lg-block">Dosen TI POLBENG</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ asset('img/default.png') }}" alt="Profile" class="rounded-circle" />
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a>
                    <!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->email }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Keluar</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    <!-- End Profile Dropdown Items -->
                </li>
                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->
    </header>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}"
                    href="{{ route('dashboard') }}">
                    <i class="bi bi-house{{ request()->routeIs('dashboard') ? '-fill' : '' }}"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Manajemen Dosen -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('lecturers.*') ? '' : 'collapsed' }}"
                    data-bs-toggle="collapse" href="#lecturerMenu">
                    <i class="bi bi-person{{ request()->routeIs('lecturers.*') ? '-fill' : '' }}"></i>
                    <span>Manajemen Dosen</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <div class="collapse {{ request()->routeIs('lecturers.*') ? 'show' : '' }}" id="lecturerMenu">
                    <ul class="nav-content">
                        <li>
                            <a href="{{ route('lecturers.index') }}"
                                class="{{ request()->routeIs('lecturers.index') ? 'active' : '' }}">
                                <i
                                    class="bi bi-plus-circle{{ request()->routeIs('lecturers.index') ? '-fill' : '' }}"></i>
                                <span>Daftar Dosen</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('lecturers.create') }}"
                                class="{{ request()->routeIs('lecturers.create') ? 'active' : '' }}">
                                <i
                                    class="bi bi-plus-circle{{ request()->routeIs('lecturers.create') ? '-fill' : '' }}"></i>
                                <span>Tambah Dosen</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar -->

    <main id="main" class="main">
        @yield('content')
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Dosen TI</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by
            <a href="" target="_blank">Kelompok</a>
        </div>
    </footer>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
