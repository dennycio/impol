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
    
    public function show(): View
    {
    return view('profile.show', [
        'user' => auth()->user(),
    ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validated();

        // Atribuir novos campos
        $user->fill($validated);

        // Campos personalizados adicionais
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->birthdate = $request->input('birthdate');
        $user->gender = $request->input('gender');
        $user->level = $request->input('level');
        $user->previous_group = $request->input('previous_group');
        $user->father_name = $request->input('father_name');
        $user->mother_name = $request->input('mother_name');
        $user->marital_status = $request->input('marital_status');

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
