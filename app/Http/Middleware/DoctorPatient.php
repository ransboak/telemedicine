<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorPatient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roles = ['doctor', 'patient'];
        $user_role = auth()->user()->role;
        if(in_array($user_role, $roles)){
            return $next($request);
        }
        return redirect()->back();
    }
}
