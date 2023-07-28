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
        Schema::create('subject_files', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('type');
            $table->unsignedBigInteger('size');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')
            ->on('subjects');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_files');
    }
};
