<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Pengguna;

class AuthController
{
    public function login()
    {
        if (session()->has('user_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Cek jika login sebagai admin statis
        if ($email === 'admin@gmail.com' && $password === 'admin123') {
            // Buat session untuk admin
            session([
                'user' => (object)[
                    'email' => $email,
                    'full_name' => 'Administrator'
                ],
                'user_id' => 0,
                'login' => true,
                'is_admin' => true,
            ]);
            return redirect()->route('admin.dashboard');
        }

        // Cek apakah email terdaftar di database
        $user = Pengguna::where('email', $email)->first();

        if (!$user) {
            // Email tidak terdaftar
            session()->flash('message', 'Username atau password salah!');
            return redirect()->route('auth.login');
        }

        // Cek password
        if (!Hash::check($password, $user->password)) {
            // Password salah
            session()->flash('message', 'Username atau password salah!');
            return redirect()->route('auth.login');
        }

        // Login berhasil
        session(['user_id' => $user->id, 'login' => true, 'is_admin' => false]);
        return redirect()->route('dashboard');
    }

    public function register()
    {
        if (session()->has('user_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }

    public function register_process(Request $request)
    {
        Log::info('Register process initiated');

        // Tambahkan log untuk debugging password dan password_confirmation
        Log::info('Password:', ['password' => $request->input('password')]);
        Log::info('Password Confirmation:', ['password_confirmation' => $request->input('password_confirmation')]);

        // Validasi input
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:penggunas',
            'password' => 'required|string|confirmed',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date',
            'security_question' => 'required|string',
            'security_answer' => 'required|string',
        ], [
            'password.confirmed' => 'Konfirmasi password Anda salah.', // Pesan kustom
            'password.min' => 'Password harus minimal 8 karakter.',   // Pesan kustom lainnya
            'email.unique' => 'Email sudah terdaftar. Gunakan email lain.', // Pesan tambahan
        ]);

        Log::info('Validation passed', $data);

        // Hash password
        $data['password'] = Hash::make($data['password']);

        // Simpan ke database
        try {
            DB::table('penggunas')->insert($data);
            Log::info('User successfully registered');
        } catch (\Exception $e) {
            Log::error('Error during registration: ' . $e->getMessage());
            session()->flash('message', 'Terjadi kesalahan saat registrasi.');
            return redirect()->route('auth.register');
        }

        session()->flash('message', 'Registrasi berhasil! Silakan login.');
        return redirect()->route('auth.login');
    }

    // Menampilkan halaman lupa password
    public function forgot_password(Request $request)
    {
        return view('auth.forgot_password');
    }

    public function process_forgot_password(Request $request)
    {
        // Validasi email
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');

        // Cari pengguna berdasarkan email
        $user = DB::table('penggunas')->where('email', $email)->first();

        if ($user) {
            // Simpan email dan pertanyaan keamanan ke session
            $request->session()->put('email', $email);
            $request->session()->put('security_question', $user->security_question);

            // Redirect ke halaman pertanyaan keamanan
            return redirect()->route('auth.security_question');
        } else {
            // Jika email tidak terdaftar
            return redirect()->route('auth.forgot_password')->with('message', 'Email belum terdaftar!');
        }
    }

    public function security_question()
    {
        if (!session()->has('security_question')) {
            return redirect()->route('auth.forgot_password');
        }
        return view('auth.security_question', [
            'security_question' => session('security_question')
        ]);
    }

    public function process_security_question(Request $request)
    {
        $request->validate([
            'security_answer' => 'required|string',
        ]);

        $email = session('email');
        $security_answer = $request->input('security_answer');

        // Cari pengguna berdasarkan email
        $user = DB::table('penggunas')->where('email', $email)->first();

        if ($user && strtolower($security_answer) === strtolower($user->security_answer)) {
            // Jawaban benar, redirect ke halaman reset password
            return redirect()->route('auth.reset_password');
        } else {
            return redirect()->route('auth.security_question')->with('message', 'Jawaban pertanyaan keamanan salah!');
        }
    }

    public function reset_password()
    {
        if (!session()->has('email')) {
            return redirect()->route('auth.forgot_password');
        }
        return view('auth.reset_password');
    }

    public function reset_password_process(Request $request)
    {
        // Ambil email dari session (bukan user)
        $email = session('email');

        if (!$email) {
            // Kalau tidak ada email di session, redirect ke forgot password
            return redirect()->route('auth.forgot_password')
                ->with('message', 'Sesi telah berakhir. Silakan ulangi proses lupa password.');
        }

        // Validasi password baru
        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
            'new_password.min' => 'Password minimal 8 karakter.'
        ]);

        try {
            // Update password di database berdasarkan email
            DB::table('penggunas')
                ->where('email', $email)
                ->update([
                    'password' => Hash::make($request->input('new_password')),
                ]);

            // Hapus session email dan security question
            session()->forget(['email', 'security_question']);

            // Redirect ke login page dengan pesan sukses
            return redirect()->route('auth.login')
                ->with('message', 'Password berhasil diubah!.');
        } catch (\Exception $e) {
            return back()->with('message', 'Terjadi kesalahan saat mengubah password. Silakan coba lagi.');
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout(); // Logout user dari sistem
        request()->session()->invalidate(); // Hapus session
        request()->session()->regenerateToken(); // Regenerasi CSRF token

        return redirect('/login')->with('status', 'You have been logged out.');
    }
}
