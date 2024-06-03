<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AssignedClass>
 */
class AssignedClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $students = Student::all();
        $studentClasses = StudentClass::all();
        $academicYears = AcademicYear::all();

        return [
            'student_id' => $students->random()->id,
            'student_class_id' => $studentClasses->random()->id,
            'academic_year_id' => $academicYears->random()->id,
            'semester' => $this->faker->randomElement([1, 2]),
            'grade' => $this->faker->randomElement([1.00, 1.25, 1.50, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00, 4.00, 5.00])
        ];
    }
}
