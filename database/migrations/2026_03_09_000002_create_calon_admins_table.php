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
        Schema::create('calon_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('visi');
            $table->text('misi');
            $table->string('foto')->nullable();
            $table->integer('no_urut')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_admins');
    }
};
