<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    //
    public function bookAppointment(Request $request){
        if(Auth::user() && Auth::user()->role == 'admin' || Auth::user() && Auth::user()->role == 'doctor'){
            return redirect()->back();
        }

        $request->validate([
            'date' => 'required|date_format:m/d/Y',
        ]);

        $date = $request->input('date');
        $scheduledAt = Carbon::createFromFormat('m/d/Y', $date)->startOfDay();
        $doctor = Doctor::inRandomOrder()->first();
        // if(Auth::user()){
        //     $patient = Auth::user()->id
        // }else{
        //     $patient = 
        // }

        try {
            Appointment::create([
                'doctor_id' => $doctor->id,
                'patient_id' => Auth::user()->id,
                'scheduled_at' => $scheduledAt,
                'notes' => "Notes",
            ]);
    
            return redirect()->route('appointments')->with('success', 'Appointment booked successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to book appointment');
        }
       

        return redirect()->back();
    }

    public function reschedule(Request $request, Appointment $appointment){
        $request->validate([
            'reschedule_date' => 'required|date_format:Y-m-d',
        ]);

        $date = $request->input('reschedule_date');
        $scheduledAt = Carbon::createFromFormat('Y-m-d', $date)->startOfDay();

        try {
            $appointment->update([
                'scheduled_at' => $scheduledAt,
                'status' => 'Rescheduled'
            ]);

            return redirect()->route('appointments')->with('success', 'Appointment rescheduled successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to reschedule appointment');
        }
        
    }
    public function approve(Request $request, Appointment $appointment){

        try {
            $appointment->update([
                'status' => 'Approved'
            ]);

            return redirect()->route('appointments')->with('success', 'Appointment Approved');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to approve appointment');
        }
        
    }
    public function decline(Request $request, Appointment $appointment){
        try {
            $appointment->update([
                'status' => 'Declined'
            ]);
            return redirect()->route('appointments')->with('success', 'Appointment Declined');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to decline appointment');
        }
        
    }
}
