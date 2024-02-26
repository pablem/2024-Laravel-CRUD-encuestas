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
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->integer('encuestado_id');
            $table->integer('encuesta_id');
            $table->smallInteger('tipo_respuesta');
            $table->smallInteger('puntuacion')->nullable();
            $table->text('entrada_texto')->nullable();
            $table->json('seleccion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas');
    }
};
