<?php
// app/Models/Portfolio.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'fotoprofil',
        'name',
        'description',
        'tanggal_lahir',
        'jenis_kelamin',
        'kewarganegaraan',
        'github_url',
        'tiktok_url',
        'email',
        'nomortelp',
        'lokasi',
        'pendidikan',
        'pengalaman'
    ];

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
