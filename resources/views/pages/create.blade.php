@extends('admin.layouts.app')

@section('content')
<h2>Tambah Halaman</h2>

<form method="POST" action="{{ route('pages.store') }}">
    @csrf

    <label>Sub Menu</label><br>
    <select name="menu_item_id">
        @foreach($items as $item)
            <option value="{{ $item->id }}">{{ $item->title }}</option>
        @endforeach
    </select><br><br>

    <label>Judul Halaman</label><br>
    <input type="text" name="title"><br><br>

    <label>Isi Halaman</label><br>
    <textarea name="content" rows="6" style="width:100%"></textarea><br><br>

    <button>Simpan</button>
</form>
@endsection
