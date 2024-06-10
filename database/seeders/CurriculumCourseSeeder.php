<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CurriculumCourse;

class CurriculumCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curriculumCourses = [
            ['curriculum_id' => 1, 'course_id' => 1, 'semester' => 1, 'year_level' => 1],
            ['curriculum_id' => 1, 'course_id' => 2, 'semester' => 1, 'year_level' => 1],
            ['curriculum_id' => 1, 'course_id' => 3, 'semester' => 2, 'year_level' => 1],
            ['curriculum_id' => 1, 'course_id' => 4, 'semester' => 2, 'year_level' => 1],
            ['curriculum_id' => 2, 'course_id' => 1, 'semester' => 1, 'year_level' => 1],
            ['curriculum_id' => 2, 'course_id' => 2, 'semester' => 1, 'year_level' => 1],
            ['curriculum_id' => 2, 'course_id' => 3, 'semester' => 2, 'year_level' => 1],
            ['curriculum_id' => 2, 'course_id' => 4, 'semester' => 2, 'year_level' => 1],
            ['curriculum_id' => 2, 'course_id' => 5, 'semester' => 1, 'year_level' => 2],
            ['curriculum_id' => 2, 'course_id' => 6, 'semester' => 1, 'year_level' => 2],
            // Add more curriculum courses here
        ];

        foreach ($curriculumCourses as $curriculumCourse) {
            CurriculumCourse::create($curriculumCourse);
        }
    }
}