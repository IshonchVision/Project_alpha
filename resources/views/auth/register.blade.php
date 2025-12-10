<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ro‘yxatdan o‘tish - Edukate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
        }
        .card {
            border-radius: 1rem;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #2575fc;
        }
        .btn-primary {
            background-color: #2575fc;
            border: none;
        }
        .btn-primary:hover {
            background-color: #6a11cb;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg p-4">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Ro‘yxatdan o‘tish</h3>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Ismingiz</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Ismingiz" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email manzilingiz</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email manzil" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Parol</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Parol" required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Parolni tasdiqlang</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Parolni takrorlang" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Ro‘yxatdan o‘tish</button>
                </form>

                <p class="mt-3 text-center">
                    Hisobingiz bormi? <a href="{{ route('login') }}">Kirish</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
