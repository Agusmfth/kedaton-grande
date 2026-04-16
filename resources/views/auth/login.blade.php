<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kedaton Grande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(13, 110, 253, 0.10), transparent 30%),
                radial-gradient(circle at bottom right, rgba(25, 135, 84, 0.08), transparent 28%),
                linear-gradient(135deg, #f8fbff, #eef4f8);
        }

        .login-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 1050px;
            border: none;
            border-radius: 24px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(8px);
            box-shadow: 0 20px 45px rgba(31, 41, 55, 0.12);
        }

        .left-panel {
            background: linear-gradient(180deg, #f4f8fd, #eaf2fb);
            padding: 48px 42px;
            position: relative;
            height: 100%;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(13, 110, 253, 0.08);
            top: -40px;
            right: -40px;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 24px;
            background: rgba(13, 110, 253, 0.06);
            bottom: 30px;
            left: -30px;
            transform: rotate(20deg);
        }

        .brand-badge {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            background: linear-gradient(135deg, #4f8dfd, #76a9fa);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 24px;
            box-shadow: 0 12px 25px rgba(79, 141, 253, 0.28);
            position: relative;
            z-index: 1;
        }

        .system-label {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 600;
            padding: 8px 14px;
            border-radius: 999px;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .left-panel h2 {
            color: #1f2937;
            font-weight: 700;
            line-height: 1.3;
            font-size: 30px;
            position: relative;
            z-index: 1;
        }

        .left-panel p {
            color: #4b5563;
            font-size: 15px;
            line-height: 1.8;
            margin-top: 18px;
            position: relative;
            z-index: 1;
        }

        .feature-box {
            margin-top: 28px;
            display: grid;
            gap: 14px;
            position: relative;
            z-index: 1;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.75);
            border: 1px solid #e5edf6;
            border-radius: 16px;
            padding: 14px 16px;
            color: #334155;
            font-size: 14px;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.04);
        }

        .right-panel {
            padding: 48px 42px;
            background: rgba(255, 255, 255, 0.88);
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 14px;
            padding: 13px 15px;
            border: 1px solid #d9e2ec;
            background: #fdfefe;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.18rem rgba(13, 110, 253, 0.12);
        }

        .form-check-label,
        .helper-link,
        .footer-text {
            font-size: 14px;
        }

        .helper-link {
            color: #3b82f6;
            text-decoration: none;
        }

        .helper-link:hover {
            text-decoration: underline;
        }

        .btn-login {
            background: linear-gradient(135deg, #4f8dfd, #3b82f6);
            border: none;
            border-radius: 14px;
            padding: 13px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 12px 22px rgba(59, 130, 246, 0.22);
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #3d7ef7, #2563eb);
        }

        .footer-text {
            color: #94a3b8;
        }

        @media (max-width: 767px) {
            .left-panel,
            .right-panel {
                padding: 32px 24px;
            }

            .left-panel h2 {
                font-size: 24px;
            }

            .form-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <section class="login-section">
        <div class="login-card">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="left-panel">
                        <div class="brand-badge">KG</div>
                        <span class="system-label">Sistem Informasi Pelayanan</span>
                        <h2>
                            Kedaton Grande<br>
                            Layanan Serah Terima Kunci & Pengaduan Konsumen
                        </h2>
                        <p>
                            Aplikasi ini membantu proses pengelolaan serah terima kunci rumah,
                            pencatatan pengaduan konsumen, tindak lanjut perbaikan, dan penyajian
                            laporan secara lebih tertata, cepat, dan profesional.
                        </p>

                        <div class="feature-box">
                            <div class="feature-item">Pengelolaan data serah terima kunci yang lebih rapi</div>
                            <div class="feature-item">Pencatatan pengaduan konsumen secara terstruktur</div>
                            <div class="feature-item">Monitoring progres perbaikan dan pelaporan</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="right-panel">
                        <h3 class="form-title">Selamat Datang</h3>
                        <div class="form-subtitle">
                            Silakan masuk menggunakan akun Anda untuk mengakses sistem.
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email"
                                    required
                                    autofocus
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
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
                                    Login ke Sistem
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4 footer-text">
                            &copy; {{ date('Y') }} Kedaton Grande
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>