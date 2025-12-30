@extends('admin.layouts.app')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between;"><h2>Data Berita</h2>

    <a href="{{ route('admin.berita.create') }}" class="btn-primary">+ Tambah Berita</a>
</div>

    <table style="width:100%; margin-top:15px;">
        <tr>
            <th>Judul</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
        @foreach($beritas as $berita)
        <tr>
            <td>{{ $berita->title }}</td>
            <td>{{ $berita->status }}</td>
            <td>{{ $berita->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
