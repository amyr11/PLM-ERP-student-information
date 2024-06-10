<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curricula = [
            ['curriculum_code' => 'CURR001', 'curriculum_name' => 'Curriculum 1', 'description' => 'Description for Curriculum 1'],
            // Add more curricula here
        ];

        foreach ($curricula as $curriculum) {
            \App\Models\Curriculum::create($curriculum);
        }
    }
}