<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('devacademy/member/img/logo-devacademy.png') }}" type="image/x-icon" />
    <title>Verifikasi Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body>

    <header>
        <!-- Navbar -->
        <nav class="navbar navbar-light px-3 d-flex justify-content-end">
            <a href="{{ route('member.logout') }}" class="btn btn-danger">Logout</a>
        </nav>
    </header>
    <main>
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <div class="card p-4 text-center">
                    <h3 class="mb-3">Verifikasi Email</h3>
                    <p>Terima kasih telah mendaftar! Silakan verifikasi email Anda untuk melanjutkan.</p>

                    <p>Jika Anda belum menerima email verifikasi, klik tombol di bawah ini untuk mengirim ulang:</p>

                    @if (session('status') != 'limit')
                        <form action="{{ route('verification.resend') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Kirim Ulang Verifikasi</button>
                        </form>
                    @else
                        <button class="btn btn-secondary w-100" disabled>Kirim Ulang Verifikasi</button>
                    @endif
                </div>
            </div>
        </div>
    </main>

    @include('sweetalert::alert')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
