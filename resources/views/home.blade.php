@extends('admin.layouts.public')

@section('title', 'Informasi Keberatan Publik')

@push('styles')
<style>
    .breadcrumb {
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
    }

    .breadcrumb .container {
        width: 90%;
        max-width: 1100px;
        margin: auto;
        padding: 12px 0;
        font-size: 14px;
        color: #6b7280;
    }

    .content {
        width: 90%;
        max-width: 1100px;
        margin: 30px auto;
        display: grid;
        grid-template-columns: 3fr 1fr;
        gap: 25px;
    }

    .card {
        background: #ffffff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .card h2 {
        margin-top: 0;
        font-size: 20px;
        border-bottom: 2px solid #2563eb;
        padding-bottom: 10px;
    }

    .sidebar h3 {
        font-size: 16px;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 8px;
    }

    @media (max-width: 900px) {
        .content {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')

<div class="breadcrumb">
    <div class="container">
        Beranda / Informasi Publik
    </div>
</div>

<div class="content">
    <div class="card">
        <h2>Informasi Keberatan Publik</h2>
        <p>
            Dalam rangka menjamin hak masyarakat untuk memperoleh informasi publik,
            Sekretariat DPRP Papua Selatan menyediakan layanan keberatan informasi.
        </p>
        <p>
            Layanan ini merupakan bentuk komitmen terhadap keterbukaan informasi
            dan tata kelola pemerintahan yang transparan.
        </p>
    </div>

    <div class="card sidebar">
        <h3>Informasi Terkait</h3>
        <ul>
            <li><a href="#">Profil PPID</a></li>
            <li><a href="#">Prosedur Permohonan Informasi</a></li>
            <li><a href="#">Daftar Informasi Publik</a></li>
            <li><a href="#">Kontak Layanan Informasi</a></li>
        </ul>
    </div>
</div>

@endsection
