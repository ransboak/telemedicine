<?php

namespace App\Http\Middleware;

use App\Models\Appointment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AllowChat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role == 'patient'){
                            $appointments = Appointment::where('patient_id', Auth::user()->id)
                            ->where('status', 'Approved')
                            ->whereDate('scheduled_at', \Carbon\Carbon::today())
                            ->distinct('doctor_id')
                            ->get();

                            if($appointments->count() > 0){
                                return $next($request);
                            }else{
                                return redirect()->back();
                            }
                            
        }elseif(Auth::user()->role == 'doctor'){
            return $next($request);
        }
        return redirect()->back();
    }
}
