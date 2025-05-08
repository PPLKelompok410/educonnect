<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function comment_can_be_created()
    {
        // Membuat user, mata kuliah, dan komentar
        $user = User::factory()->create();
        $matkul = MataKuliah::factory()->create();
        
        // Menggunakan factory untuk membuat komentar
        $commentData = [
            'comment' => 'Ini adalah komentar pertama!',
            'user_id' => $user->id,
            'matkul_id' => $matkul->id
        ];
        
        // Melakukan request POST untuk menyimpan komentar
        $response = $this->actingAs($user)->post(route('comments.store', $matkul->id), $commentData);
        
        // Memastikan komentar berhasil disimpan dan redirect ke halaman yang benar
        $response->assertRedirect(route('matkul.discussion', $matkul->id));
        $this->assertDatabaseHas('comments', $commentData);
    }

    /** @test */
    public function comment_can_be_updated()
    {
        // Membuat user, mata kuliah, dan komentar
        $user = User::factory()->create();
        $matkul = MataKuliah::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'matkul_id' => $matkul->id
        ]);
        
        // Data komentar yang akan diperbarui
        $updatedCommentData = ['comment' => 'Komentar yang telah diperbarui'];
        
        // Melakukan request PUT untuk memperbarui komentar
        $response = $this->actingAs($user)->put(route('comments.update', $comment->id), $updatedCommentData);
        
        // Memastikan komentar berhasil diperbarui
        $response->assertRedirect(route('matkul.discussion', $matkul->id));
        $this->assertDatabaseHas('comments', $updatedCommentData);
    }

    /** @test */
    public function comment_can_be_deleted()
    {
        // Membuat user, mata kuliah, dan komentar
        $user = User::factory()->create();
        $matkul = MataKuliah::factory()->create();
        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'matkul_id' => $matkul->id
        ]);
        
        // Melakukan request DELETE untuk menghapus komentar
        $response = $this->actingAs($user)->delete(route('comments.destroy', $comment->id));
        
        // Memastikan komentar berhasil dihapus
        $response->assertRedirect(route('matkul.discussion', $matkul->id));
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    /** @test */
    public function comment_requires_a_valid_comment_text()
    {
        // Membuat user dan mata kuliah
        $user = User::factory()->create();
        $matkul = MataKuliah::factory()->create();
        
        // Data komentar yang kosong
        $invalidCommentData = ['comment' => ''];
        
        // Melakukan request POST untuk menyimpan komentar dengan data yang tidak valid
        $response = $this->actingAs($user)->post(route('comments.store', $matkul->id), $invalidCommentData);
        
        // Memastikan validasi gagal dan halaman kembali dengan error
        $response->assertSessionHasErrors('comment');
    }
}
