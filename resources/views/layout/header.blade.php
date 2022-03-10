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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
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
            <ul class="navbar-nav navbar-right">
                <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                        <div class="dropdown-header">Notifications
                            <div class="float-right">
                                <a href="#">Mark All As Read</a>
                            </div>
                        </div>
                        <div class="dropdown-list-content dropdown-list-icons">
                            <a href="#" class="dropdown-item dropdown-item-unread">
                                <div class="dropdown-item-icon bg-primary text-white">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Template update is available now!
                                    <div class="time text-primary">2 Min Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-info text-white">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                    <div class="time">10 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-success text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                    <div class="time">12 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-danger text-white">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Low disk space. Let's clean it!
                                    <div class="time">17 Hours Ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item">
                                <div class="dropdown-item-icon bg-info text-white">
                                    <i class="fas fa-bell"></i>
                                </div>
                                <div class="dropdown-item-desc">
                                    Welcome to Stisla template!
                                    <div class="time">Yesterday</div>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer text-center">
                            <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li>
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ request()->session()->get('user')->photo }}" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ request()->session()->get('user')->name }}</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Logged in 5 min ago</div>
                        <a href="features-profile.html" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('/user/logout') }}" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.html">Sinlab</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html">St</a>
                </div>

                <ul class="sidebar-menu">
                    <li class="menu-header">Dashboard</li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                            <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="menu-header">Halaman Inventaris</li>
                    <li class="active"><a class="nav-link" href="{{ url('item') }}"><i class="fa fa-box"></i> <span>Daftar Barang</span></a></li>

            </aside>
        </div>
