@extends('admin.layouts.app')

@section('content')
<div class="form-card">
    <h2>Edit Agenda</h2>

    <form method="POST"
        action="{{ route('admin.informasi.agenda.update', $agenda->id) }}">
        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div class="form-group">
            <label>Judul Agenda</label>
            <input type="text"
                name="title"
                value="{{ old('title', $agenda->title) }}"
                required>
        </div>

        {{-- Deskripsi --}}
        <div class="form-group">
            <label>Deskripsi Agenda</label>
            <textarea name="description"
                id="editor"
                rows="6"
                required>{{ old('description', $agenda->description) }}</textarea>
        </div>

        {{-- Tanggal & Waktu --}}
        <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date"
                name="start_date"
                value="{{ old('start_date', optional($agenda->start_date)->format('Y-m-d')) }}"
                required>
        </div>

        <div class="form-group">
            <label>Waktu Mulai (Opsional)</label>
            <input type="time"
                name="start_time"
                value="{{ old('start_time', $agenda->start_time) }}">
        </div>

        <div class="form-group">
            <label>Tanggal Selesai (Opsional)</label>
            <input type="date"
                name="end_date"
                value="{{ old('end_date', optional($agenda->end_date)->format('Y-m-d')) }}">
        </div>

        <div class="form-group">
            <label>Waktu Selesai (Opsional)</label>
            <input type="time"
                name="end_time"
                value="{{ old('end_time', $agenda->end_time) }}">
        </div>

        {{-- Lokasi Manual --}}
        <div class="form-group">
            <label>Lokasi (Teks – Opsional)</label>
            <input type="text"
                name="location"
                value="{{ old('location', $agenda->location) }}">
        </div>

        {{-- MAP --}}
        <div class="form-group">
            <label>Pin Lokasi di Peta (Opsional)</label>

            <div id="map"
                data-lat="{{ $agenda->latitude }}"
                data-lng="{{ $agenda->longitude }}"
                style="height:300px;border-radius:8px;border:1px solid #e5e7eb;">
            </div>


            <small class="form-hint">
                Klik peta untuk menentukan lokasi
            </small>

            <input type="hidden"
                name="latitude"
                id="latitude"
                value="{{ $agenda->latitude }}">

            <input type="hidden"
                name="longitude"
                id="longitude"
                value="{{ $agenda->longitude }}">
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="draft"
                    {{ $agenda->status === 'draft' ? 'selected' : '' }}>
                    Draft
                </option>
                <option value="published"
                    {{ $agenda->status === 'published' ? 'selected' : '' }}>
                    Publish
                </option>
            </select>
        </div>

        {{-- Action --}}
        <div class="form-actions">
            <button class="btn-primary">Update</button>
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