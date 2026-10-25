<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Cek apakah role (slug) pengguna yang sedang login termasuk yang diizinkan.
     *
     * Cara pakai di route:
     *   'role:owner'            -> hanya Owner
     *   'role:owner,supervisor' -> Owner dan Supervisor
     */
    public function handle(Request $request, Closure $next, string ...$slugs): Response
    {
        if (! auth()->check()) {
            abort(403);
        }

        $userSlug = auth()->user()->userRole?->slug;

        if (! in_array($userSlug, $slugs, true)) {
            abort(403);
        }

        return $next($request);
    }
}