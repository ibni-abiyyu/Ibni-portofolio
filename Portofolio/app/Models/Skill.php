<?php
// app/Models/Skill.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_id',
        'name',
        'icon',
        'percentage',
        'delay'
    ];

    protected $casts = [
        'percentage' => 'integer',
        'delay' => 'float'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}