@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/infografis.css') }}">
@endpush

@section('content')
<div class="infografis-wrapper">
    <h4>Edit Infografis</h4>

    <form class="infografis-form"
        action="{{ route('admin.informasi.infografis.update', $infografis->id) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul"
                value="{{ $infografis->judul }}"
                required>
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label>Deskripsi (WAJIB)</label>
            <textarea name="deskripsi" rows="4" required>{{ $infografis->deskripsi }}</textarea>
        </div>

        {{-- Tambah gambar --}}
        <div class="form-group">
            <label>Tambah Gambar Baru</label>
            <input type="file" name="images[]" multiple>
        </div>

        <h5>Gambar Infografis</h5>

        <div class="infografis-images">
            @foreach($infografis->images as $img)
            <div class="infografis-image-card">
                <img src="{{ asset('storage/'.$img->image_path) }}" alt="Infografis">

                <div class="card-footer">
                    <form action="{{ route('admin.informasi.infografis.image.destroy', $img->id) }}"
                        method="POST"
                        onsubmit="return confirm('Hapus gambar ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div style="font-weight: 700; font-size: 18px; margin-bottom: 30px;"><small class="text-muted">
            lama tidak akan terhapus kecuali dihapus manual.
        </small></div>


        {{-- Status --}}
        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="draft" {{ $infografis->status=='draft' ? 'selected' : '' }}>
                    Draft
                </option>
                <option value="publish" {{ $infografis->status=='publish' ? 'selected' : '' }}>
                    Publish
                </option>
            </select>
        </div>

        {{-- Action --}}
        <div class="infografis-actions">
            <a href="{{ route('admin.informasi.infografis.index') }}"
                class="btn btn-secondary">Kembali</a>
            <button class="btn btn-primary">Update</button>
        </div>
    </form>


</div>
@endsection