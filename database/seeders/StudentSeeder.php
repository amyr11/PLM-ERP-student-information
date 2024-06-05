<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\RegistrationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;
use \App\Models\Student;
use App\Services\StudentCredential;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $student = Student::factory()->create();
            // Insert the student term
            $student->addTerm(
                $student->aysem_id,
                Program::inRandomOrder()->first()->id,
                null,
                RegistrationStatus::where('registration_status', 'Regular')->first()->id,
                'new',
                false,
                false,
                1,
            );
        }
    }
}
