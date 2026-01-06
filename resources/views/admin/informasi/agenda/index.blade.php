@extends('admin.layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
@endpush

@section('content')
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h2>Data Agenda</h2>
        <a href="{{ route('admin.informasi.agenda.create') }}" class="btn-primary">
            + Tambah Agenda
        </a>
    </div>

    <table class="table-agenda">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th style="width:160px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agendas as $agenda)
            <tr>
                <td class="agenda-title">
                    {{ $agenda->title }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($agenda->start_date)->format('d M Y') }}
                </td>

                <td class="agenda-location">
                    {{ $agenda->location ?? '-' }}
                </td>

                <td>
                    <span class="badge badge-{{ $agenda->status }}">
                        {{ ucfirst($agenda->status) }}
                    </span>
                </td>

                <td>
                    <div class="action-buttons">
                        <a href="{{ route('admin.informasi.agenda.edit', $agenda->id) }}"
                           class="btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('admin.informasi.agenda.destroy', $agenda->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus agenda ini?')"
                                    class="btn-delete">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;color:#6b7280;padding:20px;">
                    Belum ada agenda
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
