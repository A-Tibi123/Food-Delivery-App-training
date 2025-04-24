<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManager extends Controller
{
    // Get all users
    public function listUsers()
    {
        return response()->json(User::orderBy('name')->get());
    }

    // Register new user
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'type'     => 'nullable|string'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'User created',
            'user'    => $user
        ]);
    }

    // Update user info
    public function updateUser(Request $request)
    {
        $user = User::find($request->input('user_id'));

        if (!$user) {
            return response()->json(['status' => 'failed', 'message' => 'User not found'], 404);
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('type')) {
            $user->type = $request->type;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['status' => 'success', 'message' => 'User updated', 'user' => $user]);
    }

    // Delete user
    public function deleteUser(Request $request)
    {
        $user = User::find($request->input('user_id'));

        if (!$user) {
            return response()->json(['status' => 'failed', 'message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['status' => 'success', 'message' => 'User deleted']);
    }
}