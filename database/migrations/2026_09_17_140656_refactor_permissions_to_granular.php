<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Insert permission granular baru
        $permissionBaru = [
            ['key' => 'manhwa', 'label' => 'Manhwa'],
            ['key' => 'genre', 'label' => 'Genre'],
            ['key' => 'chapter', 'label' => 'Chapter'],
            ['key' => 'banner', 'label' => 'Banner'],
            ['key' => 'komentar', 'label' => 'Komentar'],
            ['key' => 'bookmark', 'label' => 'Bookmark'],
            ['key' => 'riwayat', 'label' => 'Riwayat Baca'],
            ['key' => 'role_user', 'label' => 'Role User'],
            ['key' => 'hak_akses', 'label' => 'Hak Akses'],
            ['key' => 'log_aktivitas', 'label' => 'Log Aktivitas'],
        ];

        foreach ($permissionBaru as $permission) {
            DB::table('permissions')->insert(array_merge($permission, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 2. Migrasikan assignment role lama ke permission baru
        $pemetaan = [
            'master_data' => ['manhwa', 'genre', 'chapter', 'banner'],
            'aktivitas' => ['komentar', 'bookmark', 'riwayat'],
            'admin' => ['role_user', 'hak_akses', 'log_aktivitas'],
            'konten' => ['manhwa', 'chapter'],
        ];

        foreach ($pemetaan as $keyLama => $keyBaruList) {
            $permissionLama = DB::table('permissions')->where('key', $keyLama)->first();

            if (! $permissionLama) {
                continue;
            }

            $roleIds = DB::table('permission_role')
                ->where('permission_id', $permissionLama->id)
                ->pluck('role_id');

            foreach ($roleIds as $roleId) {
                foreach ($keyBaruList as $keyBaru) {
                    $permissionBaruRow = DB::table('permissions')->where('key', $keyBaru)->first();

                    if (! $permissionBaruRow) {
                        continue;
                    }

                    $sudahAda = DB::table('permission_role')
                        ->where('role_id', $roleId)
                        ->where('permission_id', $permissionBaruRow->id)
                        ->exists();

                    if (! $sudahAda) {
                        DB::table('permission_role')->insert([
                            'role_id' => $roleId,
                            'permission_id' => $permissionBaruRow->id,
                        ]);
                    }
                }
            }
        }

        // 3. Hapus permission lama (grup) beserta pivot-nya
        $idPermissionLama = DB::table('permissions')
            ->whereIn('key', ['master_data', 'aktivitas', 'admin', 'konten'])
            ->pluck('id');

        DB::table('permission_role')->whereIn('permission_id', $idPermissionLama)->delete();
        DB::table('permissions')->whereIn('key', ['master_data', 'aktivitas', 'admin', 'konten'])->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('permissions')->whereIn('key', [
            'manhwa', 'genre', 'chapter', 'banner',
            'komentar', 'bookmark', 'riwayat',
            'role_user', 'hak_akses', 'log_aktivitas',
        ])->delete();
    }
};
