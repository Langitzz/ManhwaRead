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
        Schema::table('manhwas', function (Blueprint $table) {
            $table->decimal('rating', 3, 1)->nullable()->after('status');
            $table->unsignedBigInteger('views')->default(0)->after('rating');
            $table->text('judul_alternatif')->nullable()->after('judul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manhwas', function (Blueprint $table) {
            $table->dropColumn(['rating', 'views', 'judul_alternatif']);
        });
    }
};