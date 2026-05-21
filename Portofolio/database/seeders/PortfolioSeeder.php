<?php
// database/seeders/PortfolioSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        Portfolio::updateOrCreate(['name' => 'Ibni Abiyyu'], [
            'fotoprofil' => 'https://cdn.discordapp.com/attachments/1256123329505660938/1460886503625592924/Screenshot_2025-06-08_002525.png?ex=697ba9d4&is=697a5854&hm=c63531dc298593448e403b8d79c917a634d0aa5e8d43a1fab2faf77068fabc44',
            'name' => 'Ibni Abiyyu',
            'description' => 'Saya adalah seorang Programmer yang memiliki minat dan kemampuan di bidang pengembangan perangkat lunak dengan belajar dan praktik kurang lebih 2 tahun. Menguasai Python, PHP, dan JavaScript.',
            'tanggal_lahir' => '23 Mei 2009',
            'jenis_kelamin' => 'Laki-laki',
            'kewarganegaraan' => 'Indonesia',
            'github_url' => 'https://github.com/PPLG-SMKTI-27/uuk-ganjil-ibni-abiyyu',
            'tiktok_url' => 'https://www.tiktok.com/@meidoragon_',
            'email' => 'iabiyyu76@gmail.com',
            'nomortelp' => '0851-5666-4819',
            'lokasi' => 'Perumahan Sempaja Lestari Indah Korpri Blok B.10',
            'pendidikan' => 'SDIT Cordova, SMPIT Cordova, SMKTI Airlangga',
            'pengalaman' => "Final Proyek Semester 1 Kelas 11: Aplikasi Perpustakaan\nFinal Proyek Semester 2 Kelas 11: Aplikasi Pelacakan Gerobak Kopi",
        ]);
    }
}
