<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class SettingsController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validate incoming data
        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            
            // Store the file in storage/app/public/avatars
            $path = $file->store('avatars', 'public');
            
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $validated['avatar'] = $path;
        }

        // Update user with validated data
        $user->update($validated);

        return redirect()->route('settings.index')->with('success', 'Profile updated successfully!');
    }
}
