<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Emoji;

class EmojiSeeder extends Seeder
{
    public function run()
    {
        Emoji::create([
            'name' => '👍',
            'level' => 1,
        ]);

        Emoji::create([
            'name' => '🥳',
            'level' => 2,
        ]);

        Emoji::create([
            'name' => '🎉',
            'level' => 3,
        ]);

        Emoji::create([
            'name' => '🧠',
            'level' => 4,
        ]);

        Emoji::create([
            'name' => '🖖',
            'level' => 5,
        ]);

        Emoji::create([
            'name' => '👨‍💻',
            'level' => 6,
        ]);

        Emoji::create([
            'name' => '🧤',
            'level' => 7,
        ]);

        Emoji::create([
            'name' => '🖕🏼',
            'level' => 8,
        ]);

        Emoji::create([
            'name' => '🤞🏽',
            'level' => 9,
        ]);

        Emoji::create([
            'name' => '🛀🏽',
            'level' => 10,
        ]);

        Emoji::create([
            'name' => '👐🏿',
            'level' => 11,
        ]);

        Emoji::create([
            'name' => '🦍',
            'level' => 12,
        ]);
    }
}
