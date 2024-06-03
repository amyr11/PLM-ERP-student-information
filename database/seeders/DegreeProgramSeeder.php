<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DegreeProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colleges = \App\Models\College::all();

        $degreePrograms = [
            'Bachelor of Science in Computer Science',
            'Bachelor of Science in Information Technology',
        ];


        foreach ($degreePrograms as $degreeProgram) {
            \App\Models\DegreeProgram::create([
                'college_id' => $colleges->random()->id,
                'degree_program' => $degreeProgram,
            ]);
        }
    }
}
