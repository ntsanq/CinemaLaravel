<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->get('admin_token')) {
            $token = PersonalAccessToken::findToken(session()->get('admin_token'));
            $user = $token->tokenable;
            if ($user->role == UserRole::Clerk || $user->role == UserRole::Admin) {
                return $next($request);
            }

            return redirect('/admin/login');
        }

        return redirect('/admin/login');
    }
}
