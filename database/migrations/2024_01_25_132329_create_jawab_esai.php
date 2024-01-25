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
        Schema::create('jawab_esai', function (Blueprint $table) {
            $table->id('idjawabesai');
            $table->foreignId('idesai');
            $table->foreignId('user_id');
            $table->text('response_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawab_esai');
    }
};
