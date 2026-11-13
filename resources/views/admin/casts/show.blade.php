@extends('admin.layout')

@section('title', 'Detail Cast: ' . $cast->name)

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-info-circle"></i> Detail Cast: {{ $cast->name }}</h2>
    <div>
      <a href="{{ route('admin.casts.edit', $cast->id) }}" class="btn btn-warning">
        <i class="fa fa-pencil"></i> Edit
      </a>
      <a href="{{ route('admin.casts.index') }}" class="btn btn-default">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <table class="table table-bordered">
    <tr>
      <th style="width: 150px;">Nama</th>
      <td><strong>{{ $cast->name }}</strong></td>
    </tr>
    <tr>
      <th>Umur</th>
      <td>{{ $cast->age }} tahun</td>
    </tr>
    <tr>
      <th>Biografi</th>
      <td style="white-space: pre-line;">{{ $cast->bio }}</td>
    </tr>
  </table>

  <h4><i class="fa fa-film"></i> Daftar Peran dalam Film ({{ $cast->perans->count() }})</h4>
  <table class="table table-striped table-bordered table-condensed">
    <thead>
      <tr>
        <th>Film</th>
        <th>Nama Peran / Karakter</th>
        <th>Tahun</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($cast->perans as $peran)
        <tr>
          <td><strong>{{ $peran->film->title ?? '-' }}</strong></td>
          <td>{{ $peran->actor }}</td>
          <td>{{ $peran->film->year ?? '-' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-muted text-center">Cast ini belum memiliki peran pada film mana pun.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

