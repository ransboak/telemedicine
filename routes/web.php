<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $bookedDates = Appointment::pluck('scheduled_at')->map(function ($date) {
        return Carbon::parse($date)->format('m/d/Y');
    })->toArray();
    return view('frontend.pages.homepage', compact('bookedDates'));
})->name('home');

Route::get('/change-password', [PageController::class, 'changePassword'])->middleware('auth')->name('password.change');
Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware('auth')->name('dashboard');


Route::middleware(['auth',  'doctor_patient'])->group(function(){
    Route::get('/appointments', [PageController::class, 'appointments'])->name('appointments');
});

Route::middleware(['auth', 'patient'])->group(function(){
    Route::post('/book-appointments', [AppointmentController::class, 'bookAppointment'])->name('book.appointment');
});

Route::middleware(['auth', 'doctor'])->group(function(){
    Route::post('/reschedule/{appointment}', [AppointmentController::class, 'reschedule'])->name('reschedule');
    Route::post('/approve/{appointment}', [AppointmentController::class, 'approve'])->name('approve');
    Route::post('/decline/{appointment}', [AppointmentController::class, 'decline'])->name('decline');
    Route::get('/patients', [PageController::class, 'patients'])->name('patients');
});
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/view-doctors', [PageController::class, 'viewDoctors'])->name('view.doctors');
    Route::get('/doctor-data', [DoctorController::class, 'viewDoctors'])->name('doctors.data');
    Route::post('/addDoctor', [UserController::class, 'addDoctor'])->name('add.doctor');
    Route::put('/updateDoctor/{doctor}', [UserController::class, 'updateDoctor'])->name('update.doctor');
});



Route::middleware(['auth', 'force.password.change'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
