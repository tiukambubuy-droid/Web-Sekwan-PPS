@extends('admin.layouts.app')

@section('content')
<div class="form-card">
    <h2>Tambah Halaman</h2>

    <form method="POST" action="{{ route('pages.store') }}">
        @csrf

        <div class="form-group">
            <label>Sub Menu</label>
            <select name="menu_item_id" required>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Judul Halaman</label>
            <input type="text" name="title" required>
        </div>

        <div class="form-group">
            <label>Isi Halaman</label>
            <textarea name="content"></textarea>
        </div>

        <div class="form-actions">
            <button class="btn-primary">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
