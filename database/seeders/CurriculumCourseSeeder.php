<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curriculumCourses = [
            ['curriculum_id' => 1, 'course_id' => 1, 'semester' => 1, 'year_level' => 1],
            // Add more curriculum_course entries here
        ];

        foreach ($curriculumCourses as $curriculumCourse) {
            \App\Models\CurriculumCourse::create($curriculumCourse);
        }
    }
}