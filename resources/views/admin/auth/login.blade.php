<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin | Sekwan PPS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1f2937, #111827);
        }

        .login-box {
            background: #ffffff;
            width: 380px;
            padding: 35px 30px;
            border-radius: 14px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            text-align: center;
        }

        .login-box img {
            width: 155px;
            margin-bottom: 10px;
        }

        .login-box h2 {
            margin: 3px 0;
            color: #111827;
        }

        .login-box p {
            font-size: 14px;
            color: #6b7280;
            margin-top: 5px;
            margin-bottom: 25px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
            color: #374151;
        }

        .form-group input {
            width: 100%;
            padding: 11px 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            transition: 0.2s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37,99,235,0.15);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .footer-text {
            margin-top: 20px;
            font-size: 12px;
            color: #9ca3af;
        }
    </style>
</head>
<body>

<div class="login-box">

    <!-- LOGO -->
    <img src="{{ asset('images/logo papua selatan png.png') }}" alt="Logo Papua Selatan">

    <h2>Login Admin</h2>
    <p>Sekretariat DPRP Papua Selatan</p>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" class="btn-login">Masuk</button>
    </form>

    <div class="footer-text">
        © {{ date('Y') }} Pemerintah Provinsi Papua Selatan
    </div>

</div>

</body>
</html>
