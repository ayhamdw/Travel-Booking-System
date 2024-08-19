<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'username'   => 'required|string|max:255|unique:users',
            'password'   => 'required|string|min:8',
            'email'      => 'required|string|email|max:255|unique:users',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'role'       => 'required|integer|in:0,1',
        ]);

        $user = User::create([
            'username'   => $validated['username'],
            'password'   => Hash::make($validated['password']),
            'email'      => $validated['email'],
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'role'       => $validated['role'],
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }
}
