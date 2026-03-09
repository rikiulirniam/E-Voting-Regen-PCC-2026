<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('votings', function (Blueprint $table) {
            $table->id();

            // Definisi Column yang memiliki Foreign Key
            $table->unsignedBigInteger('id_calon_admin');
            $table->unsignedBigInteger('id_peserta')->unique();

            $table->foreign('id_calon_admin')->references('id')->on('calon_admins');
            $table->foreign('id_peserta')->references('id')->on('pesertas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votings');
    }
};
