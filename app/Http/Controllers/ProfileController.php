<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $userDetails = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
        ]);

        $userId = Auth::user()->id;
        $user = User::where('id', $userId);
        $userEmail = $request->email;
        $user_with_email = User::where('email', $userEmail)->count();

        if($user_with_email > 1){
            return redirect()->back()->with('error', 'email already exists');
        }

        if(!$user){
            return redirect()->back()->with('error', 'User not found');
        }



        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        //     return redirect()->back()->with('error', 'Email has already been taken');
        // }

        $user->update($userDetails);

        return redirect()->back()->with('status', 'Update successful');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
