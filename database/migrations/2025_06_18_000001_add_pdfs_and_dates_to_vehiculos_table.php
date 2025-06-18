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
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->string('soat_pdf')->nullable()->after('user_id');
            $table->string('tecnico_mecanica_pdf')->nullable()->after('soat_pdf');
            $table->string('licencia_transito_pdf')->nullable()->after('tecnico_mecanica_pdf');
            $table->date('soat_expedicion')->nullable()->after('licencia_transito_pdf');
            $table->date('soat_vencimiento')->nullable()->after('soat_expedicion');
            $table->date('tecnico_mecanica_expedicion')->nullable()->after('soat_vencimiento');
            $table->date('tecnico_mecanica_vencimiento')->nullable()->after('tecnico_mecanica_expedicion');
            $table->string('linea')->nullable()->after('marca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->dropColumn([
                'soat_pdf',
                'tecnico_mecanica_pdf',
                'licencia_transito_pdf',
                'soat_expedicion',
                'soat_vencimiento',
                'tecnico_mecanica_expedicion',
                'tecnico_mecanica_vencimiento',
                'linea',
            ]);
        });
    }
};
