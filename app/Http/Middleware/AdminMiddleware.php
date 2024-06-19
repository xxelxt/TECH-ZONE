<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!empty(auth()->user())) {
            setPermissionsTeamId(session('team_id'));
        } else {
            return redirect('admin/login');
        }
        return $next($request);
    }
}
