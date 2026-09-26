<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('nama_peran');
        });

        // Backfill slug dari nama_peran yang sudah ada sekarang
        foreach (DB::table('roles')->get() as $role) {
            DB::table('roles')
                ->where('id', $role->id)
                ->update(['slug' => Str::slug($role->nama_peran)]);
        }
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};