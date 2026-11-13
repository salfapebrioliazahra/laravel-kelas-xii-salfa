@extends('admin.layout')

@section('title', 'Kelola Peran')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-user"></i> Daftar Peran</h2>
    <a href="{{ route('admin.perans.create') }}" class="btn btn-orange">
      <i class="fa fa-plus"></i> Tambah Peran
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th style="width: 50px;">#</th>
          <th>Nama Karakter / Peran</th>
          <th>Film</th>
          <th>Aktor / Cast</th>
          <th style="width: 180px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($perans as $index => $peran)
          <tr>
            <td>{{ $perans->firstItem() + $index }}</td>
            <td><strong>{{ $peran->actor }}</strong></td>
            <td>
              <a href="{{ route('admin.films.show', $peran->film_id) }}">
                {{ $peran->film->title ?? '-' }}
              </a>
            </td>
            <td>
              <a href="{{ route('admin.casts.show', $peran->cast_id) }}">
                {{ $peran->cast->name ?? '-' }}
              </a>
            </td>
            <td>
              <a href="{{ route('admin.perans.show', $peran->id) }}" class="btn btn-xs btn-info" title="Detail">
                <i class="fa fa-eye"></i> Detail
              </a>
              <a href="{{ route('admin.perans.edit', $peran->id) }}" class="btn btn-xs btn-warning" title="Edit">
                <i class="fa fa-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.perans.destroy', $peran->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peran ini?');">
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
            <td colspan="5" class="text-center text-muted">Belum ada data peran.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center">
    {{ $perans->links() }}
  </div>
</div>
@endsection

