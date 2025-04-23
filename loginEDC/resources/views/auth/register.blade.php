<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi | EduConnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
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

        .right {
            flex: 1;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            width: 80%;
            max-width: 550px;
        }

        h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #111827;
            text-align: left;
        }

        input, select {
            width: 100%;
            border: none;
            border-bottom: 2px solid #d1d5db;
            padding: 0.5rem 0;
            margin-bottom: 1rem;
            font-size: 1rem;
            background: transparent;
            color: #111827;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input::placeholder {
            color: #9ca3af;
        }

        input:focus, select:focus {
            border-bottom-color: #2563eb;
        }

        button {
            width: 30%;
            background-color: #2563eb;
            color: white;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 1rem;
            transition: background-color 0.3s ease;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        button:hover {
            background-color: #1e40af;
        }

        .login-link {
            text-align: left;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #2563eb;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 0.2rem;
            color: #374151;
        }

        select {
            background-color: transparent;
        }
        
        .form-container {
            width: 90%;
            margin: 0 auto;
            padding: 1rem 0;
            display: flex;        
            justify-content: center
        }
        
        .field-group {
            margin-bottom: 0.5rem;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: -0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    @if (session('message'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Selamat! Kamu sudah terdaftar',
                text: '{{ session("message") }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('auth.login') }}";
                }
            });
        });
    </script>
    @endif
    
    @if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error!',
                html: '@foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif

    <div class="left">
        <h1>EduConnect</h1>
        <p>Connect. Share. Grow.</p>
    </div>
    <div class="right">
        <div class="form-container">
            <form action="{{ route('auth.register_process') }}" method="POST" id="registrationForm">
                @csrf
                <h2>Registrasi</h2>
                
                <div class="field-group">
                    <input type="text" name="full_name" placeholder="Masukkan nama lengkap" required value="{{ old('full_name') }}">
                    @error('full_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="field-group">
                    <input type="email" name="email" placeholder="Masukkan email" required value="{{ old('email') }}">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="field-group">
                    <input type="password" id="password" name="password" placeholder="Kata sandi" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="field-group">
                    <input type="password" id="confirm_password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                </div>

                <div class="field-group">
                    <select name="gender" required>
                        <option value="" disabled selected>Jenis Kelamin</option>
                        <option value="Male">Laki-laki</option>
                        <option value="Female">Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" class="form-control" required value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="security_question">Pilih Pertanyaan Keamanan</label>
                    <select name="security_question" required>
                        <option value="" disabled selected>Pilih Pertanyaan</option>
                        <option value="Apa nama hewan peliharaan pertama Anda?" {{ old('security_question') == 'Apa nama hewan peliharaan pertama Anda?' ? 'selected' : '' }}>Apa nama hewan peliharaan pertama Anda?</option>
                        <option value="Apa nama sekolah dasar Anda?" {{ old('security_question') == 'Apa nama sekolah dasar Anda?' ? 'selected' : '' }}>Apa nama sekolah dasar Anda?</option>
                    </select>
                    @error('security_question')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="field-group">
                    <input type="text" name="security_answer" placeholder="Jawaban Anda" required value="{{ old('security_answer') }}">
                    @error('security_answer')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('auth.login') }}">Login disini</a>
                </div>

                <button type="submit" class="button">Daftar</button>
            </form>
        </div>
    </div>

    <script>
        // Validasi form
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                event.preventDefault();
                Swal.fire({
                    title: 'Error!',
                    text: 'Konfirmasi kata sandi tidak sesuai',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
</body>
</html>