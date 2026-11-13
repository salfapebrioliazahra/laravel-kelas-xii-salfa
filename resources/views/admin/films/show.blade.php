@extends('admin.layout')

@section('title', 'Detail Film: ' . $film->title)

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-info-circle"></i> Detail Film: {{ $film->title }}</h2>
    <div>
      <a href="{{ route('admin.films.edit', $film->id) }}" class="btn btn-warning">
        <i class="fa fa-pencil"></i> Edit
      </a>
      <a href="{{ route('admin.films.index') }}" class="btn btn-default">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      @if ($film->poster)
        <img src="{{ asset($film->poster) }}" alt="{{ $film->title }}" class="img-responsive" style="border-radius: 4px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
      @else
        <div class="well text-center text-muted">Tidak ada poster</div>
      @endif
    </div>
    <div class="col-md-9">
      <table class="table table-bordered">
        <tr>
          <th style="width: 150px;">Judul</th>
          <td><strong>{{ $film->title }}</strong></td>
        </tr>
        <tr>
          <th>Genre</th>
          <td><span class="label label-info">{{ $film->genre->name ?? '-' }}</span></td>
        </tr>
        <tr>
          <th>Tahun Rilis</th>
          <td>{{ $film->year }}</td>
        </tr>
        <tr>
          <th>Sinopsis</th>
          <td style="white-space: pre-line;">{{ $film->sinopsis }}</td>
        </tr>
      </table>

      <h4><i class="fa fa-users"></i> Daftar Pemeran (Peran)</h4>
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Karakter / Peran</th>
            <th>Nama Aktor / Cast</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($film->perans as $peran)
            <tr>
              <td>{{ $peran->actor }}</td>
              <td>{{ $peran->cast->name ?? '-' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="2" class="text-muted text-center">Belum ada pemeran untuk film ini.</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      <h4><i class="fa fa-comments"></i> Komentar & Rating Pengguna ({{ $film->kritiks->count() }})</h4>
      <table class="table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Pengguna</th>
            <th>Rating</th>
            <th>Komentar</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($film->kritiks as $kritik)
            <tr>
              <td>{{ $kritik->user->name ?? '-' }}</td>
              <td>
                <span class="label label-warning"><i class="fa fa-star"></i> {{ $kritik->rating }}/5</span>
              </td>
              <td>{{ $kritik->comment }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-muted text-center">Belum ada komentar untuk film ini.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

