<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Tasdiqlash</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e0f2fe, #bae6fd);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #1e40af;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            text-align: left;
            font-weight: 600;
            color: #374151;
        }

        input[type="text"] {
            padding: 14px;
            font-size: 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: border 0.3s;
        }

        input[type="text"]:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        button {
            padding: 14px;
            background: #3b82f6;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #2563eb;
        }

        .icon {
            font-size: 48px;
            margin-bottom: 20px;
            color: #3b82f6;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="icon">📧</div>
        <h3>Email tasdiqlash</h3>

        @if(session('error'))
        <p class="error">{{ session('error') }}</p>
        @endif

        <form action="{{ route('verify.check') }}" method="POST">
            @csrf
            <input type="hidden" name="email" value="{{ request('email') }}">

            <label for="code">Tasdiqlash kodi:</label>
            <input type="text" id="code" name="code" required placeholder="Kod kiriting">

            <button type="submit">Tasdiqlash</button>
        </form>
    </div>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        @if(session('success'))
        toastr.success("{{ session('success') }}")
        @endif

        @if(session('error'))
        toastr.error("{{ session('error') }}")
        @endif
    </script>
</body>

</html>