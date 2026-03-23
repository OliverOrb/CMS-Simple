<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 'with('roles')' fetches all the roles in one efficient query alongside the users
        $users = User::with('roles')->latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Get the user's current role name, or an empty string if they don't have one
        $userRole = $user->roles->pluck('name')->first() ?? '';

        return view('users.edit', compact('user', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // 'nullable' allows them to leave it blank.
            // 'exists' ensures they didn't make a typo.
            'role' => 'nullable|string|exists:roles,name'
        ], [
            // Custom error message just in case they make a typo
            'role.exists' => 'That role does not exist. Please type Admin, Editor, or leave it blank.'
        ]);

        // Update basic user info
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // If they typed a valid role, assign it. If they left it blank, remove their roles.
        if (!empty($validated['role'])) {
            $user->syncRoles([$validated['role']]);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
}
