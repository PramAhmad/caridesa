<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the user profile page
     */
    public function show()
    {
        $user = Auth::user();
        return view('tenant.profile.show', compact('user'));
    }
    
    /**
     * Show the profile edit form
     */
    public function edit()
    {
        $user = Auth::user();
        return view('tenant.profile.edit', compact('user'));
    }
    
    /**
     * Update the user's profile information
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:500'],
            'location' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2MB max
        ]);
        
        if ($request->hasFile('avatar')) {
            if ($user->avatar && !str_contains($user->avatar, 'default')) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }
        
        $user->update($validated);
        
        return redirect()->route('tenant.profile.show')
            ->with('success', 'Profile updated successfully!');
    }
    
    /**
     * Show the change password form
     */
    public function editPassword()
    {
        return view('tenant.profile.change-password');
    }
    
    /**
     * Update the user's password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ]);
        
        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        
        return redirect()->route('tenant.profile.show')
            ->with('success', 'Password changed successfully!');
    }
}
