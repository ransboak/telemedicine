<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    //
    public function dashboard(){
            return view('backend.pages.dashboard');
    }

    // public function viewDoctors(){
    //     if(Auth::user()->role == 'admin'){
    //         return view('backend.pages.doctors');
    //     } 
    //     return redirect()->back();
    // }
    public function viewDoctors(Request $request)
    {
        if (Auth::user()->role == 'admin') {
            if ($request->ajax()) {
                $doctors = User::where('role', 'doctor')->with('doctor')->select('users.*');

                return DataTables::of($doctors)
                    ->addColumn('action', function ($doctor) {
                        return view('backend.partials.action-buttons', compact('doctor'))->render();
                    })
                    ->addColumn('specialization', function ($doctor) {
                        return $doctor->doctor->field;
                    })
                    ->make(true);
            }
            return view('backend.pages.doctors');
        }
        return redirect()->back();
    }

    public function patients(Request $request){
        if(Auth::user()->role == 'doctor'){
            if ($request->ajax()) {
                $patients = User::where('role', 'patient')->select('name','email', 'contact');
                return DataTables::of($patients)
                    ->make(true);
            }
            return view('backend.pages.patients');
        } 
        return redirect()->back();
    }

    public function appointments(){
        if(Auth::check()){
            $authUser = Auth::user();
            $authUserId = $authUser->id;
            $today = Carbon::today();
            $statusInactive = 'Inactive';
            $appointments = Appointment::with('doctor')->whereDate('scheduled_at', '<', $today)
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
