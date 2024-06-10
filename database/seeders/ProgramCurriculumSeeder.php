<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramCurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programCurricula = [
            ['program_id' => 1, 'curriculum_id' => 1],
            // Add more program_curriculum entries here
        ];

        foreach ($programCurricula as $programCurriculum) {
            \App\Models\ProgramCurriculum::create($programCurriculum);
        }
    }
}