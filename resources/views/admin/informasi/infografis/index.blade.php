@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/infografis.css') }}">
@endpush

@section('content')
<div class="infografis-wrapper">

    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h4>Infografis</h4>
        <a href="{{ route('admin.informasi.infografis.create') }}"
            class="btn btn-primary">
            + Tambah Infografis
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="infografis-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Preview</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Jumlah Gambar</th>
                <th width="20%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($infografis as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($item->images->first())
                    <img src="{{ asset('storage/'.$item->images->first()->image_path) }}"
                        class="infografis-thumb"
                        alt="Preview">
                    @else
                    —
                    @endif
                </td>

                <td>{{ $item->judul }}</td>
                <td>
                    <span class="badge bg-{{ $item->status == 'publish' ? 'success' : 'secondary' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td>{{ $item->images->count() }}</td>
                <td>
                    <div class="infografis-actions-inline">
                        <a href="{{ route('admin.informasi.infografis.edit', $item->id) }}"
                            class="btn btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('admin.informasi.infografis.destroy', $item->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin hapus infografis ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">
                    Belum ada data infografis
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection