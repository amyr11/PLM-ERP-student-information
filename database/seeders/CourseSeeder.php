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
            [   
                'subject_code' => 'ICC 0101',
                'subject_title' => 'Introduction to Computing (lec)',
                'course_number' => '0101',
                'units' => 2,
                'class_code' => 1001,
                'pre_co_requisite' => null,
                'program_id' => 1,
                'aysem_id' => 1,
            ],
            [   
                'subject_code' => 'ICC 0101.1',
                'subject_title' => 'Introduction to Computing (lab)',
                'course_number' => '0101.1',
                'units' => 1,
                'class_code' => 1001,
                'pre_co_requisite' => null,
                'program_id' => 1,
                'aysem_id' => 1,
            ],
            [   
                'subject_code' => 'ICC 0103',
                'subject_title' => 'Intermediate Programming (lec)',
                'course_number' => '0102',
                'units' => 2,
                'class_code' => 1001,
                'pre_co_requisite' => null,
                'program_id' => 1,
                'aysem_id' => 1,
            ],
            [   
                'subject_code' => 'ICC 0103.1',
                'subject_title' => 'Intermediate Programming (lab)',
                'course_number' => '0103.1',
                'units' => 1,
                'class_code' => 1001,
                'pre_co_requisite' => null,
                'program_id' => 1,
                'aysem_id' => 1,
            ],
            // Add more courses here
        ];

        foreach ($courses as $course) {
            \App\Models\Course::create($course);
        }
    }
}