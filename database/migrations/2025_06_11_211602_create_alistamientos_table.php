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
    Schema::create('alistamientos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // conductor
        $table->foreignId('vehiculo_id')->constrained()->onDelete('cascade');
        $table->json('checklist'); // respuestas del checklist
        $table->text('observaciones')->nullable();
        $table->string('foto_danio')->nullable(); // ruta de la imagen
        $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alistamientos');
    }
};
