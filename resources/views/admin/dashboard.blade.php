@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-tachometer"></i> Dashboard Overview</h2>
    <span class="text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong> (Administrator)</span>
  </div>

  <div class="row">
    <!-- Film -->
    <div class="col-md-4 col-sm-6">
      <div class="stat-card">
        <i class="fa fa-film stat-icon"></i>
        <div class="stat-title">Total Film</div>
        <div class="stat-number">{{ $counts['films'] }}</div>
        <div style="margin-top: 10px;">
          <a href="{{ route('admin.films.index') }}" class="btn btn-xs btn-default">Kelola Film <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Cast -->
    <div class="col-md-4 col-sm-6">
      <div class="stat-card">
        <i class="fa fa-users stat-icon"></i>
        <div class="stat-title">Total Cast (Pemain)</div>
        <div class="stat-number">{{ $counts['casts'] }}</div>
        <div style="margin-top: 10px;">
          <a href="{{ route('admin.casts.index') }}" class="btn btn-xs btn-default">Kelola Cast <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Genre -->
    <div class="col-md-4 col-sm-6">
      <div class="stat-card">
        <i class="fa fa-tags stat-icon"></i>
        <div class="stat-title">Total Genre</div>
        <div class="stat-number">{{ $counts['genres'] }}</div>
        <div style="margin-top: 10px;">
          <a href="{{ route('admin.genres.index') }}" class="btn btn-xs btn-default">Kelola Genre <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Peran -->
    <div class="col-md-4 col-sm-6">
      <div class="stat-card">
        <i class="fa fa-user stat-icon"></i>
        <div class="stat-title">Total Peran</div>
        <div class="stat-number">{{ $counts['perans'] }}</div>
        <div style="margin-top: 10px;">
          <a href="{{ route('admin.perans.index') }}" class="btn btn-xs btn-default">Kelola Peran <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Komentar / Kritik -->
    <div class="col-md-4 col-sm-6">
      <div class="stat-card">
        <i class="fa fa-comments stat-icon"></i>
        <div class="stat-title">Total Komentar</div>
        <div class="stat-number">{{ $counts['kritiks'] }}</div>
        <div style="margin-top: 10px;">
          <a href="{{ route('admin.kritiks.index') }}" class="btn btn-xs btn-default">Kelola Komentar <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>

    <!-- User -->
    <div class="col-md-4 col-sm-6">
      <div class="stat-card">
        <i class="fa fa-user-circle stat-icon"></i>
        <div class="stat-title">Total Pengguna</div>
        <div class="stat-number">{{ $counts['users'] }}</div>
        <div style="margin-top: 10px;">
          <a href="{{ route('admin.users.index') }}" class="btn btn-xs btn-default">Kelola User <i class="fa fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

