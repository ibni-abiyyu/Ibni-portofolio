<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_skills_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')
                  ->constrained('portfolios') // Perbaiki dari 'projects' ke 'portfolios'
                  ->onDelete('cascade');
            $table->string('name');
            $table->string('icon')->nullable(); // Tambahkan kolom icon
            $table->integer('percentage');
            $table->float('delay')->default(0.1); // Tambahkan kolom delay
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('skills');
    }
};