@extends('admin.layout')

@section('title', 'Detail Genre: ' . $genre->name)

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-info-circle"></i> Detail Genre: {{ $genre->name }}</h2>
    <div>
      <a href="{{ route('admin.genres.edit', $genre->id) }}" class="btn btn-warning">
        <i class="fa fa-pencil"></i> Edit
      </a>
      <a href="{{ route('admin.genres.index') }}" class="btn btn-default">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <table class="table table-bordered">
    <tr>
      <th style="width: 150px;">Nama Genre</th>
      <td><strong>{{ $genre->name }}</strong></td>
    </tr>
    <tr>
      <th>Total Film</th>
      <td><span class="badge">{{ $genre->films->count() }} film</span></td>
    </tr>
  </table>

  <h4><i class="fa fa-film"></i> Film dengan Genre {{ $genre->name }}</h4>
  <table class="table table-striped table-bordered table-condensed">
    <thead>
      <tr>
        <th style="width: 50px;">#</th>
        <th>Judul Film</th>
        <th>Tahun</th>
        <th style="width: 100px;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($genre->films as $index => $film)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td><strong>{{ $film->title }}</strong></td>
          <td>{{ $film->year }}</td>
          <td>
            <a href="{{ route('admin.films.show', $film->id) }}" class="btn btn-xs btn-info">Detail Film</a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-muted text-center">Belum ada film yang menggunakan genre ini.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection

