<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permissionTitle): Response
    {
        $user = $request->user();

		$userHasPermission = $user->permissions()->where('title', $permissionTitle)->count();

		$userRolesHasPermission = $user->roles()->whereHas('permissions', function ($query) use ($permissionTitle) {
			$query->where('permissions.title', $permissionTitle);
		})->count();

		if ($userHasPermission || $userRolesHasPermission || $user->id === 1) {
			return $next($request);
		}
        
		return abort(403);
    }
}
