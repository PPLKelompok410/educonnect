<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pengguna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class LoginTest extends TestCase
{
    /** @test */
    public function halaman_login_dapat_diakses_dan_memuat_elemen_utama()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
        $response->assertSee('EduConnect');
        $response->assertSee('Email');
        $response->assertSee('Kata sandi');
        $response->assertSee('Masuk');
    }

    /** @test */
    public function halaman_registrasi_dapat_diakses_dan_memuat_elemen_utama()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Registrasi');
        $response->assertSee('EduConnect');
        $response->assertSee('Masukkan nama lengkap');
        $response->assertSee('Masukkan email');
        $response->assertSee('Kata sandi');
        $response->assertSee('Konfirmasi Kata Sandi');
        $response->assertSee('Jenis Kelamin');
        $response->assertSee('Tanggal Lahir');
        $response->assertSee('Pilih Pertanyaan Keamanan');
        $response->assertSee('Jawaban Anda');
        $response->assertSee('Daftar');
    }

    /** @test */
    public function klik_belum_punya_akun_dialihkan_ke_registrasi()
    {
        $response = $this->get('/login');

        $response->assertSee('Belum punya akun?');

        $response = $this->followingRedirects()->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Registrasi');
    }

    /** @test */
    public function klik_login_disini_di_laman_registrasi_dialihkan_ke_login()
    {
        $response = $this->get('/register');

        $response->assertSee('Login disini');

        $response = $this->followingRedirects()->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    /** @test */
    public function user_can_register()
    {
        $response = $this->post('/register_process', [
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'gender' => 'Female',
            'date_of_birth' => '2000-01-01',
            'security_question' => 'Apa nama sekolah dasar Anda?',
            'security_answer' => 'Parapat',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('penggunas', [
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function user_can_login()
    {
        $user = Pengguna::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login_process', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertTrue(session()->has('user'));
        $this->assertEquals($user->email, session('user')->email);
    }
}
