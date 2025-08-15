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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // estudante
            $table->foreignId('subject_id')->constrained()->onDelete('cascade'); // disciplina
            $table->year('year');
            $table->timestamps();

            $table->unique(['user_id', 'subject_id', 'year']); // impede matrícula duplicada no mesmo ano
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
