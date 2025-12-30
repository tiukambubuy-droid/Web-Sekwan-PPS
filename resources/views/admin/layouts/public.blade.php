<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sekretariat DPRP Papua Selatan')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f5f7fa;
            color: #1f2937;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background: #0f172a;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-flex {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }

        /* BRAND */
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
        }

        .brand img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        /* MENU */
        .nav-menu {
            list-style: none;
            display: flex;
            gap: 24px;
            margin: 0;
            padding: 0;
        }

        .nav-menu a {
            color: #e5e7eb;
            text-decoration: none;
            font-size: 14px;
            padding: 8px 0;
            display: block;
        }

        .nav-menu a:hover {
            color: #38bdf8;
        }

        /* DROPDOWN */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: #ffffff;
            min-width: 180px;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            padding: 5px 5px 5px 5px;
            z-index: 999;
        }

        .dropdown-menu li {
            list-style: none;
        }

        .dropdown-menu a {
            color: #1f2937;
            padding: 10px 5px 5px 10px;
            font-size: 14px;
        }

        .dropdown-menu a:hover {
            background: #f1f5f9;
            color: #2563eb;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            background: #111827;
            color: #9ca3af;
            text-align: center;
            padding: 15px;
            font-size: 13px;
        }
    </style>


    @stack('styles')
</head>

<body>

    {{-- NAVBAR DINAMIS --}}
    @include('partials.navbar')

    {{-- KONTEN --}}
    @yield('content')

    <div class="footer">
        © {{ date('Y') }} Sekretariat DPRP Papua Selatan
    </div>

</body>

</html>