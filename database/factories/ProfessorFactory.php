<?php

namespace Database\Factories;

use App\Services\PLMEmail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lastName = $this->faker->lastName;
        $firstName = $this->faker->firstName;
        $middleName = $this->faker->lastName;
        $entryDate = $this->faker->dateTimeBetween('-50 years', 'now');
        $plmEmail = PLMEmail::generate($firstName, $middleName, $lastName, $entryDate);

        return [
            'last_name' => $lastName,
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'entry_date' => $entryDate,
            'plm_email' => $plmEmail,
        ];
    }
}
