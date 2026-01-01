@extends('admin.layouts.app')

@section('content')
<div class="form-card">
    <h2>Tambah Berita</h2>

    <form method="POST"
        action="{{ route('admin.informasi.berita.store') }}"
        enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Judul Berita</label>
            <input type="text" name="title" required>
        </div>

        <div class="form-group">
            <label>Thumbnail Berita</label>
            <input type="file" name="thumbnail" accept="image/*">
            <small class="form-hint">Format: JPG, PNG, maksimal 2MB</small>
        </div>

        <div class="form-group">
            <label>Ringkasan</label>
            <textarea name="excerpt" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label>Isi Berita</label>
            <textarea name="content" id="editor" rows="8" required></textarea>
        </div>

        <div class="form-group">
            <label>Tag Berita</label>
            <div class="tag-checkbox">
                @foreach($tags as $tag)
                <label class="tag-item">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                    <span>{{ $tag->name }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <div class="form-actions">
            <button class="btn-primary">Simpan</button>
            <a href="{{ route('admin.informasi.berita.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'underline',
                    '|',
                    'alignment',
                    '|',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'blockQuote',
                    'insertTable',
                    '|',
                    'undo',
                    'redo'
                ],
                alignment: {
                    options: [ 'left', 'center', 'right', 'justify' ]
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endpush
