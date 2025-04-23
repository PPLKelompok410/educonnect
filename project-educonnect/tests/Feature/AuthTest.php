<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Note;

class NoteCrudTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Fake the public disk for file uploads
        Storage::fake('public');

        // Create a dummy user and matkul
        $this->user = User::factory()->create();
        $this->matkul = MataKuliah::factory()->create();

        // Authenticate as the dummy user
        $this->actingAs($this->user);
    }

    public function test_index_returns_ok()
    {
        $response = $this->get(route('notes.index', ['matkul' => $this->matkul->id]));
        $response->assertStatus(200);
    }

    public function test_create_page_returns_ok()
    {
        $response = $this->get(route('notes.create', ['matkul' => $this->matkul->id]));
        $response->assertStatus(200);
    }

    public function test_store_saves_note_and_redirects()
    {
        $file = UploadedFile::fake()->image('test.jpg');

        $response = $this->post(route('notes.store', ['matkul' => $this->matkul->id]), [
            'judul' => 'Judul Test',
            'file' => $file,
        ]);

        $response->assertRedirect(route('notes.index', ['matkul' => $this->matkul->id]));

        $this->assertDatabaseHas('notes', [
            'judul' => 'Judul Test',
            'matkul_id' => $this->matkul->id,
            'user_id' => $this->user->id,
        ]);

        Storage::disk('public')->assertExists('catatan/' . $file->hashName());
    }

    public function test_show_displays_note()
    {
        $note = Note::factory()->create([
            'user_id'   => $this->user->id,
            'matkul_id' => $this->matkul->id,
            'type'      => 'galeri',
        ]);

        $response = $this->get(route('notes.show', $note->id));

        $response->assertStatus(200)
                 ->assertSee($note->judul);
    }

    public function test_edit_page_returns_ok()
    {
        $note = Note::factory()->create([
            'user_id'   => $this->user->id,
            'matkul_id' => $this->matkul->id,
        ]);

        $response = $this->get(route('notes.edit', $note->id));
        $response->assertStatus(200);
    }

    public function test_update_modifies_note_and_redirects()
    {
        // Create existing note with an old image
        $note = Note::factory()->create([
            'user_id'   => $this->user->id,
            'matkul_id' => $this->matkul->id,
            'file_path' => 'catatan/old.jpg',
        ]);
        Storage::disk('public')->put('catatan/old.jpg', 'dummy content');

        $newFile   = UploadedFile::fake()->image('new.jpg');
        $newJudul  = 'Updated Judul';

        $response = $this->put(route('notes.update', $note->id), [
            'judul' => $newJudul,
            'file'  => $newFile,
        ]);

        $response->assertRedirect(route('notes.index', ['matkul' => $this->matkul->id]));

        $this->assertDatabaseHas('notes', [
            'id'    => $note->id,
            'judul' => $newJudul,
        ]);

        Storage::disk('public')->assertMissing('catatan/old.jpg');
        Storage::disk('public')->assertExists('catatan/' . $newFile->hashName());
    }

    public function test_destroy_deletes_note_and_redirects()
    {
        $note = Note::factory()->create([
            'user_id'   => $this->user->id,
            'matkul_id' => $this->matkul->id,
            'file_path' => 'catatan/test.jpg',
        ]);
        Storage::disk('public')->put('catatan/test.jpg', 'dummy');

        $response = $this->delete(route('notes.destroy', $note->id));

        $response->assertRedirect();
        $this->assertDeleted($note);
        Storage::disk('public')->assertMissing('catatan/test.jpg');
    }
}
