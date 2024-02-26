<?php

use App\Models\User;
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
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('titulo_encuesta', 40)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('url')->nullable();
            $table->date('fecha_publicacion')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->boolean('privada')->nullable()->default(false);
            $table->boolean('anonima')->nullable()->default(false);
            $table->smallInteger('version')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encuestas');
    }
};
