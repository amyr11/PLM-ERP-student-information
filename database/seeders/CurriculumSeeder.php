<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curriculum;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curricula = [
            ['program_id' => 1, 'course_id' => 1, 'semester' => 1, 'year_level' => 1, 'aysem_id' => 1],
            ['program_id' => 1, 'course_id' => 1, 'semester' => 1, 'year_level' => 1, 'aysem_id' => 1],
            ['program_id' => 1, 'course_id' => 1, 'semester' => 1, 'year_level' => 1, 'aysem_id' => 1],
            ['program_id' => 1, 'course_id' => 1, 'semester' => 1, 'year_level' => 1, 'aysem_id' => 1],
            // Add more curriculum entries here based on your curriculum
        ];

        foreach ($curricula as $curriculum) {
            Curriculum::create($curriculum);
        }
    }
}