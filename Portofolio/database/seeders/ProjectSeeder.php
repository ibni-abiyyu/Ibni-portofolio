<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->insert([
            'title' => 'Web Portofolio',
            'description' => 'Portofolio dengan laravel',
            'technology' => 'Laravel',
            'demo_link' => null,
            'is_published' => true,
        ]);
    }
}
