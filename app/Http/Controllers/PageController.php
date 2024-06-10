<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    public function dashboard(){
        if(Auth::check()){
            return view('backend.pages.dashboard');
        } 
        return redirect()->back();
    }

    public function viewDoctors(){
        if(Auth::user()->role == 'admin'){
            $doctors = User::where('role', 'doctor')->get();
            return view('backend.pages.doctors', compact('doctors'));
        } 
        return redirect()->back();
    }
    public function patients(){
        if(Auth::user()->role == 'doctor'){
            $patients = User::where('role', 'patient')->get();
            return view('backend.pages.patients', compact('patients'));
        } 
        return redirect()->back();
    }

    public function appointments(){
        if(Auth::check()){
            $authUser = Auth::user();
            $authUserId = $authUser->id;
            $today = Carbon::today();
            $statusInactive = 'Inactive';
            $appointments = Appointment::whereDate('scheduled_at', '<', $today)
        ->where('status', '!=', $statusInactive)
        ->where(function ($query) use ($authUserId) {
        $query->where('patient_id', $authUserId)
              ->orWhere('doctor_id', $authUserId);
        })
        ->update([
            'status' => 'Inactive',
        ]);
            
            // foreach($appointments as $appointment){
            //     $appointment_date = $appointment->scheduled_at;
            // $appointment->update([
            //     'status' => 'Inactive',
            // ]);
        // }
            if($authUser->role == 'doctor'){
                $user = Doctor::where('user_id', $authUserId)->first();
            }elseif($authUser->role == 'patient'){
                $user = User::where('id', $authUserId)->first();
            }
            return view('backend.pages.appointments', compact('user'));
        } 
        return redirect()->back();
    }

    public function changePassword(){
        return view('auth.password-change');
    }
    
}
