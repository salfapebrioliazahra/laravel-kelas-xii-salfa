@extends('admin.layout')

@section('title', 'Tambah Cast')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-plus-circle"></i> Tambah Cast Baru</h2>
    <a href="{{ route('admin.casts.index') }}" class="btn btn-default">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
  </div>

  <form action="{{ route('admin.casts.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Nama Pemain / Cast (Maks. 45 karakter) <span class="text-danger">*</span></label>
      <input type="text" name="name" id="name" maxlength="45" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
      <label for="age">Umur <span class="text-danger">*</span></label>
      <input type="number" name="age" id="age" min="0" max="150" class="form-control" value="{{ old('age') }}" required>
    </div>

    <div class="form-group">
      <label for="bio">Biografi</label>
      <textarea name="bio" id="bio" rows="4" class="form-control">{{ old('bio') }}</textarea>
    </div>

    <hr>
    <div class="form-group">
      <button type="submit" class="btn btn-orange">
        <i class="fa fa-save"></i> Simpan Cast
      </button>
      <a href="{{ route('admin.casts.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
@endsection

