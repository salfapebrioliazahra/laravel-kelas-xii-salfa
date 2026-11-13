@extends('admin.layout')

@section('title', 'Detail Peran: ' . $peran->actor)

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-info-circle"></i> Detail Peran: {{ $peran->actor }}</h2>
    <div>
      <a href="{{ route('admin.perans.edit', $peran->id) }}" class="btn btn-warning">
        <i class="fa fa-pencil"></i> Edit
      </a>
      <a href="{{ route('admin.perans.index') }}" class="btn btn-default">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <table class="table table-bordered">
    <tr>
      <th style="width: 180px;">Nama Karakter / Peran</th>
      <td><strong>{{ $peran->actor }}</strong></td>
    </tr>
    <tr>
      <th>Film</th>
      <td>
        <a href="{{ route('admin.films.show', $peran->film_id) }}">
          <strong>{{ $peran->film->title ?? '-' }}</strong> ({{ $peran->film->year ?? '-' }})
        </a>
      </td>
    </tr>
    <tr>
      <th>Aktor / Cast</th>
      <td>
        <a href="{{ route('admin.casts.show', $peran->cast_id) }}">
          <strong>{{ $peran->cast->name ?? '-' }}</strong> ({{ $peran->cast->age ?? '-' }} tahun)
        </a>
      </td>
    </tr>
  </table>
</div>
@endsection

