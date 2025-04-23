<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\MataKuliah;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MataKuliahTest extends TestCase
{
    use RefreshDatabase;

     public function home_page_can_be_accessed()
     {
         $response = $this->get('/');
         $response->assertStatus(200);
     }

    public function test_mata_kuliah_page_loads()
    {
        $response = $this->get('/matkul/manage'); 
        $response->assertStatus(200);
    }

    public function test_manage_page_displays_data()
    {
        MataKuliah::factory()->create([
            'nama' => 'Basis Data',
            'kode' => 'MK002',
            'prodi' => 'Sistem Informasi',
        ]);

        $response = $this->get('/matkul/manage');

        $response->assertStatus(200);
        $response->assertSee('Basis Data');
    }
    public function test_can_create_mata_kuliah()
    {
        $data = [
            'nama' => 'Kecerdasan Buatan',
            'kode' => 'MK003',
            'prodi' => 'Informatika',
        ];

        $response = $this->post('/matkul', $data);
        $response->assertRedirect('/matkul/manage');
        $this->assertDatabaseHas('mata_kuliahs', $data);
    }

    public function test_can_view_mata_kuliah()
    {
        $matkul = MataKuliah::factory()->create([
            'nama' => 'Sistem Operasi',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Sistem Operasi');
    }

    public function test_can_update_mata_kuliah()
    {
        $matkul = MataKuliah::factory()->create([
            'nama' => 'Algoritma',
            'kode' => 'MK004',
            'prodi' => 'TI',
        ]);

        $response = $this->put("/matkul/{$matkul->id}", [
            'nama' => 'Algoritma dan Pemrograman',
            'kode' => 'MK004',
            'prodi' => 'Teknik Informatika',
        ]);

        $response->assertRedirect('/matkul/manage');
        $this->assertDatabaseHas('mata_kuliahs', [
            'nama' => 'Algoritma dan Pemrograman',
            'prodi' => 'Teknik Informatika',
        ]);
    }

    public function test_can_delete_mata_kuliah()
    {
        $matkul = MataKuliah::factory()->create();

        $response = $this->delete("/matkul/{$matkul->id}");

        $response->assertRedirect('/matkul/manage');
        $this->assertDatabaseMissing('mata_kuliahs', ['id' => $matkul->id]);
    }

    public function test_store_with_image()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('sampul.jpg');

        $response = $this->post('/matkul', [
            'nama' => 'Multimedia',
            'kode' => 'MK005',
            'prodi' => 'DKV',
            'gambar' => $file,
        ]);

        $response->assertRedirect('/matkul/manage');

        // Ambil nama file berdasarkan yang digunakan di controller
        $expectedFileName = now()->timestamp . '_' . $file->getClientOriginalName();

        Storage::disk('public')->assertExists('sampul/' . $expectedFileName);
        $this->assertDatabaseHas('mata_kuliahs', [
            'kode' => 'MK005',
            'gambar' => $expectedFileName,
        ]);
    }

}