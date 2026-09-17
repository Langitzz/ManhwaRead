<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Pemetaan awalan nama route ke key Permission (granular, 1 permission per menu).
     */
    protected array $routeToPermission = [
        'admin.role.' => 'role_user',
        'admin.access.' => 'hak_akses',
        'admin.log.' => 'log_aktivitas',
        'backup.' => 'backup',
        'pengaturan.' => 'pengaturan',
        'genre.' => 'genre',
        'manhwa.' => 'manhwa',
        'chapter.' => 'chapter',
        'banner.' => 'banner',
        'komentar.' => 'komentar',
        'bookmark.' => 'bookmark',
        'riwayat.' => 'riwayat',
        'user.' => 'user',
        'admin' => 'dashboard',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            abort(403);
        }

        $user = auth()->user();
        $routeName = $request->route()->getName();

        $permissionKey = null;

        foreach ($this->routeToPermission as $prefix => $key) {
            if ($routeName === $prefix || str_starts_with($routeName, $prefix)) {
                $permissionKey = $key;
                break;
            }
        }

        if ($permissionKey === null) {
            abort(403);
        }

        $hasAccess = $user->userRole?->permissions()->where('key', $permissionKey)->exists();

        if ($hasAccess) {
            return $next($request);
        }

        abort(403);
    }
}
