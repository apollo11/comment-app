<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commentTypes = [
            ['name' => 'post'],
            ['name' => 'video'],
            ['name' => 'photo'],
        ];

        foreach ($commentTypes as $commentType) {
            \App\Models\CommentType::firstOrCreate($commentType);
        }
    }
}
