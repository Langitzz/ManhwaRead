<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Pemetaan awalan nama route ke key Permission (grup menu).
     */
    protected array $routeToPermission = [
        'admin.user.' => 'admin',
        'admin.access.' => 'admin',
        'admin.log.' => 'admin',
        'backup.' => 'backup',
        'pengaturan.' => 'pengaturan',
        'genre.' => 'master_data',
        'manhwa.' => 'master_data',
        'chapter.' => 'master_data',
        'banner.' => 'master_data',
        'komentar.' => 'aktivitas',
        'bookmark.' => 'aktivitas',
        'riwayat.' => 'aktivitas',
        'user.' => 'user',
        'admin' => 'dashboard',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
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

        $hasAccess = $user->userRole?->permissions()
            ->where('key', $permissionKey)
            ->exists();

        if ($hasAccess) {
            return $next($request);
        }

        abort(403);
    }
}
