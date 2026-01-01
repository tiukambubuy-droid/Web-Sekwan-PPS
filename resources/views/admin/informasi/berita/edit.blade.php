@extends('admin.layouts.app')

@section('content')
<div class="form-card">
    <h2>Edit Berita</h2>

    <form method="POST"
        action="{{ route('admin.informasi.berita.update', $berita->id) }}"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')


        <div class="form-group">
            <label>Judul Berita</label>
            <input type="text"
                name="title"
                value="{{ old('title', $berita->title) }}"
                required>
        </div>

        <div class="form-group">
            <label>Thumbnail Berita</label>

            @if($berita->thumbnail)
            <img src="{{ asset('storage/'.$berita->thumbnail) }}"
                style="width:120px;display:block;margin-bottom:10px;">
            @endif

            <input type="file" name="thumbnail" accept="image/*">
        </div>

        <div class="form-group">
            <label>Ringkasan</label>
            <textarea name="excerpt" rows="3" required>{{ old('excerpt', $berita->excerpt) }}</textarea>
        </div>

        <div class="form-group">
            <label>Isi Berita</label>
            <textarea name="content" id="editor" rows="8" required>
            {{ old('content', $berita->content) }}
            </textarea>


        </div>

        <div class="form-group">
            <label>Tag Berita</label>

            <div class="tag-checkbox">
                @foreach($tags as $tag)
                <label class="tag-item">
                    <input type="checkbox"
                        name="tags[]"
                        value="{{ $tag->id }}"
                        {{ $berita->tags->contains($tag->id) ? 'checked' : '' }}>
                    <span>{{ $tag->name }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <div class="form-actions">
            <button class="btn-primary">Update</button>
            <a href="{{ route('admin.informasi.berita.index') }}"
                class="btn-secondary">Batal</a>
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
