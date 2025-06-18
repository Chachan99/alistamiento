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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'licencia',
                'foto_licencia',
                'cedula',
                'foto_cedula',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('licencia')->nullable();
            $table->string('foto_licencia')->nullable();
            $table->string('cedula')->nullable();
            $table->string('foto_cedula')->nullable();
        });
    }
};
