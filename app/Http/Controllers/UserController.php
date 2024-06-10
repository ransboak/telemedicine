<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function addDoctor(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'contact' => ['required', 'string', 'max:255'],
            'field' => ['required', 'string', 'max:255']
        ]);

                $fullname = $request->name;
                $split_names = explode(" ", $fullname);
                $firstname = $split_names[0];
                $lastname = $split_names[1];

        try {

            $user = User::create([
                'name' => $fullname,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $request->email,
                'role' => 'doctor',
                'contact' => $request->contact,
                'password' => Hash::make('12345678'),
            ]);
    
            $doctor = Doctor::create([
                'user_id' => $user->id,
                'field' => $request->field,
            ]);

            return redirect()->back()->with('success', 'New doctor added Successfully');
        } catch (Exception $e) {
             return redirect()->back()->with('error', 'Unable to add doctor.');
        }
        
    }

    public function updateDoctor(Request $request, $doctor){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'contact' => ['required', 'string', 'max:255'],
            'field' => ['required', 'string', 'max:255']
        ]);

        $user = User::findOrFail($doctor);
        $doctor = $user->doctor;

        $fullname = $request->name;
        $split_names = explode(" ", $fullname);
        $firstname = $split_names[0];
        $lastname = $split_names[1];

        try {
            $user = $user->update([
                'name' => $fullname,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $request->email,
                'contact' => $request->contact,
            ]);
    
            $doctor = $doctor->update([
                'field' => $request->field,
            ]);

            return redirect()->back()->with('success', 'Doctor updated Successfully');
        } catch (Exception $e) {
             return redirect()->back()->with('error', 'Unable to update doctor details.');
        }
        
    }
}
