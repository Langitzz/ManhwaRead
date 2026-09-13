<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_situs');
            $table->string('logo')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('email_kontak')->nullable();
            $table->timestamps();
        });

        DB::table('site_settings')->insert([
            'nama_situs' => 'ManhwaRead',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
