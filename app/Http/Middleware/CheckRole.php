<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole('siswa')) {
                return $next($request);
            }

            if (auth()->user()->hasRole(['super_admin', 'guru'])) {
                return redirect('/admin');
            }
        }
        return redirect('/');
    }
    
}
