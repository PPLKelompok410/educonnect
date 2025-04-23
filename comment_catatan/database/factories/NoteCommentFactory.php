<?php

namespace Database\Factories;

use App\Models\NoteComment;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteCommentFactory extends Factory
{
    protected $model = NoteComment::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence,
            'note_id' => Note::factory(),
            'user_id' => User::factory(),
        ];
    }
}
