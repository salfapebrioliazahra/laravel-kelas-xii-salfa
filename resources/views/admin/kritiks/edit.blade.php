@extends('admin.layout')

@section('title', 'Edit Komentar')

@section('content')
<div class="content-card">
  <div class="page-header-title">
    <h2><i class="fa fa-pencil-square-o"></i> Edit Komentar</h2>
    <a href="{{ route('admin.kritiks.index') }}" class="btn btn-default">
      <i class="fa fa-arrow-left"></i> Kembali
    </a>
  </div>

  <form action="{{ route('admin.kritiks.update', $kritik->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Nama Pengguna (Read-only)</label>
          <p class="form-control-static" style="font-weight: bold; font-size: 15px; color: #333;">
            <i class="fa fa-user"></i> {{ $kritik->user->name ?? '-' }} ({{ $kritik->user->email ?? '-' }})
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Judul Film (Read-only)</label>
          <p class="form-control-static" style="font-weight: bold; font-size: 15px; color: #333;">
            <i class="fa fa-film"></i> {{ $kritik->film->title ?? '-' }} ({{ $kritik->film->year ?? '-' }})
          </p>
        </div>
      </div>
    </div>

    <hr style="margin-top: 5px; margin-bottom: 20px;">

    <div class="form-group">
      <label for="rating">Rating (1-5) <span class="text-danger">*</span></label>
      <select name="rating" id="rating" class="form-control" style="max-width: 200px;" required>
        @for ($i = 1; $i <= 5; $i++)
          <option value="{{ $i }}" {{ old('rating', $kritik->rating) == $i ? 'selected' : '' }}>
            {{ $i }} Bintang ({{ str_repeat('★', $i) }})
          </option>
        @endfor
      </select>
    </div>

    <div class="form-group">
      <label for="comment">Isi Komentar (Maks. 500 karakter) <span class="text-danger">*</span></label>
      <textarea name="comment" id="comment" rows="5" maxlength="500" class="form-control" required>{{ old('comment', $kritik->comment) }}</textarea>
    </div>

    <hr>
    <div class="form-group">
      <button type="submit" class="btn btn-orange">
        <i class="fa fa-save"></i> Perbarui Komentar
      </button>
      <a href="{{ route('admin.kritiks.index') }}" class="btn btn-default">Batal</a>
    </div>
  </form>
</div>
@endsection

