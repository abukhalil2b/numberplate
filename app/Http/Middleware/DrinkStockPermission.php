<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DrinkStockPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->id ==1){

            return $next($request);
        }

        $hasPermission = Permission::where([
            'title'=>'drinkStockPermission',
        ])
        ->join('permission_user','permissions.id','permission_user.permission_id')
        ->first();

        if( ! $hasPermission){
            abort(403);
        }

        return $next($request);
    }
}
