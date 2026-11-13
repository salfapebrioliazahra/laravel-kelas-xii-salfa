@extends('admin.layout')

@section('title', 'Kelola Komentar')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-comments"></i> Daftar Komentar / Kritik</h2>
  </div>

  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th style="width: 50px;">#</th>
          <th style="width: 150px;">Nama User</th>
          <th style="width: 180px;">Judul Film</th>
          <th>Isi Komentar</th>
          <th style="width: 90px;">Rating</th>
          <th style="width: 140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($kritiks as $index => $kritik)
          <tr>
            <td>{{ $kritiks->firstItem() + $index }}</td>
            <td>
              <i class="fa fa-user"></i> <strong>{{ $kritik->user->name ?? '-' }}</strong>
            </td>
            <td>
              <i class="fa fa-film"></i> <strong>{{ $kritik->film->title ?? '-' }}</strong>
            </td>
            <td>{{ $kritik->comment }}</td>
            <td>
              <span class="label label-warning">
                <i class="fa fa-star"></i> {{ $kritik->rating }}/5
              </span>
            </td>
            <td>
              <a href="{{ route('admin.kritiks.edit', $kritik->id) }}" class="btn btn-xs btn-warning" title="Edit">
                <i class="fa fa-pencil"></i> Edit
              </a>
              <form action="{{ route('admin.kritiks.destroy', $kritik->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');">
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
            <td colspan="6" class="text-center text-muted">Belum ada komentar/kritik.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center">
    {{ $kritiks->links() }}
  </div>
</div>
@endsection

