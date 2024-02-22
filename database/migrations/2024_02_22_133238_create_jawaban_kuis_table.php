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
        Schema::create('jawaban_kuis', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('iduser');
            $table->unsignedInteger('idkuis');
            $table->unsignedBigInteger('idquestions');
            $table->foreign('iduser')->references('id')->on('users');
            $table->foreign('idkuis')->references('idkuis')->on('kuis');
            $table->foreign('idquestions')->references('id')->on('questions');
            $table->string('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_kuis');
    }
};
