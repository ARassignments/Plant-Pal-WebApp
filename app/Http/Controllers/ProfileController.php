<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $user = auth()->user();
        if ($request->hasFile('profile_image')) {
            // Remove old profile image if exists
            if ($user->img) {
                $oldImagePath = public_path('user-profile/' . $user->img);
                if (file_exists($oldImagePath) && !is_dir($oldImagePath)) {
                    unlink($oldImagePath); // Remove old image file
                }
            }
    
            // Handle new profile image upload
            $file = $request->file('profile_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->move(public_path('user-profile'), $fileName);
    
            $user->img = $fileName; // Save the file name in the database
        }
        $request->user()->save();

        return Redirect::route('Profile.account')->with('status', 'profile-updated');
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
