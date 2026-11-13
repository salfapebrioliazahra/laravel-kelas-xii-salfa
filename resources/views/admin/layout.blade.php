<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard') - OneMovies Admin</title>
  <link rel="stylesheet" href="{{ asset('template/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('template/css/font-awesome.min.css') }}">
  <style>
    body {
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
      background-color: #f4f6f9;
      color: #333;
      padding-top: 60px;
    }
    .navbar-admin {
      background-color: #212121;
      border: none;
      border-radius: 0;
      border-bottom: 3px solid #FF8D1B;
      margin-bottom: 0;
    }
    .navbar-admin .navbar-brand {
      color: #fff;
      font-weight: bold;
      font-size: 20px;
    }
    .navbar-admin .navbar-brand span {
      color: #FF8D1B;
    }
    .navbar-admin .navbar-nav > li > a {
      color: #eee;
    }
    .navbar-admin .navbar-nav > li > a:hover {
      color: #FF8D1B;
      background: none;
    }
    .sidebar {
      background: #fff;
      border: 1px solid #e1e4e8;
      border-radius: 4px;
      margin-bottom: 20px;
      padding: 0;
    }
    .sidebar .nav-sidebar > li > a {
      color: #444;
      font-weight: 500;
      padding: 12px 18px;
      border-bottom: 1px solid #f1f1f1;
      transition: all 0.2s ease;
    }
    .sidebar .nav-sidebar > li > a:hover {
      background-color: #f8f9fa;
      color: #FF8D1B;
      padding-left: 22px;
    }
    .sidebar .nav-sidebar > li.active > a,
    .sidebar .nav-sidebar > li.active > a:hover,
    .sidebar .nav-sidebar > li.active > a:focus {
      background-color: #FF8D1B;
      color: #fff;
    }
    .sidebar .nav-sidebar > li > a i {
      margin-right: 10px;
      width: 18px;
      text-align: center;
    }
    .content-card {
      background: #fff;
      border: 1px solid #e1e4e8;
      border-radius: 4px;
      padding: 20px 25px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      margin-bottom: 25px;
    }
    .page-header-title {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid #f1f1f1;
    }
    .page-header-title h2 {
      margin: 0;
      font-size: 24px;
      color: #212121;
      font-weight: 600;
    }
    .table-responsive {
      border: none;
    }
    .table th {
      background-color: #f8f9fa;
      color: #495057;
      font-weight: 600;
      border-bottom: 2px solid #dee2e6 !important;
    }
    .table td {
      vertical-align: middle !important;
    }
    .stat-card {
      background: #fff;
      border: 1px solid #e1e4e8;
      border-radius: 4px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      transition: transform 0.2s ease;
    }
    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .stat-card .stat-icon {
      font-size: 38px;
      float: right;
      color: #FF8D1B;
      opacity: 0.8;
    }
    .stat-card .stat-number {
      font-size: 28px;
      font-weight: bold;
      margin-top: 5px;
      color: #212121;
    }
    .stat-card .stat-title {
      color: #777;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .btn-orange {
      background-color: #FF8D1B;
      color: #fff;
      border: none;
    }
    .btn-orange:hover, .btn-orange:focus {
      background-color: #e57d15;
      color: #fff;
    }
  </style>
</head>
<body>

  <!-- Top Navbar -->
  <nav class="navbar navbar-inverse navbar-fixed-top navbar-admin">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#admin-navbar-collapse" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">One<span>Movies</span> Admin</a>
      </div>

      <div class="collapse navbar-collapse" id="admin-navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="{{ route('home') }}" target="_blank">
              <i class="fa fa-globe"></i> Lihat Website
            </a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user-circle"></i> {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                  @csrf
                  <button type="submit" class="btn btn-link btn-block text-left" style="padding: 8px 20px; text-align: left; color: #333; text-decoration: none;">
                    <i class="fa fa-sign-out"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid" style="margin-top: 15px;">
    <div class="row">
      <!-- Sidebar Menu -->
      <div class="col-md-2 col-sm-3">
        <div class="sidebar">
          <ul class="nav nav-sidebar">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-tachometer"></i> Dashboard
              </a>
            </li>
            <li class="{{ request()->routeIs('admin.films.*') ? 'active' : '' }}">
              <a href="{{ route('admin.films.index') }}">
                <i class="fa fa-film"></i> Film
              </a>
            </li>
            <li class="{{ request()->routeIs('admin.casts.*') ? 'active' : '' }}">
              <a href="{{ route('admin.casts.index') }}">
                <i class="fa fa-users"></i> Cast
              </a>
            </li>
            <li class="{{ request()->routeIs('admin.genres.*') ? 'active' : '' }}">
              <a href="{{ route('admin.genres.index') }}">
                <i class="fa fa-tags"></i> Genre
              </a>
            </li>
            <li class="{{ request()->routeIs('admin.perans.*') ? 'active' : '' }}">
              <a href="{{ route('admin.perans.index') }}">
                <i class="fa fa-theater-masks fa-user"></i> Peran
              </a>
            </li>
            <li class="{{ request()->routeIs('admin.kritiks.*') ? 'active' : '' }}">
              <a href="{{ route('admin.kritiks.index') }}">
                <i class="fa fa-comments"></i> Komentar
              </a>
            </li>
            <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
              <a href="{{ route('admin.users.index') }}">
                <i class="fa fa-user-circle"></i> User
              </a>
            </li>
            <li>
              <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-link btn-block text-left" style="color: #c9302c; padding: 12px 18px; text-align: left; text-decoration: none; font-weight: 500;">
                  <i class="fa fa-sign-out" style="margin-right: 10px; width: 18px; text-align: center;"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-md-10 col-sm-9">
        <!-- Flash Messages -->
        @if (session('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i> {{ session('success') }}
          </div>
        @endif

        @if (session('error'))
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
          </div>
        @endif

        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><i class="fa fa-exclamation-triangle"></i> Terdapat kesalahan pada input:</strong>
            <ul style="margin-top: 5px; margin-bottom: 0; padding-left: 20px;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @yield('content')
      </div>
    </div>
  </div>

  <script src="{{ asset('template/js/jquery-2.1.4.min.js') }}"></script>
  <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>
</body>
</html>

