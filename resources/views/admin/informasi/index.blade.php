@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/informasi.css') }}">
@endpush

@section('content')
<div class="card">
    <h2 class="page-title">Kelola Informasi</h2>
    <p class="page-subtitle">
        Pilih jenis informasi yang ingin dikelola
    </p>

    <div class="info-grid">
        <!-- Berita -->
        <a href="{{ route('admin.informasi.berita.index') }}" class="info-card">
            <div class="info-icon">📰</div>
            <div class="info-content">
                <h3>Berita</h3>
                <p>Kelola berita dan publikasi resmi</p>
            </div>
        </a>

        <!-- Pengumuman -->
        <a href="{{ route('admin.informasi.pengumuman.index') }}" class="info-card">
            <div class="info-icon">📢</div>
            <div class="info-content">
                <h3>Pengumuman</h3>
                <p>Informasi dan pengumuman publik</p>
            </div>
        </a>

        <!-- Agenda -->
        <a href="{{ route('admin.informasi.agenda.index') }}" class="info-card">
            <div class="info-icon">📅</div>
            <div class="info-content">
                <h3>Agenda</h3>
                <p>Agenda kegiatan dan jadwal</p>
            </div>
        </a>

        <!-- Infografis -->
        <a href="{{ route('admin.informasi.infografis.index') }}" class="info-card">
            <div class="info-icon">📊</div>
            <div class="info-content">
                <h3>Infografis</h3>
                <p>Konten visual dan data grafis</p>
            </div>
        </a>
    </div>
</div>
@endsection