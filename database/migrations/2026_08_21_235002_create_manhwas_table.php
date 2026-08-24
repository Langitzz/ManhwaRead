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
        Schema::create('manhwas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('penulis')->nullable();
            $table->string('ilustrator')->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->text('sinopsis')->nullable();
            $table->string('cover')->nullable();
            $table->enum('status', ['ongoing', 'completed', 'hiatus'])->default('ongoing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manhwas');
    }
};
