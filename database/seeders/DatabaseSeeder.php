<?php

namespace Database\Seeders;

use App\Models\RequestedDocument;
use App\Models\StudentRequestMode;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CitySeeder::class,
            BiologicalSexSeeder::class,
            CivilStatusSeeder::class,
            CitizenshipSeeder::class,
            AysemSeeder::class,
            RegistrationStatusSeeder::class,
            CollegeSeeder::class,
            ProgramSeeder::class,
            StudentSeeder::class,

            DaySeeder::class,
            ClassModeSeeder::class,
            
            StudentRequestStatusSeeder::class,
            RequestedDocumentStatusSeeder::class,
            DocumentTypeSeeder::class,
            StudentRequestModeSeeder::class,
            StudentRequestSeeder::class,
            RequestedDocumentSeeder::class,

            // FeeStatusSeeder::class,
            // OffenseTypeSeeder::class,
            // BuildingSeeder::class,

            BlockSeeder::class,
            CourseSeeder::class,
            ClassSeeder::class,
            CurriculumSeeder::class,
            CurriculumCourseSeeder::class,
            CurriculumProgramSeeder::class,
        ]);
    }
}