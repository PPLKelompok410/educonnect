<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EduConnect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
            perspective: 1000px;
        }
        .page-wrapper {
            display: flex;
            width: 100%;
            height: 100%;
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55), opacity 0.4s ease;
        }
        .left {
            flex: 1;
            background: linear-gradient(to bottom right, #2563eb, #3b82f6);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        }
        .left h1 {
            font-size: 48px;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .left p {
            font-size: 18px;
            font-weight: 300;
        }
        .left img {
            width: 160px;
            margin-bottom: 1rem;
        }
        .right {
            flex: 1;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55), opacity 0.3s ease;
        }
        .form-container {
            width: 80%;
            max-width: 400px;
            transition: transform 0.25s ease, opacity 0.25s ease;
        }
        .form-container h2 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: #000;
        }
        input[type="email"] {
            width: 100%;
            padding: 0.75rem 0;
            margin-bottom: 1.5rem;
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 1rem;
            outline: none;
            background: transparent;
            transition: border-color 0.3s ease;
        }
        input[type="email"]:focus {
            border-bottom-color: #2563eb;
        }

        .form-links {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        .form-links a {
            color: #2563eb;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .form-links a:hover {
            color: #1e40af;
        }
        button {
            width: 40%;
            background-color: #2563eb;
            color: white;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 0.5rem;
            transition: background-color 0.3s ease;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        button:hover {
            background-color: #1e40af;
        }
        
        /* Animasi yang lebih cepat */
        .animate-out {
            transform: translateX(-100%) rotateY(10deg);
            opacity: 0;
            pointer-events: none;
        }
        
        .left.animate-out {
            transform: translateX(-120%) rotateY(20deg);
        }
        
        .right.animate-out {
            transform: translateX(-80%) rotateY(5deg);
            opacity: 0;
        }
        
        .form-container.animate-out {
            transform: translateX(-50px) scale(0.95);
            opacity: 0;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            font-size: 0.9rem;
            border: 1px solid #86efac;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            font-size: 0.9rem;
            border: 1px solid #fecaca;
        }

        .password-field {
            position: relative;
            width: 100%;
            margin-bottom: 1.5rem;
        }

        .password-field input {
            width: 100%;
            padding: 0.75rem 0;
            padding-right: 2.5rem;
            border: none;
            border-bottom: 2px solid #ccc;
            font-size: 1rem;
            background: transparent;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .password-field input:focus {
            border-bottom-color: #2563eb;
        }

        .toggle-password {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6b7280;
            padding: 0.5rem;
            transition: color 0.2s;
            background: none;
            border: none;
            font-size: 1rem;
        }

        .toggle-password:hover {
            color: #2563eb;
        }

        /* Hilangkan ikon mata default browser */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
        
        input[type="password"]::-webkit-credentials-auto-fill-button {
            display: none !important;
        }
        
        input[type="password"]::-webkit-strong-password-auto-fill-button {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="page-wrapper" id="page-wrapper">
        <div class="left" id="left-panel">
            <h1>EduConnect</h1>
            <p>Connect. Share. Grow.</p>
        </div>

        <div class="right" id="right-panel">
            <div class="form-container" id="form-container">
                <h2>Login</h2>
                <form method="POST" action="{{ route('auth.login_process') }}">
                    @csrf
                    @if(session('message'))
                    <div class="{{ str_contains(session('message'), 'berhasil') ? 'alert-success' : 'alert-error' }}">
                        {{ session('message') }}
                    </div>
                    @endif
                    <input type="email" name="email" placeholder="Email" required>
                    <div class="password-field">
                        <input type="password" name="password" id="password" placeholder="Kata sandi" required autocomplete="current-password">
                        <i class="toggle-password fas fa-eye" onclick="togglePassword('password')"></i>
                    </div>

                    <div class="form-links">
                        <a href="{{ route('auth.forgot_password') }}">Lupa Password?</a>
                        <a href="{{ route('auth.register') }}" id="register-link">Belum punya akun?</a>
                    </div>

                    <button type="submit">Masuk</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Script untuk animasi yang lebih cepat
        document.getElementById('register-link').addEventListener('click', function(e) {
            e.preventDefault();
            
            // Simpan URL tujuan
            const targetUrl = this.getAttribute('href');
            
            // Animasi elemen secara berurutan dengan timing yang lebih cepat
            const formContainer = document.getElementById('form-container');
            const rightPanel = document.getElementById('right-panel');
            const leftPanel = document.getElementById('left-panel');
            const pageWrapper = document.getElementById('page-wrapper');
            
            // Animasi semua elemen hampir bersamaan untuk kesan lebih cepat
            formContainer.classList.add('animate-out');
            
            setTimeout(() => {
                rightPanel.classList.add('animate-out');
                leftPanel.classList.add('animate-out');
                pageWrapper.classList.add('animate-out');
            }, 60); // Waktu delay sangat singkat
            
            // Pindah halaman lebih cepat
            setTimeout(() => {
                window.location.href = targetUrl;
            }, 30); // Total durasi animasi hanya 400ms
        });

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling;

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>