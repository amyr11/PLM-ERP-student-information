<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CurriculumProgram;

class CurriculumProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curriculumPrograms = [
            ['curriculum_id' => 1, 'program_id' => 1],
            ['curriculum_id' => 2, 'program_id' => 2],
            // Add more curriculum programs here
        ];

        foreach ($curriculumPrograms as $curriculumProgram) {
            CurriculumProgram::create($curriculumProgram);
        }
    }
}