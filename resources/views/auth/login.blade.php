<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kedaton Grande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
    <style>
        :root {
            --estate-green: #0f766e;
            --estate-teal: #14b8a6;
            --estate-gold: #d6a84f;
            --estate-ink: #172033;
            --estate-muted: #64748b;
            --estate-line: #e6ebf2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background:
                linear-gradient(rgba(15, 23, 42, 0.38), rgba(15, 23, 42, 0.38)),
                url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=1800&q=80');
            background-position: center;
            background-size: cover;
            color: var(--estate-ink);
            font-family: "Segoe UI", Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
        }

        .login-page {
            align-items: center;
            display: flex;
            min-height: 100vh;
            padding: 28px;
        }

        .login-shell {
            background: rgba(255, 255, 255, 0.94);
            border: 1px solid rgba(255, 255, 255, 0.72);
            border-radius: 8px;
            box-shadow: 0 28px 70px rgba(15, 23, 42, 0.28);
            margin: 0 auto;
            max-width: 1120px;
            overflow: hidden;
            width: 100%;
        }

        .brand-panel {
            background:
                linear-gradient(135deg, rgba(15, 118, 110, 0.94), rgba(23, 32, 51, 0.92)),
                url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80');
            background-position: center;
            background-size: cover;
            color: #fff;
            min-height: 640px;
            padding: 42px;
            position: relative;
        }

        .brand-panel::after {
            background: linear-gradient(180deg, transparent, rgba(15, 23, 42, 0.42));
            bottom: 0;
            content: "";
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
        }

        .brand-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            align-items: center;
            display: flex;
            gap: 12px;
        }

        .brand-mark {
            align-items: center;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.28);
            border-radius: 8px;
            display: flex;
            font-size: 18px;
            font-weight: 800;
            height: 46px;
            justify-content: center;
            width: 46px;
        }

        .brand-name {
            font-size: 22px;
            font-weight: 800;
            line-height: 1.1;
        }

        .brand-subtitle {
            color: rgba(255, 255, 255, 0.72);
            font-size: 13px;
            margin-top: 2px;
        }

        .brand-copy {
            max-width: 520px;
        }

        .brand-copy span {
            background: rgba(214, 168, 79, 0.18);
            border: 1px solid rgba(214, 168, 79, 0.38);
            border-radius: 999px;
            color: #ffe6a6;
            display: inline-block;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 18px;
            padding: 8px 14px;
        }

        .brand-copy h1 {
            font-size: 36px;
            font-weight: 800;
            line-height: 1.22;
            margin-bottom: 16px;
        }

        .brand-copy p {
            color: rgba(255, 255, 255, 0.82);
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 0;
        }

        .feature-grid {
            display: grid;
            gap: 12px;
            grid-template-columns: repeat(3, 1fr);
            margin-top: 30px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 8px;
            padding: 14px;
        }

        .feature-card i {
            color: #ffe6a6;
            margin-bottom: 10px;
        }

        .feature-card strong {
            display: block;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .feature-card small {
            color: rgba(255, 255, 255, 0.72);
        }

        .form-panel {
            align-items: center;
            background: #fff;
            display: flex;
            min-height: 640px;
            padding: 42px;
        }

        .form-wrap {
            margin: 0 auto;
            max-width: 430px;
            width: 100%;
        }

        .form-kicker {
            color: var(--estate-green);
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .form-title {
            color: var(--estate-ink);
            font-size: 30px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: var(--estate-muted);
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .form-label {
            color: #344054;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .input-group-text {
            background: #f8fafc;
            border-color: var(--estate-line);
            border-radius: 8px 0 0 8px;
            color: var(--estate-muted);
            width: 46px;
        }

        .form-control {
            border-color: var(--estate-line);
            border-radius: 0 8px 8px 0;
            min-height: 48px;
        }

        .form-control:focus {
            border-color: var(--estate-teal);
            box-shadow: 0 0 0 0.18rem rgba(20, 184, 166, 0.14);
        }

        .form-check-input:checked {
            background-color: var(--estate-green);
            border-color: var(--estate-green);
        }

        .helper-link {
            color: var(--estate-green);
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .helper-link:hover {
            color: #0b5f59;
            text-decoration: underline;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--estate-green), var(--estate-teal));
            border: 0;
            border-radius: 8px;
            box-shadow: 0 14px 28px rgba(20, 184, 166, 0.24);
            font-weight: 800;
            min-height: 48px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #0b5f59, #0d9488);
        }

        .login-note {
            background: #f8fafc;
            border: 1px solid var(--estate-line);
            border-radius: 8px;
            color: var(--estate-muted);
            font-size: 13px;
            line-height: 1.6;
            margin-top: 22px;
            padding: 14px;
        }

        .footer-text {
            color: #94a3b8;
            font-size: 13px;
            margin-top: 24px;
            text-align: center;
        }

        @media (max-width: 991px) {
            .brand-panel,
            .form-panel {
                min-height: auto;
            }

            .brand-panel {
                padding: 32px;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 575px) {
            .login-page {
                padding: 14px;
            }

            .brand-panel,
            .form-panel {
                padding: 26px 22px;
            }

            .brand-copy h1,
            .form-title {
                font-size: 25px;
            }
        }
    </style>
</head>
<body>
    <main class="login-page">
        <div class="login-shell">
            <div class="row g-0">
                <div class="col-lg-6">
                    <section class="brand-panel">
                        <div class="brand-content">
                            <div class="brand-logo">
                                <div class="brand-mark">KG</div>
                                <div>
                                    <div class="brand-name">Kedaton Grande</div>
                                    <div class="brand-subtitle">Residential Service Portal</div>
                                </div>
                            </div>

                            <div class="brand-copy">
                                <span>Perumahan Kedaton Grande</span>
                                <h1>Layanan penghuni yang tertata, cepat, dan transparan.</h1>
                                <p>Kelola serah terima kunci, pantau pengaduan pasca-serah-terima, dan ikuti proses perbaikan dari satu sistem terpadu.</p>

                                <div class="feature-grid">
                                    <div class="feature-card">
                                        <i class="fas fa-key"></i>
                                        <strong>Serah Terima</strong>
                                        <small>Data konsumen dan unit rumah lebih rapi.</small>
                                    </div>
                                    <div class="feature-card">
                                        <i class="fas fa-comments"></i>
                                        <strong>Pengaduan</strong>
                                        <small>Keluhan tercatat dan mudah dipantau.</small>
                                    </div>
                                    <div class="feature-card">
                                        <i class="fas fa-tools"></i>
                                        <strong>Perbaikan</strong>
                                        <small>Progres lapangan tampil jelas.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-lg-6">
                    <section class="form-panel">
                        <div class="form-wrap">
                            <div class="form-kicker">Akses Sistem</div>
                            <h2 class="form-title">Masuk ke Akun</h2>
                            <p class="form-subtitle">Gunakan akun yang telah diberikan oleh pengelola Kedaton Grande untuk mengakses layanan.</p>

                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="nama@email.com"
                                            required
                                            autofocus
                                        >
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Masukkan password"
                                            required
                                        >
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                        <label class="form-check-label" for="remember_me">
                                            Ingat saya
                                        </label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="helper-link">
                                            Lupa password?
                                        </a>
                                    @endif
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-login">
                                        Masuk ke Sistem
                                    </button>
                                </div>
                            </form>

                            <div class="login-note">
                                <strong>Informasi akses:</strong> akun admin, petugas lapangan, pimpinan, dan konsumen dikelola oleh pengelola perumahan.
                            </div>

                            <div class="footer-text">
                                &copy; {{ date('Y') }} Kedaton Grande. All rights reserved.
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
