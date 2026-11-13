@extends('admin.layout')

@section('title', 'Kelola Film')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-film"></i> Daftar Film</h2>
    <a href="{{ route('admin.films.create') }}" class="btn btn-orange">
      <i class="fa fa-plus"></i> Tambah Film
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th style="width: 50px;">#</th>
          <th style="width: 70px;">Poster</th>
          <th>Judul</th>
          <th>Genre</th>
          <th style="width: 80px;">Tahun</th>
          <th style="width: 200px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($films as $index => $film)
          <tr>
            <td>{{ $films->firstItem() + $index }}</td>
            <td>
              @if ($film->poster)
                <img src="{{ asset($film->poster) }}" alt="{{ $film->title }}" style="width: 50px; height: 70px; object-fit: cover; border-radius: 3px;">
              @else
                <span class="text-muted">-</span>
              @endif
            </td>
            <td>
              <strong>{{ $film->title }}</strong>
              <div class="text-muted" style="font-size: 12px;">{{ Str::limit($film->sinopsis, 70) }}</div>
            </td>
            <td><span class="label label-info">{{ $film->genre->name ?? '-' }}</span></td>
            <td>{{ $film->year }}</td>
            <td>
              <a href="{{ route('admin.films.show', $film->id) }}" class="btn btn-xs btn-info" title="Detail">
                <i class="fa fa-eye"></i> Detail
              </a>
              <a href="{{ route('admin.films.edit', $film->id) }}" class="btn btn-xs btn-warning" title="Edit">
                <i class="fa fa-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.films.destroy', $film->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus film ini? Semua peran dan kritik terkait akan ikut terhapus!');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-xs btn-danger" title="Hapus">
                  <i class="fa fa-trash"></i> Hapus
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted">Belum ada data film.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center">
    {{ $films->links() }}
  </div>
</div>
@endsection

