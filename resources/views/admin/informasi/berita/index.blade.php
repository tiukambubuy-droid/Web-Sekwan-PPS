@extends('admin.layouts.app')

@section('content')
<div class="card">

    {{-- HEADER --}}
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <h2>Data Berita</h2>
        <a href="{{ route('admin.informasi.berita.create') }}"
            class="btn btn-primary">
            + Tambah Berita
        </a>
    </div>

    {{-- TABLE --}}
    <table>
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($beritas as $berita)
            <tr>
                {{-- Thumbnail --}}
                <td>
                    @if($berita->thumbnail)
                    <img src="{{ asset('storage/'.$berita->thumbnail) }}"
                        class="table-thumb"
                        alt="Thumbnail">
                    @else
                    <span class="text-muted">Tidak ada</span>
                    @endif
                </td>

                {{-- Judul --}}
                <td>{{ $berita->title }}</td>

                {{-- Status --}}
                <td>
                    <span class="badge badge-{{ $berita->status }}">
                        {{ ucfirst($berita->status) }}
                    </span>
                </td>

                {{-- Tanggal --}}
                <td>{{ $berita->created_at->format('d M Y') }}</td>

                {{-- Aksi --}}
                <td>
                    <div class="action-group">
                        <a href="{{ route('admin.informasi.berita.edit', $berita->id) }}"
                            class="btn btn-secondary btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.informasi.berita.destroy', $berita->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin hapus berita ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:#6b7280;padding:20px;">
                    Belum ada data berita
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection