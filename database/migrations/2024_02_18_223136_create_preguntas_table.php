<?php

use App\Models\Encuesta;
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
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Encuesta::class);
            $table->string('titulo_pregunta', 120);
            $table->smallInteger('tipo_pregunta');
            $table->json('rango_puntuacion')->nullable();
            $table->json('opciones')->nullable();
            $table->timestamps();
        });

        // DB::statement('ALTER TABLE preguntas ADD COLUMN opciones varchar(40)[] NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas');
    }
};
