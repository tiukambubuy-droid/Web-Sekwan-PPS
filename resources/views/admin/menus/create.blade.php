@extends('admin.layouts.app')

@section('content')
<div class="form-card">
    <h2>Tambah Menu</h2>

    <form method="POST" action="{{ route('menus.store') }}">
        @csrf

        <div class="form-group">
            <label>Nama Menu</label>
            <input type="text" name="name" required>
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
