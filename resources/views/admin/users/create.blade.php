@extends('admin.layout')

@section('title', 'Tambah User')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-user-plus"></i> Tambah User Baru</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-default">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
  </div>

  <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
          <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
          <label for="email">Alamat Email <span class="text-danger">*</span></label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="password">Password (Min. 8 karakter) <span class="text-danger">*</span></label>
          <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="role_id">Role / Hak Akses <span class="text-danger">*</span></label>
          <select name="role_id" id="role_id" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            @foreach ($roles as $role)
              <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                {{ $role->name }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="alert alert-info" style="font-size: 13px; margin-top: 10px;">
      <i class="fa fa-info-circle"></i> User yang ditambahkan akan otomatis dibuatkan data profil default (umur 0, bio '-', alamat '-').
    </div>

    <hr>
    <div class="form-group">
      <button type="submit" class="btn btn-orange">
        <i class="fa fa-save"></i> Simpan User
      </button>
      <a href="{{ route('admin.users.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
@endsection

