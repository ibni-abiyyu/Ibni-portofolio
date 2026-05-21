<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('tanggal_lahir')->nullable()->after('description');
            $table->string('jenis_kelamin')->nullable()->after('tanggal_lahir');
            $table->string('kewarganegaraan')->nullable()->after('jenis_kelamin');
            $table->text('pengalaman')->nullable()->after('pendidikan');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_lahir',
                'jenis_kelamin',
                'kewarganegaraan',
                'pengalaman',
            ]);
        });
    }
};
