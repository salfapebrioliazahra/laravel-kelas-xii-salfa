@extends('admin.layout')

@section('title', 'Kelola Genre')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-tags"></i> Daftar Genre</h2>
    <a href="{{ route('admin.genres.create') }}" class="btn btn-orange">
      <i class="fa fa-plus"></i> Tambah Genre
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th style="width: 50px;">#</th>
          <th>Nama Genre</th>
          <th style="width: 150px;">Jumlah Film</th>
          <th style="width: 180px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($genres as $index => $genre)
          <tr>
            <td>{{ $genres->firstItem() + $index }}</td>
            <td><strong>{{ $genre->name }}</strong></td>
            <td>
              <span class="badge">{{ $genre->films_count }} film</span>
            </td>
            <td>
              <a href="{{ route('admin.genres.show', $genre->id) }}" class="btn btn-xs btn-info" title="Detail">
                <i class="fa fa-eye"></i> Detail
              </a>
              <a href="{{ route('admin.genres.edit', $genre->id) }}" class="btn btn-xs btn-warning" title="Edit">
                <i class="fa fa-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus genre ini?');">
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
            <td colspan="4" class="text-center text-muted">Belum ada data genre.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center">
    {{ $genres->links() }}
  </div>
</div>
@endsection

