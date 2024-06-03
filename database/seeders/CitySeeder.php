<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            "Manila",
            "Quezon City",
            "Caloocan",
            "Las Piñas",
            "Makati",
            "Malabon",
            "Mandaluyong",
            "Marikina",
            "Muntinlupa",
            "Navotas",
            "Parañaque",
            "Pasay",
            "Pasig",
            "Pateros",
            "San Juan",
            "Taguig",
            "Valenzuela",
            // TODO: Add more cities here
        ];

        foreach ($cities as $city) {
            \App\Models\City::create([
                'city_name' => $city,
            ]);
        }
    }
}
