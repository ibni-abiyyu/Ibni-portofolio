<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('portfolios', function (Blueprint $table) {
        $table->id();
        $table->string('fotoprofil')->nullable();
        $table->string('name');
        $table->text('description');
        $table->string('github_url')->nullable();
        $table->string('tiktok_url')->nullable();
        $table->string('email')->nullable();
        $table->string('nomortelp')->nullable();
        $table->string('lokasi')->nullable();
        $table->string('pendidikan')->nullable();
        $table->timestamps();
    });
}

};
