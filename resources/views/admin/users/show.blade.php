@extends('admin.layout')

@section('title', 'Detail User: ' . $user->name)

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-info-circle"></i> Detail User: {{ $user->name }}</h2>
    <div>
      <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
        <i class="fa fa-pencil"></i> Edit
      </a>
      <a href="{{ route('admin.users.index') }}" class="btn btn-default">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h4><i class="fa fa-user"></i> Data Akun</h4>
      <table class="table table-bordered">
        <tr>
          <th style="width: 150px;">Nama</th>
          <td><strong>{{ $user->name }}</strong></td>
        </tr>
        <tr>
          <th>Email</th>
          <td>{{ $user->email }}</td>
        </tr>
        <tr>
          <th>Role</th>
          <td>
            @if ((int) $user->role_id === 2)
              <span class="label label-danger">Administrator</span>
            @else
              <span class="label label-default">User</span>
            @endif
          </td>
        </tr>
        <tr>
          <th>Terdaftar Pada</th>
          <td>{{ $user->created_at ? $user->created_at->format('d M Y H:i') : '-' }}</td>
        </tr>
      </table>
    </div>

    <div class="col-md-6">
      <h4><i class="fa fa-id-card"></i> Data Profil</h4>
      <table class="table table-bordered">
        <tr>
          <th style="width: 150px;">Umur</th>
          <td>{{ $user->profile->umur ?? '-' }} tahun</td>
        </tr>
        <tr>
          <th>Bio</th>
          <td style="white-space: pre-line;">{{ $user->profile->bio ?? '-' }}</td>
        </tr>
        <tr>
          <th>Alamat</th>
          <td style="white-space: pre-line;">{{ $user->profile->alamat ?? '-' }}</td>
        </tr>
      </table>
    </div>
  </div>

  <h4><i class="fa fa-comments"></i> Kritik & Komentar yang Ditulis ({{ $user->kritiks->count() }})</h4>
  <table class="table table-striped table-bordered table-condensed">
    <thead>
      <tr>
        <th>Film</th>
        <th>Rating</th>
        <th>Isi Komentar</th>
        <th>Waktu</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($user->kritiks as $kritik)
        <tr>
          <td><strong>{{ $kritik->film->title ?? '-' }}</strong></td>
          <td><span class="label label-warning"><i class="fa fa-star"></i> {{ $kritik->rating }}/5</span></td>
          <td>{{ $kritik->comment }}</td>
          <td>{{ $kritik->created_at ? $kritik->created_at->format('d M Y') : '-' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-muted text-center">User ini belum menulis kritik/komentar.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

