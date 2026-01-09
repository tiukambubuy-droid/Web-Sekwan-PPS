@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/infografis.css') }}">
@endpush


@section('content')
<div class="card">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <h3>Data Infografis</h3>
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

    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f1f5f9;">
                <th style="padding:12px;">Judul</th>
                <th style="padding:12px;">Preview</th>
                <th style="padding:12px;">Status</th>
                <th style="padding:12px;">Jumlah Gambar</th>
                <th style="padding:12px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($infografis as $item)
            <tr style="border-top:1px solid #e5e7eb;">
                <td style="padding:12px;font-weight:600;">
                    {{ $item->judul }}
                </td>

                <td style="padding:12px;text-align:center;">
                    @if($item->images->first())
                    <img
                        src="{{ asset('storage/'.$item->images->first()->image_path) }}"
                        class="infografis-thumb"
                        alt="Preview Infografis">
                    @else
                    —
                    @endif
                </td>


                <td style="padding:12px;text-align:center;">
                    <span class="badge bg-{{ $item->status=='publish'?'success':'secondary' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>

                <td style="padding:12px;text-align:center;">
                    {{ $item->images->count() }}
                </td>

                <td class="text-center">
                    <div class="action-group">
                        <a href="{{ route('admin.informasi.infografis.edit',$item->id) }}"
                            class="btn btn-secondary btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.informasi.infografis.destroy',$item->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin hapus infografis ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding:16px;text-align:center;color:#6b7280;">
                    Belum ada data infografis
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection