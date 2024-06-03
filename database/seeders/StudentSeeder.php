<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Str;
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
        $count = 50;
        for ($i = 0; $i < $count; $i++) {
            $randomPassword = Str::random(6);
            $student = Student::factory()->createOne([
                'password' => Hash::make($randomPassword),
            ]);

            $studentId = $student->id;

            StudentCredential::addToPendingCredentials($studentId, $randomPassword);
        }
    }
}
