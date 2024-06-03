<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $years = range(1973, 2023);

        foreach ($years as $year) {
            \App\Models\AcademicYear::create([
                'id' => $year,
            ]);
        }
    }
}
