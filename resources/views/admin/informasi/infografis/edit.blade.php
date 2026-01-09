@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/infografis.css') }}">
@endpush

@section('content')
<div class="form-card">
    <h2>Edit Infografis</h2>

    <form action="{{ route('admin.informasi.infografis.update',$infografis->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul"
                   value="{{ $infografis->judul }}" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" required>{{ $infografis->deskripsi }}</textarea>
        </div>

        <div class="form-group">
            <label>Tambah Gambar Baru</label>
            <input type="file" name="images[]" multiple>
        </div>

        <div class="infografis-images">
            @foreach($infografis->images as $img)
                <div class="infografis-image-card">
                    <img src="{{ asset('storage/'.$img->image_path) }}">
                    <form action="{{ route('admin.informasi.infografis.image.destroy',$img->id) }}"
                          method="POST"
                          onsubmit="return confirm('Hapus gambar ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="draft" {{ $infografis->status=='draft'?'selected':'' }}>Draft</option>
                <option value="publish" {{ $infografis->status=='publish'?'selected':'' }}>Publish</option>
            </select>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.informasi.infografis.index') }}"
               class="btn btn-secondary">Kembali</a>
            <button class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection
