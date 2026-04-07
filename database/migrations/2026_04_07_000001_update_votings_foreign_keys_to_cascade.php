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
        Schema::table('votings', function (Blueprint $table) {
            $table->dropForeign(['id_calon_admin']);
            $table->dropForeign(['id_peserta']);

            $table->foreign('id_calon_admin')
                ->references('id')
                ->on('calon_admins')
                ->cascadeOnDelete();

            $table->foreign('id_peserta')
                ->references('id')
                ->on('pesertas')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('votings', function (Blueprint $table) {
            $table->dropForeign(['id_calon_admin']);
            $table->dropForeign(['id_peserta']);

            $table->foreign('id_calon_admin')
                ->references('id')
                ->on('calon_admins');

            $table->foreign('id_peserta')
                ->references('id')
                ->on('pesertas');
        });
    }
};
