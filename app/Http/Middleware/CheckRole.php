<?php
// App\Http\Middleware\CheckRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        if (!$user || !in_array($user->role, $roles)) {
            abort(403, 'Anda tidak memiliki akses untuk halaman ini');
        }

        return $next($request);
    }
}
