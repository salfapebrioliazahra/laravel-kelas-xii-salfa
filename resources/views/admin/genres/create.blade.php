@extends('admin.layout')

@section('title', 'Tambah Genre')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-plus-circle"></i> Tambah Genre Baru</h2>
    <a href="{{ route('admin.genres.index') }}" class="btn btn-default">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
  </div>

  <form action="{{ route('admin.genres.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Nama Genre <span class="text-danger">*</span></label>
      <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Action, Drama, Horror" required>
    </div>

    <hr>
    <div class="form-group">
      <button type="submit" class="btn btn-orange">
        <i class="fa fa-save"></i> Simpan Genre
      </button>
      <a href="{{ route('admin.genres.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
@endsection

