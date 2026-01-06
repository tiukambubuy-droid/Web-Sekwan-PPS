<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Sekwan PPS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS GLOBAL --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles')

    {{-- Leaflet CSS --}}
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>
    <div class="wrapper">

        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('images/logo papua selatan png.png') }}" alt="Logo Papua Selatan">
                <h2>Sekwan PPS</h2>
            </div>

            <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
            <a href="{{ route('admin.informasi.index') }}">📄 Informasi</a>
            <a href="{{ route('admin.informasi.agenda.index') }}">📅 Agenda</a>
            <a href="#">📁 Dokumen</a>
            <a href="#">🖼️ Galeri</a>
            <a href="{{ route('admin.informasi.pengumuman.index') }}">📢 Pengumuman</a>
        </aside>

        <!-- CONTENT -->
        <div class="content">

            <!-- TOPBAR -->
            <div class="topbar">
                <h3>Dashboard Admin</h3>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>

            <!-- MAIN -->
            <main class="main">
                @yield('content')
            </main>

        </div>
    </div>

    {{-- GLOBAL JS LIBRARIES --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- SCRIPT PER HALAMAN --}}
    @stack('scripts')

</body>
</html>
