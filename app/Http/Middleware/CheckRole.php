<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (Auth::guard("admin")->user()->role_id == 1 && $roles[0] ==1) {       
            return $next($request);
        }
        elseif(Auth::guard("admin")->user()->role_id == 1 && $roles[0] == 2){
            return $next($request);
        }
        elseif(Auth::guard("admin")->user()->role_id == 1 && $roles[0] == 3){
            return $next($request);
        }
        elseif(Auth::guard("admin")->user()->role_id == 2 && $roles[0] == 2){
            return $next($request);
        }
        elseif(Auth::guard("admin")->user()->role_id == 2 && $roles[0] == 1){
            return redirect()->route("assignment")->with('error', 'Unauthorized action.');
            // abort(403, 'Unauthorized action.');
        }
        elseif(Auth::guard("admin")->user()->role_id == 2 && $roles[0] == 3){
            return redirect()->route("assignment")->with('error', 'Unauthorized action.');
            // abort(403, 'Unauthorized action.');
        }
        elseif(Auth::guard("admin")->user()->role_id == 3 && $roles[0] == 3){
            return $next($request);
        }
        elseif(Auth::guard("admin")->user()->role_id == 3 && ($roles[0] == 1 || $roles[0] == 2)){
            return redirect()->route("user")->with('error', 'Unauthorized action.');
            // abort(403, 'Unauthorized action.');
        }
        return redirect()->route("admin.login");

    }
}
