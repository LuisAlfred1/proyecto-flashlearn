<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flashcards', function (Blueprint $table) {
            $table->id();
            $table->string('session_id',40)->nullable();//para agrupar 10 tarjetas de una misma peticion
            $table->string('topic', 100);
            $table->string('target_language',3);
            $table->string('original_word');
            $table->string('translated_word');
            $table->text('example_sentence');
            $table->timestamps();

            //indices 
            $table->index('session_id');
            $table->index('topic');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flashcards');
    }
};
