<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 | Sahifa topilmadi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
        }

        .container {
            text-align: center;
            animation: fadeIn 1.2s ease-in-out;
        }

        h1 {
            font-size: 180px;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(90deg, #00f2fe, #4facfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: float 3s ease-in-out infinite;
        }

        h2 {
            font-size: 28px;
            margin-top: 10px;
            font-weight: 600;
        }

        p {
            margin-top: 10px;
            color: #cfd9df;
        }

        a {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 30px;
            background: #00f2fe;
            color: #000;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        a:hover {
            background: #4facfe;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 242, 254, 0.4);
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
            animation: move 20s linear infinite;
        }

        .circle.one {
            width: 300px;
            height: 300px;
            background: #00f2fe;
            top: 10%;
            left: 5%;
        }

        .circle.two {
            width: 200px;
            height: 200px;
            background: #4facfe;
            bottom: 15%;
            right: 10%;
            animation-duration: 15s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        @keyframes move {
            0% { transform: translateY(0); }
            50% { transform: translateY(-50px); }
            100% { transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="circle one"></div>
    <div class="circle two"></div>

    <div class="container">
        <h1>404</h1>
        <h2>Oops! Sahifa topilmadi 😕</h2>
        <p>Sen qidirgan sahifa yo‘q yoki ko‘chirilgan bo‘lishi mumkin.</p>

        <a href="{{ url('/') }}">🏠 Bosh sahifaga qaytish</a>
    </div>

</body>
</html>
