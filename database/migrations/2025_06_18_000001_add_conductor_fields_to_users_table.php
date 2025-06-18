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
            $table->string('numero_cedula')->nullable();
            $table->string('pdf_cedula')->nullable();
            $table->string('pdf_licencia')->nullable();
            $table->date('fecha_expedicion_licencia')->nullable();
            $table->date('fecha_vencimiento_licencia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'numero_cedula',
                'pdf_cedula',
                'pdf_licencia',
                'fecha_expedicion_licencia',
                'fecha_vencimiento_licencia',
            ]);
        });
    }
};
