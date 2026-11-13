@extends('admin.layout')

@section('title', 'Kelola Cast')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-users"></i> Daftar Cast (Pemain)</h2>
    <a href="{{ route('admin.casts.create') }}" class="btn btn-orange">
      <i class="fa fa-plus"></i> Tambah Cast
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th style="width: 50px;">#</th>
          <th>Nama</th>
          <th style="width: 100px;">Umur</th>
          <th>Bio</th>
          <th style="width: 180px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($casts as $index => $cast)
          <tr>
            <td>{{ $casts->firstItem() + $index }}</td>
            <td><strong>{{ $cast->name }}</strong></td>
            <td>{{ $cast->age }} tahun</td>
            <td>{{ Str::limit($cast->bio, 80) }}</td>
            <td>
              <a href="{{ route('admin.casts.show', $cast->id) }}" class="btn btn-xs btn-info" title="Detail">
                <i class="fa fa-eye"></i> Detail
              </a>
              <a href="{{ route('admin.casts.edit', $cast->id) }}" class="btn btn-xs btn-warning" title="Edit">
                <i class="fa fa-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.casts.destroy', $cast->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus cast ini? Semua peran terkait akan ikut terhapus!');">
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
            <td colspan="5" class="text-center text-muted">Belum ada data cast.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center">
    {{ $casts->links() }}
  </div>
</div>
@endsection

