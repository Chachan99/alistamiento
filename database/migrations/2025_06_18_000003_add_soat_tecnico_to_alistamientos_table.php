<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alistamientos', function (Blueprint $table) {
            $table->date('soat_expedicion')->nullable();
            $table->date('soat_vencimiento')->nullable();
            $table->date('tecnico_expedicion')->nullable();
            $table->date('tecnico_vencimiento')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('alistamientos', function (Blueprint $table) {
            $table->dropColumn([
                'soat_expedicion',
                'soat_vencimiento',
                'tecnico_expedicion',
                'tecnico_vencimiento',
            ]);
        });
    }
};
