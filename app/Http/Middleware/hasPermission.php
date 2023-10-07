<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class hasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $data = optional(User::with["absent.permission"]->find(Auth::user()->id)->absent->where("date" , Carbon::now()->toDateString())->first();
        
        // if($data) {
        //     $permission = $data->permission;

        //     if($permission) {
        //         return "ok"
        //     }
        // }
        return $next($request);
    }
}
