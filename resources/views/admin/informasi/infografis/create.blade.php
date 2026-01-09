@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/infografis.css') }}">
@endpush

@section('content')
<div class="form-card">
    <h2>Tambah Infografis</h2>

    <form action="{{ route('admin.informasi.infografis.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi (WAJIB)</label>
            <textarea name="deskripsi" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label>Upload Gambar</label>
            <input type="file" name="images[]" multiple required>
            <span class="form-hint">Bisa lebih dari satu gambar</span>
        </div>

        <div id="preview-container" class="infografis-images"></div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="draft">Draft</option>
                <option value="publish">Publish</option>
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.informasi.infografis.index') }}"
               class="btn btn-secondary">Batal</a>
            <button class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
