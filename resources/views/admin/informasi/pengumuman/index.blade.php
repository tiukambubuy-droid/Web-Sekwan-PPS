@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/berita.css') }}">
@endpush

@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h2>Data Pengumuman</h2>
        <a href="{{ route('admin.informasi.pengumuman.create') }}" class="btn-primary">
            + Tambah Pengumuman
        </a>
    </div>

    <table class="table-berita">
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th style="width:140px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengumumans as $item)
            <tr>
                <td class="thumb-cell">
                    @if($item->images->count())
                    <img
                        src="{{ asset('storage/' . $item->images->first()->image_path) }}"
                        style="width:80px;height:60px;object-fit:cover;border-radius:6px;">
                    @else
                    <span class="text-muted">Tidak ada</span>
                    @endif
                </td>

                <td>{{ $item->title }}</td>

                <td>
                    <span class="badge badge-{{ $item->status }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>

                <td>{{ $item->created_at->format('d M Y') }}</td>

                <td>
                    <a href="{{ route('admin.informasi.pengumuman.edit', $item->id) }}" class="btn-edit">Edit</a>

                    <form action="{{ route('admin.informasi.pengumuman.destroy', $item->id) }}"
                        method="POST"
                        style="display:inline"
                        onsubmit="return confirm('Yakin hapus pengumuman ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:#9ca3af;">
                    Belum ada pengumuman
                </td>
            </tr>
            @endforelse

        </tbody>
    </table>
</div>
@endsection