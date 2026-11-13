@extends('admin.layout')

@section('title', 'Tambah Peran')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-plus-circle"></i> Tambah Peran Baru</h2>
    <a href="{{ route('admin.perans.index') }}" class="btn btn-default">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
  </div>

  <form action="{{ route('admin.perans.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="actor">Nama Karakter / Peran <span class="text-danger">*</span></label>
      <input type="text" name="actor" id="actor" class="form-control" value="{{ old('actor') }}" placeholder="Contoh: Dom Toretto, Bruce Wayne" required>
    </div>

    <div class="form-group">
      <label for="film_id">Film <span class="text-danger">*</span></label>
      <select name="film_id" id="film_id" class="form-control" required>
        <option value="">-- Pilih Film --</option>
        @foreach ($films as $film)
          <option value="{{ $film->id }}" {{ old('film_id') == $film->id ? 'selected' : '' }}>
            {{ $film->title }} ({{ $film->year }})
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="cast_id">Aktor / Cast <span class="text-danger">*</span></label>
      <select name="cast_id" id="cast_id" class="form-control" required>
        <option value="">-- Pilih Cast --</option>
        @foreach ($casts as $cast)
          <option value="{{ $cast->id }}" {{ old('cast_id') == $cast->id ? 'selected' : '' }}>
            {{ $cast->name }}
          </option>
        @endforeach
      </select>
    </div>

    <hr>
    <div class="form-group">
      <button type="submit" class="btn btn-orange">
        <i class="fa fa-save"></i> Simpan Peran
      </button>
      <a href="{{ route('admin.perans.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
@endsection

