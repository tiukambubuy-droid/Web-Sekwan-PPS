@extends('admin.layouts.app')

@section('content')
<div class="dashboard-wrapper">

    <div class="dashboard-header">
        <h2>Dashboard Admin</h2>
        <p class="subtitle">
            Selamat datang di panel administrasi Website Sekretariat DPRP Papua Selatan.
        </p>
    </div>

    <div class="dashboard-cards">

        <a href="{{ route('menus.create') }}" class="dashboard-card">
            <div class="card-icon">📂</div>
            <div class="card-body">
                <h3>Kelola Menu</h3>
                <p>Tambah dan atur menu utama website</p>
            </div>
        </a>

        <a href="{{ route('menu-items.create') }}" class="dashboard-card">
            <div class="card-icon">📑</div>
            <div class="card-body">
                <h3>Kelola Submenu</h3>
                <p>Kelola submenu dari setiap menu</p>
            </div>
        </a>

        <a href="{{ route('pages.create') }}" class="dashboard-card">
            <div class="card-icon">📝</div>
            <div class="card-body">
                <h3>Kelola Halaman</h3>
                <p>Isi dan perbarui konten halaman website</p>
            </div>
        </a>

    </div>

</div>
@endsection
