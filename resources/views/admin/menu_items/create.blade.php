@extends('admin.layouts.app')

@section('content')
<div class="form-card">
    <h2>Tambah Sub Menu</h2>

    <form method="POST" action="{{ route('menu-items.store') }}">
        @csrf

        <div class="form-group">
            <label>Menu Utama</label>
            <select name="menu_id" required>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Judul Sub Menu</label>
            <input type="text" name="title" required>
        </div>

        <div class="form-group">
            <label>Urutan</label>
            <input type="number" name="order" value="0">
        </div>

        <div class="form-actions">
            <button class="btn-primary">Simpan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
