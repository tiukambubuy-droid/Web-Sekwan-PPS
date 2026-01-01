@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/berita.css') }}">
@endpush



@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h2>Data Berita</h2>
        <a href="{{ route('admin.informasi.berita.create') }}" class="btn-primary">+ Tambah Berita</a>
    </div>

    <table class="table-berita">
    <thead>
        <tr>
            <th>Thumbnail</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th style="width:120px; text-align:center;">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($beritas as $berita)
        <tr>
            <td class="thumb-cell">
                @if($berita->thumbnail)
                    <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="thumbnail">
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </td>

            <td class="title-cell">{{ $berita->title }}</td>

            <td>
                <span class="badge badge-{{ $berita->status }}">
                    {{ ucfirst($berita->status) }}
                </span>
            </td>

            <td class="date-cell">
                {{ $berita->created_at->format('d M Y') }}
            </td>

            {{-- 🔥 AKSI --}}
            <td class="action-cell">
                <a href="{{ route('admin.informasi.berita.edit', $berita->id) }}"
                   class="btn-action btn-edit">
                    Edit
                </a>

                <form action="{{ route('admin.informasi.berita.destroy', $berita->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin hapus berita ini?')"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
