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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
            ->references('id')
            ->on('subjects');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')
            ->references('id')
            ->on('users');
            $table->unsignedMediumInteger('min_score');
            $table->unsignedMediumInteger('max_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
