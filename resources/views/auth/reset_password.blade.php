<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | EduConnect</title>
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
        input[type="email"],
        input[type="password"] {
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
        input[type="email"]:focus,
        input[type="password"]:focus {
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
        
        /* Animasi */
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

        /* Error styles */
        .alert {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #f87171;
        }
        
        .error-message {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
            display: block;
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
                <h2>Masukkan kata sandi baru</h2>
                
                @if(session('message'))
                <div class="alert">
                    {{ session('message') }}
                </div>
                @endif
                
                <form method="POST" action="{{ route('auth.reset_password_process') }}">
                    @csrf
                    <input type="password" name="new_password" placeholder="Kata sandi baru" required>
                    @error('new_password')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                    
                    <input type="password" name="new_password_confirmation" placeholder="Konfirmasi kata sandi baru" required>
                    
                    <div class="form-links">
                        <a href="{{ route('auth.login') }}">Kembali ke halaman login</a>
                    </div>
                    <button type="submit">Simpan</button>
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>