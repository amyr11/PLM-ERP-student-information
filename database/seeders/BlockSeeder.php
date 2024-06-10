<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blocks = [
            ['block_id' => 'B001', 'year_level' => 1, 'section' => 1, 'program_id' => 1, 'aysem_id' => 1],
            ['block_id' => 'B002', 'year_level' => 1, 'section' => 2, 'program_id' => 1, 'aysem_id' => 1],
            ['block_id' => 'B003', 'year_level' => 2, 'section' => 1, 'program_id' => 1, 'aysem_id' => 1],
            // Add more blocks here
        ];

        foreach ($blocks as $block) {
            \App\Models\Block::create($block);
        }
    }
}