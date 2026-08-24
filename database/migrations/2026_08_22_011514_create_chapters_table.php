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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manhwa_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('nomor_chapter');
            $table->string('judul_chapter')->nullable();
            $table->date('tanggal_rilis')->nullable();
            $table->timestamps();

            $table->unique(['manhwa_id', 'nomor_chapter']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
