<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['subject_name' => 'Software Engineering 1', 'subject_code' => 'SE1', 'units' => 3],
            ['subject_name' => 'Software Engineering 2', 'subject_code' => 'SE2', 'units' => 3],
            ['subject_name' => 'Automata Theory', 'subject_code' => 'AT', 'units' => 3],
            ['subject_name' => 'Compiler Design', 'subject_code' => 'CD', 'units' => 3],
        ];

        foreach ($subjects as $subject) {
            \App\Models\Subject::create($subject);
        }
    }
}
