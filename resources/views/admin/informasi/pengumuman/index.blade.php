@extends('admin.layouts.app')

@section('content')
<div class="card">

    {{-- HEADER --}}
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <h2>Data Pengumuman</h2>
        <a href="{{ route('admin.informasi.pengumuman.create') }}"
           class="btn btn-primary">
            + Tambah Pengumuman
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
            @forelse($pengumumans as $item)
            <tr>
                {{-- THUMBNAIL --}}
                <td style="text-align:center;">
                    @if($item->images->count())
                        <img
                            src="{{ asset('storage/'.$item->images->first()->image_path) }}"
                            class="table-thumb"
                            alt="Thumbnail">
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>

                {{-- JUDUL --}}
                <td>{{ $item->title }}</td>

                {{-- STATUS --}}
                <td>
                    <span class="badge badge-{{ $item->status }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>

                {{-- TANGGAL --}}
                <td>{{ $item->created_at->format('d M Y') }}</td>

                {{-- AKSI --}}
                <td>
                    <div class="action-group">
                        <a href="{{ route('admin.informasi.pengumuman.edit', $item->id) }}"
                           class="btn btn-secondary btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.informasi.pengumuman.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus pengumuman ini?')">
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
                <td colspan="5" style="text-align:center;color:#9ca3af;">
                    Belum ada pengumuman
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
