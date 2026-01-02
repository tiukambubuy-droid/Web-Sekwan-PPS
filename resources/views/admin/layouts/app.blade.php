<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Sekwan PPS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", sans-serif;
        }

        body {
            background: #f4f6f9;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #1f2937;
            color: #fff;
            padding: 20px;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .sidebar-brand img {
            width: 70px;
            margin-left: 10px;
            margin-bottom: -20px;
            height: auto;
        }

        .sidebar-brand span {
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
            line-height: 1.2;
        }



        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 10px;
            margin-top: 20px;
            margin-left: -10px;
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #374151;
            color: #fff;
        }

        /* CONTENT */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* TOPBAR */
        .topbar {
            background: #ffffff;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        }

        .topbar h3 {
            font-size: 18px;
            color: #111827;
        }

        .topbar form button {
            background: #dc2626;
            border: none;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        /* MAIN */
        .main {
            padding: 25px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        /* ===== ADMIN FORM STYLE ===== */
        .form-card {
            background: #ffffff;
            max-width: 720px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .form-card h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 20px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 14px;
            color: #374151;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.15);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-actions {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            margin-left: 150px;
        }

        .btn-primary:hover {
            background: #1e40af;
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        /* DASHBOARD CONTENT */
        .dashboard-wrapper {
            max-width: 1000px;
            margin: 20px;
        }

        .dashboard-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .dashboard-header .subtitle {
            margin-top: 6px;
            color: #6b7280;
            font-size: 14px;
        }

        /* DASHBOARD CARDS */
        .dashboard-cards {
            margin-top: 25px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .dashboard-card {
            display: flex;
            gap: 15px;
            padding: 18px;
            background: #ffffff;
            border-radius: 10px;
            text-decoration: none;
            color: #111827;
            border: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        .card-icon {
            font-size: 32px;
            line-height: 1;
        }

        .card-body h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }

        .card-body p {
            margin-top: 6px;
            font-size: 13px;
            color: #6b7280;
        }

        .tag-checkbox {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 6px;
        }

        .tag-item {
            display: flex;
            align-items: center;
            /* 🔑 bikin sejajar */
            gap: 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .tag-item input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .form-group input[type="file"] {
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            background: #fff;
        }

        .form-hint {
            display: block;
            margin-top: 4px;
            font-size: 12px;
            color: #6b7280;
        }

        .ck-editor__editable {
            min-height: 300px;
            font-size: 14px;
            line-height: 1.6;
        }
    </style>
</head>

@stack('scripts')


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
            <a href="#">📅 Agenda</a>
            <a href="#">📁 Dokumen</a>
            <a href="#">🖼️ Galeri</a>
            <a href="#">📢 Pengumuman</a>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>

    
</body>

</html>