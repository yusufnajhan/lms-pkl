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
        Schema::create('esai', function (Blueprint $table) {
            $table->id('idesai');
            $table->integer('idkuis');
            $table->text('soal');
            $table->timestamps();
    
            $table->foreign('idkuis')->references('idkuis')->on('kuis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esai');
    }
};
