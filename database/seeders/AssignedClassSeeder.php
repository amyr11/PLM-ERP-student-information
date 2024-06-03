<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AcademicYear;
use App\Models\AssignedClass;
use App\Models\Student;
use Illuminate\Database\Seeder;

class AssignedClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::all();
        $currentAcadYear = AcademicYear::latest()->first();

        foreach ($students as $student) {
            $studentId = $student->id;
            $academicYearRange = range($student->academicYear->id, $currentAcadYear->id);
            $rangeIndex = count($academicYearRange);

            for ($i = 0; $i < $rangeIndex - 1; $i++) {
                $academicYearId = $academicYearRange[$i];

                AssignedClass::factory()->count(8)->create([
                    'student_id' => $studentId,
                    'academic_year_id' => $academicYearId,
                    'semester' => 1,
                ]);
                AssignedClass::factory()->count(8)->create([
                    'student_id' => $studentId,
                    'academic_year_id' => $academicYearId,
                    'semester' => 2,
                ]);
            }

            AssignedClass::factory()->count(8)->create([
                'student_id' => $studentId,
                'academic_year_id' => $currentAcadYear,
                'semester' => 1,
            ]);
            AssignedClass::factory()->count(8)->create([
                'student_id' => $studentId,
                'academic_year_id' => $currentAcadYear,
                'grade' => null,
                'semester' => 2,
            ]);
        }
    }
}
