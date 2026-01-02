@extends('admin.layouts.app')

@section('content')
<div class="form-card">
    <h2>Edit Pengumuman</h2>

    <form method="POST"
          action="{{ route('admin.informasi.pengumuman.update', $pengumuman->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Judul Pengumuman</label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $pengumuman->title) }}"
                   required>
        </div>

        <div class="form-group">
            <label>Isi Pengumuman</label>
            <textarea name="content"
                      id="editor"
                      rows="8"
                      required>{{ old('content', $pengumuman->content) }}</textarea>
        </div>

        <div class="form-group">
            <label>Gambar Saat Ini</label>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                @foreach($pengumuman->images as $img)
                    <img src="{{ asset('storage/'.$img->image_path) }}"
                         style="width:120px;border-radius:6px;">
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label>Tambah / Ganti Gambar</label>
            <input type="file" name="images[]" multiple accept="image/*">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="draft"
                    {{ $pengumuman->status === 'draft' ? 'selected' : '' }}>
                    Draft
                </option>
                <option value="published"
                    {{ $pengumuman->status === 'published' ? 'selected' : '' }}>
                    Publish
                </option>
            </select>
        </div>

        <div class="form-actions">
            <button class="btn-primary">Update</button>
            <a href="{{ route('admin.informasi.pengumuman.index') }}"
               class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => console.error(error));
</script>
@endpush
@endsection
