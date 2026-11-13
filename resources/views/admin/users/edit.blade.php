@extends('admin.layout')

@section('title', 'Edit User')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-pencil-square-o"></i> Edit User: {{ $user->name }}</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-default">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
  </div>

  <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
          <label for="email">Alamat Email <span class="text-danger">*</span></label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="password">Ganti Password (Opsional)</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika password tidak diubah">
          <p class="help-block" style="font-size: 12px;">Minimal 8 karakter jika diisi.</p>
        </div>

        <div class="form-group">
          <label for="role_id">Role / Hak Akses <span class="text-danger">*</span></label>
          <select name="role_id" id="role_id" class="form-control" required {{ Auth::id() === $user->id ? 'disabled' : '' }}>
            @foreach ($roles as $role)
              <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                {{ $role->name }}
              </option>
            @endforeach
          </select>
          @if (Auth::id() === $user->id)
            <input type="hidden" name="role_id" value="{{ $user->role_id }}">
            <p class="help-block text-warning" style="font-size: 12px;"><i class="fa fa-lock"></i> Anda tidak dapat mengubah role akun Anda sendiri.</p>
          @endif
        </div>
      </div>
    </div>

    <hr>
    <div class="form-group">
      <button type="submit" class="btn btn-orange">
        <i class="fa fa-save"></i> Perbarui User
      </button>
      <a href="{{ route('admin.users.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
@endsection

