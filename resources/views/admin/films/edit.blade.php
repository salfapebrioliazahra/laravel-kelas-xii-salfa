@extends('admin.layout')

@section('title', 'Edit Film')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-pencil-square-o"></i> Edit Film: {{ $film->title }}</h2>
    <a href="{{ route('admin.films.index') }}" class="btn btn-default">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
  </div>

  <form action="{{ route('admin.films.update', $film->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <label for="title">Judul Film <span class="text-danger">*</span></label>
          <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $film->title) }}" required>
        </div>

        <div class="form-group">
          <label for="sinopsis">Sinopsis <span class="text-danger">*</span></label>
          <textarea name="sinopsis" id="sinopsis" rows="6" class="form-control" required>{{ old('sinopsis', $film->sinopsis) }}</textarea>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label for="year">Tahun Rilis (1900-2100) <span class="text-danger">*</span></label>
          <input type="number" name="year" id="year" min="1900" max="2100" class="form-control" value="{{ old('year', $film->year) }}" required>
        </div>

        <div class="form-group">
          <label for="genre_id">Genre <span class="text-danger">*</span></label>
          <select name="genre_id" id="genre_id" class="form-control" required>
            <option value="">-- Pilih Genre --</option>
            @foreach ($genres as $genre)
              <option value="{{ $genre->id }}" {{ old('genre_id', $film->genre_id) == $genre->id ? 'selected' : '' }}>
                {{ $genre->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="poster">Ganti Poster (Opsional)</label>
          @if ($film->poster)
            <div style="margin-bottom: 10px;">
              <img src="{{ asset($film->poster) }}" alt="{{ $film->title }}" style="width: 80px; height: 110px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
              <span class="text-muted" style="font-size: 11px; display: block; margin-top: 3px;">Poster saat ini</span>
            </div>
          @endif
          <input type="file" name="poster" id="poster" class="form-control" accept="image/jpeg,image/png,image/webp,image/jpg">
          <p class="help-block" style="font-size: 12px;">Kosongkan jika tidak ingin mengubah poster. Maks 2MB.</p>
        </div>
      </div>
    </div>

    <hr>
    <div class="form-group">
      <button type="submit" class="btn btn-orange">
        <i class="fa fa-save"></i> Perbarui Film
      </button>
      <a href="{{ route('admin.films.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
@endsection

