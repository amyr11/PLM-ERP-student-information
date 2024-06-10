<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ['subject_code' => 'ICC 0101', 'subject_title' => 'Introduction to Computing (lec)', 'course_number' => '0101', 'units' => 2, 'class_code' => 1001, 'pre_co_requisite' => null, 'program_id' => 1, 'aysem_id' => 1],
            ['subject_code' => 'ICC 0101.1', 'subject_title' => 'Introduction to Computing (lab)', 'course_number' => '0101.1', 'units' => 1, 'class_code' => 1001, 'pre_co_requisite' => null, 'program_id' => 1, 'aysem_id' => 1],
            ['subject_code' => 'CSC 0211', 'subject_title' => 'Discrete Structures 2', 'course_number' => '0211', 'units' => 3, 'class_code' => 1001, 'pre_co_requisite' => 'CSC 0102', 'program_id' => 1, 'aysem_id' => 1],
            ['subject_code' => 'CSC 0223', 'subject_title' => 'Human Computer Interaction', 'course_number' => '0223', 'units' => 3, 'class_code' => 1001, 'pre_co_requisite' => null, 'program_id' => 1, 'aysem_id' => 1],
            ['subject_code' => 'CSC 0224', 'subject_title' => 'Operation Research', 'course_number' => '0224', 'units' => 3, 'class_code' => 1001, 'pre_co_requisite' => 'CSC 0211', 'program_id' => 1, 'aysem_id' => 1],
            ['subject_code' => 'ITE 0001', 'subject_title' => 'Living in the IT Era', 'course_number' => '0001', 'units' => 3, 'class_code' => 1001, 'pre_co_requisite' => null, 'program_id' => 1, 'aysem_id' => 1],
            // Add more courses here
        ];

        foreach ($courses as $course) {
            \App\Models\Course::create($course);
        }
    }
}