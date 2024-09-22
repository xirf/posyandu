<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller {
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }


        if ($request->file('picture')) {
            $filename = uniqid() . '.' . $request->file('picture')->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('profile-pictures', $request->file('picture'), $filename);
            $request->user()->picture =  Storage::url('profile-pictures/' . $filename);
        }
        if ($request->bio) {
            $request->user()->bio = $request->input('bio');
        }


        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse {
        if (Auth::user()->id == 1) {
            $request->validateWithBag('userDeletion', [
                'deletedId' => ['required'],
            ]);

            $user = User::find($request->input('deletedId'));

            if ($user->id == 1) {
                return Redirect::route('profile.edit')->with('status', 'cannot-delete-admin');
            }

            $user->delete();
            return Redirect::back()->with('status', 'user-deleted');
        }

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
