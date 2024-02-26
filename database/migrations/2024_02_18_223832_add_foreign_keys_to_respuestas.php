<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('respuestas', function (Blueprint $table) {
            $table->foreign(['encuestado_id'], 'fk_respuesta_encuestado')->references(['id'])->on('encuestados')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['encuesta_id'], 'fk_respuesta_encuesta')->references(['id'])->on('encuestas')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respuestas', function (Blueprint $table) {
            $table->dropForeign('fk_respuesta_encuestado');
            $table->dropForeign('fk_respuesta_encuesta');
        });
    }
};