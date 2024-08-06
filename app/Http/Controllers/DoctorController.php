<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DoctorController extends Controller
{
    //
    // public function viewDoctors(Request $request)
    // {
    //     if (Auth::user()->role == 'admin') {
    //         if ($request->ajax()) {
    //             $doctors = User::where('role', 'doctor')->with('doctor')->select('users.*');

    //             return DataTables::of($doctors)
    //                 ->addColumn('action', function ($doctor) {
    //                     return view('backend.partials.action-buttons', compact('doctor'))->render();
    //                 })
    //                 ->addColumn('specialization', function ($doctor) {
    //                     return $doctor->doctor->field;
    //                 })
    //                 ->make(true);
    //         }
    //     }
    // }
}
