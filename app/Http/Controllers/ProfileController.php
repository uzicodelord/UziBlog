<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    public function show(User $user)
    {
        // Get the level data for the user
        $levelData = $user->getlevelData(); // replace with your own logic to get the level data

        return view('profile.show', [
            'user' => $user,
            'levelData' => $levelData,
        ]);
    }


    public function edit(User $user)
    {
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = $profilePicture->getClientOriginalName();
            $path = $profilePicture->storeAs('public/images', $filename);
            $user->profile_picture = basename($path);
        }

        $user->update($validatedData);

        return redirect()->route('profile.show', $user);
    }

}
