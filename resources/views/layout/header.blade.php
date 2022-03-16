<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.png') }}">
    <title>Dashboard | {{ $title }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Template CSS -->

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select.bootstrap4.min.css') }}">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <a style="margin-top: 30px" href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ request()->session()->get('user')->photo }}" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ request()->session()->get('user')->name }}</div>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ url('/user/profile') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ url('/user/logout') }}" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </nav>

            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href={{ url('/') }}>Sinlab</a>
                    </div>

                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ url('/') }}">SL</a>
                    </div>

                    <ul class="sidebar-menu">
                        @if (auth()->user()->role == 'super_user')
                        <li class="menu-header">Menu Utama</li>
                        <li class="active">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="fas fa-chart-bar"></i>
                                <span>Halaman Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ url('admin/user') }}">
                                <i class="fas fa-users"></i>
                                <span>Daftar Pengguna</span>
                            </a>
                        </li>

                        <li class="menu-header">Menu Inventaris</li>
                        <li>
                            <a class="nav-link" href="{{ url('admin/item') }}">
                                <i class="fas fa-box"></i>
                                <span>Inventaris Barang</span>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ url('admin/transaction') }}">
                                <i class="fas fa-book"></i>
                                <span>Peminjaman Barang</span>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ url('admin/request') }}">
                                <i class="fas fa-comment"></i>
                                <span>Permintaan Barang</span>
                            </a>
                        </li>
                        @elseif(auth()->user()->role == 'user')
                        <li class="menu-header">Menu Peminjaman</li>
                        <li class="active">
                            <a class="nav-link" href="{{ url('item') }}">
                                <i class="fas fa-box"></i>
                                <span>Daftar Inventaris</span>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ url('transaction') }}">
                                <i class="fas fa-book"></i>
                                <span>Halaman Peminjaman</span>
                            </a>
                        </li>

                        <li>
                            <a class="nav-link" href="{{ url('request') }}">
                                <i class="fas fa-comment"></i>
                                <span>Permintaan Barang</span>
                            </a>
                        </li>
                        @else
                        <li class="menu-header">Menu Peminjaman</li>
                        <li class="active">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="fas fa-box"></i>
                                <span>Daftar Inventaris</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ url('transaction') }}">
                                <i class="fas fa-book"></i>
                                <span>Halaman Peminjaman</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </aside>
            </div>