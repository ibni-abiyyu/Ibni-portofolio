<?php
// database/seeders/SkillSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Portfolio;

class SkillSeeder extends Seeder
{
    public function run()
    {
        $portfolio = Portfolio::first();
        
        if ($portfolio) {
            $portfolio->skills()->delete();

            $skills = [
                [
                    'name' => 'PHP',
                    'icon' => 'fab fa-php',
                    'percentage' => 80,
                    'delay' => 0.1
                ],
                [
                    'name' => 'JavaScript',
                    'icon' => 'fab fa-js',
                    'percentage' => 75,
                    'delay' => 0.2
                ],
                [
                    'name' => 'Python',
                    'icon' => 'fab fa-python',
                    'percentage' => 70,
                    'delay' => 0.3
                ],
                [
                    'name' => 'Penguasaan Bahasa Program',
                    'icon' => 'fas fa-code',
                    'percentage' => 75,
                    'delay' => 0.4
                ]
            ];

            foreach ($skills as $skillData) {
                Skill::create(array_merge($skillData, ['portfolio_id' => $portfolio->id]));
            }
        }
    }
}
