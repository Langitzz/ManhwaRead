<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $permission = DB::table('permissions')->where('key', 'backup')->first();

        if ($permission) {
            DB::table('permission_role')->where('permission_id', $permission->id)->delete();
            DB::table('permissions')->where('id', $permission->id)->delete();
        }
    }

    public function down(): void
    {
        DB::table('permissions')->insert([
            'key' => 'backup',
            'label' => 'Backup Database',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};