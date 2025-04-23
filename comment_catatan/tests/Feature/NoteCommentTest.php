<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Note;
use App\Models\NoteComment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_store_a_comment()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();

        $this->actingAs($user)
             ->post(route('note-comments.store', $note->id), [
                 'content' => 'Ini komentar untuk testing.',
             ])
             ->assertRedirect();

        $this->assertDatabaseHas('note_comments', [
            'note_id' => $note->id,
            'user_id' => $user->id,
            'content' => 'Ini komentar untuk testing.',
        ]);
    }

    /** @test */
    public function user_can_view_comment()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create([
            'file_path' => 'images/IMG_1053.jpg'
        ]);
        $comment = NoteComment::factory()->create([
            'user_id' => $user->id,
            'note_id' => $note->id,
            'content' => 'Ini adalah komentar yang akan dibaca.',
        ]);

        $comment->user()->associate($user);
        $comment->save();

        $response = $this->actingAs($user)->get(route('notes.show', $note->id));
        
        $response->assertStatus(200);
        $response->assertSee('Ini adalah komentar yang akan dibaca.', false);
    }

    /** @test */
    public function user_can_update_own_comment()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();
        $comment = NoteComment::factory()->create([
            'note_id' => $note->id,
            'user_id' => $user->id,
            'content' => 'Komentar awal',
        ]);

        $this->actingAs($user)
             ->put(route('note-comments.update', $comment->id), [
                 'content' => 'Komentar telah diubah.',
             ])
             ->assertRedirect(route('notes.show', $note->id));

        $this->assertDatabaseHas('note_comments', [
            'id' => $comment->id,
            'content' => 'Komentar telah diubah.',
        ]);
    }

    /** @test */
    public function user_can_delete_own_comment()
    {
        $user = User::factory()->create();
        $note = Note::factory()->create();
        $comment = NoteComment::factory()->create([
            'user_id' => $user->id,
            'note_id' => $note->id,
        ]);

        $this->actingAs($user)
             ->delete(route('note-comments.destroy', $comment->id))
             ->assertRedirect();

        $this->assertDatabaseMissing('note_comments', [
            'id' => $comment->id,
        ]);
    }

    /** @test */
    public function user_cannot_delete_someone_elses_comment()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $note = Note::factory()->create();
        $comment = NoteComment::factory()->create([
            'user_id' => $otherUser->id,
            'note_id' => $note->id,
        ]);

        $this->actingAs($user)
             ->delete(route('note-comments.destroy', $comment->id))
             ->assertStatus(403);
    }
}