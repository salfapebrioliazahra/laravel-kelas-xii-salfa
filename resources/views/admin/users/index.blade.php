@extends('admin.layout')

@section('title', 'Kelola User')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-user-circle"></i> Daftar Pengguna (User)</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-orange">
      <i class="fa fa-plus"></i> Tambah User
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th style="width: 50px;">#</th>
          <th>Nama</th>
          <th>Email</th>
          <th style="width: 120px;">Role</th>
          <th style="width: 180px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $index => $user)
          <tr>
            <td>{{ $users->firstItem() + $index }}</td>
            <td>
              <strong>{{ $user->name }}</strong>
              @if (Auth::id() === $user->id)
                <span class="label label-primary" style="margin-left: 5px;">Akun Anda</span>
              @endif
            </td>
            <td>{{ $user->email }}</td>
            <td>
              @if ((int) $user->role_id === 2)
                <span class="label label-danger">Admin</span>
              @else
                <span class="label label-default">User</span>
              @endif
            </td>
            <td>
              <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-xs btn-info" title="Detail">
                <i class="fa fa-eye"></i> Detail
              </a>
              <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-xs btn-warning" title="Edit">
                <i class="fa fa-pencil"></i> Edit
              </a>
              @if (Auth::id() !== $user->id)
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Profil dan seluruh kritik terkait akan ikut terhapus!');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-xs btn-danger" title="Hapus">
                    <i class="fa fa-trash"></i> Hapus
                  </button>
                </form>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center text-muted">Belum ada data user.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="text-center">
    {{ $users->links() }}
  </div>
</div>
@endsection

