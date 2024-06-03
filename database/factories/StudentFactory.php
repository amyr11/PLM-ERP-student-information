<?php

namespace Database\Factories;

use App\Models\BiologicalSex;
use App\Models\City;
use App\Models\CivilStatus;
use App\Models\DegreeProgram;
use App\Models\RegistrationStatus;
use App\Services\PLMEmail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $degreePrograms = DegreeProgram::all();
        $cities = City::all();
        $biologicalSex = BiologicalSex::all();
        $civilStatus = CivilStatus::first();
        $registrationStatuses = RegistrationStatus::whereNot('registration_status', 'Graduated')->get();
        $entryDate = $this->faker->dateTimeBetween('-4 years', '-1 years');
        $entryYear = $entryDate->format('Y');
        $uniqueNumber = $this->faker->unique()->numberBetween(1, 999);
        $lastName = $this->faker->lastName;
        $firstName = $this->faker->firstName;
        $middleName = $this->faker->lastName;
        $plmEmail = PLMEmail::generate($firstName, $middleName, $lastName, $entryDate);
        $studentNo = $entryYear . '01' . str_pad($uniqueNumber, 3, '0', STR_PAD_LEFT);
        $mobileNo = '09' . $this->faker->unique()->numberBetween(100000000, 999999999);

        return [
            'student_no' => $studentNo,
            'last_name' => $lastName,
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'degree_program_id' => $degreePrograms->random()->id,
            'birthplace_city_id' => $cities->random()->id,
            'city_id' => $cities->random()->id,
            'biological_sex_id' => $biologicalSex->random()->id,
            'civil_status_id' => $civilStatus->id,
            'registration_status_id' => $registrationStatuses->random()->id,
            'academic_year_id' => $entryYear,
            'birthdate' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'religion' => $this->faker->randomElement(['Roman Catholic', 'Born Again Christian', 'Muslim', 'Iglesia ni Cristo']),
            'entry_date' => $entryDate,
            'permanent_address' => $this->faker->address,
            'plm_email' => $plmEmail,
            'personal_email' => $this->faker->email,
            'mobile_no' => $mobileNo,
            'password' => Hash::make($studentNo),
        ];
    }
}
