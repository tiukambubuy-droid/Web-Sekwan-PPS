@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
@endpush

@section('content')
<div class="form-card">
    <h2>Tambah Agenda</h2>

    <form method="POST"
        action="{{ route('admin.informasi.agenda.store') }}">
        @csrf

        {{-- Judul --}}
        <div class="form-group">
            <label>Judul Agenda</label>
            <input type="text" name="title" required>
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label>Deskripsi Agenda</label>
            <textarea name="description" id="editor" rows="6"></textarea>
        </div>

        {{-- Tanggal --}}
        <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" name="start_date" required>
        </div>

        <div class="form-group">
            <label>Waktu Mulai (Opsional)</label>
            <input type="time" name="start_time">
        </div>

        <div class="form-group">
            <label>Tanggal Selesai (Opsional)</label>
            <input type="date" name="end_date">
        </div>

        <div class="form-group">
            <label>Waktu Selesai (Opsional)</label>
            <input type="time" name="end_time">
        </div>

        {{-- Lokasi Manual --}}
        <div class="form-group">
            <label>Lokasi (Teks – Opsional)</label>
            <input type="text"
                name="location"
                placeholder="Contoh: Aula DPRP Papua Selatan">
        </div>


        {{-- MAP --}}
        <div class="form-group">
            <label>Pin Lokasi di Peta (Opsional)</label>

            <div id="map"
                style="height:300px;border-radius:8px;border:1px solid #e5e7eb;">
            </div>

            <small class="form-hint">
                Klik pada peta untuk menentukan lokasi
            </small>

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="draft">Draft</option>
                <option value="published">Publish</option>
            </select>
        </div>

        {{-- Action --}}
        <div class="form-actions">
            <button class="btn-primary">Simpan</button>
            <a href="{{ route('admin.informasi.agenda.index') }}"
                class="btn-secondary">Batal</a>
        </div>
    </form>
</div>

{{-- CKEditor --}}
@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => console.error(error));
</script>

{{-- Leaflet --}}
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let map = L.map('map').setView([-8.49, 140.40], 13);
        let marker;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        map.on('click', function(e) {
            if (marker) map.removeLayer(marker);

            marker = L.marker(e.latlng).addTo(map);

            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });
    });
</script>
@endpush
@endsection