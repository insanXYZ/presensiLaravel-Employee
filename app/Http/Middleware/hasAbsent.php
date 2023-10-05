<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Absent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class hasAbsent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Absent::where("user_id", Auth::user()->id)->where("tanggal", Carbon::now()->toDateString())->whereNotNull("datang")->whereNotNull("pulang")->first()){
            return redirect("/")->with(["hasAbsent" , "Your has been absent"]);
        }

        return $next($request);
    }
}
