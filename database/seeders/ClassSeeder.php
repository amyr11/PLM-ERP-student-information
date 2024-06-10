<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Class;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'students_qty' => null,
                'credited_units' => 3,
                'actual_units' => null,
                'slots' => 35,
                'nstp_activity' => null,
                'parent_class_code' => null,
                'link_type' => null,
                'instruction_language' => 'English',
                'minimum_year_level' => null,
                'teams_assigned_link' => null,
                'effectivity_dateSL' => null,
                'course_id' => 1,
                'aysem_id' => 1,
                'block_id' => 1
            ],
            // Add more classes here
        ];

        foreach ($classes as $class) {
            \App\Models\Classes::create($class);
        }
    }
}