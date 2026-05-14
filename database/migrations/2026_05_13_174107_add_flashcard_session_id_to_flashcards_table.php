<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('flashcards', function (Blueprint $table) {
            $table->unsignedBigInteger('flashcard_session_id')->nullable()->after('session_id');
            $table->foreign('flashcard_session_id')->references('id')->on('flashcard_sessions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('flashcards', function (Blueprint $table) {
            $table->dropForeign(['flashcard_session_id']);
            $table->dropColumn('flashcard_session_id');
        });
    }
};