<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\ClassMode;
use App\Models\Day;
use App\Models\Professor;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentClass>
 */
class StudentClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $professors = Professor::all();
        $subjects = Subject::all();
        $buildings = Building::all();
        $classModes = ClassMode::all();
        $days = Day::all();
        $startTime = $this->faker->time('H:i');
        $endTime = date('H:i', strtotime($startTime) + 7200);

        return [
            'professor_id' => $professors->random()->id,
            'subject_id' => $subjects->random()->id,
            'building_id' => $buildings->random()->id,
            'class_mode_id' => $classModes->random()->id,
            'day_id' => $days->random()->id,
            'section' => $this->faker->numberBetween(1, 3),
            'start_time' => $startTime,
            'end_time' => $endTime,
            'room' => $this->faker->randomElement(['CL1', 'CL2', 'CL3', 'CL4']),
        ];
    }
}
