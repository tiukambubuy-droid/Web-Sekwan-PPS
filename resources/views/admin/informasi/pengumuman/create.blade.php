@extends('admin.layouts.app')

@section('content')
<div class="form-card">
    <h2>Tambah Pengumuman</h2>

    <form method="POST"
          action="{{ route('admin.informasi.pengumuman.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Judul Pengumuman</label>
            <input type="text" name="title" required>
        </div>

        <div class="form-group">
            <label>Isi Pengumuman</label>
            <textarea name="content" id="editor" rows="8" required></textarea>
        </div>

        <div class="form-group">
            <label>Gambar Pengumuman (boleh lebih dari satu)</label>
            <input type="file" name="images[]" multiple accept="image/*">
            <small class="form-hint">
                JPG / PNG • Tidak wajib • Bisa lebih dari 1
            </small>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="draft">Draft</option>
                <option value="published">Publish</option>
            </select>
        </div>

        <div class="form-actions">
            <button class="btn-primary">Simpan</button>
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
