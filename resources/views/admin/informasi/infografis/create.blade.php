@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/infografis.css') }}">
@endpush

@section('content')
<div class="infografis-wrapper">
    <h4>Tambah Infografis</h4>

    <form class="infografis-form"
          action="{{ route('admin.informasi.infografis.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul --}}
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul"
                   value="{{ old('judul') }}"
                   class="@error('judul') is-invalid @enderror"
                   required>
            @error('judul')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label>Deskripsi (WAJIB)</label>
            <textarea name="deskripsi" rows="4"
                      class="@error('deskripsi') is-invalid @enderror"
                      required>{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Upload Gambar --}}
        <div class="form-group">
            <label>Upload Gambar (Bisa lebih dari satu)</label>
            <input type="file" name="images[]"
                   multiple required>
                   <div id="preview-container" class="infografis-images" style="display:none;"></div>
            @error('images')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="draft">Draft</option>
                <option value="publish">Publish</option>
            </select>
        </div>

        {{-- Action --}}
        <div class="infografis-actions">
            <a href="{{ route('admin.informasi.infografis.index') }}"
               class="btn btn-secondary">Batal</a>
            <button class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.querySelector('input[name="images[]"]').addEventListener('change', function(e) {
    const preview = document.getElementById('preview-container');
    preview.innerHTML = '';
    preview.style.display = 'grid';

    Array.from(e.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(ev) {
            const div = document.createElement('div');
            div.classList.add('infografis-image-card');
            div.innerHTML = `
                <img src="${ev.target.result}">
            `;
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush

@endsection
