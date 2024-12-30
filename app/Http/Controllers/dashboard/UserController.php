<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,employee,user',
            'status' => 'boolean',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'User created successfully');
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|unique:users,phone,' . $user->id,
            'role' => 'required|in:admin,employee,user',
            'status' => 'boolean',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function updateStatus($userId)
    {
        $user = User::findOrFail($userId);
        $user->status = !$user->status == 1 ? 1 : 0;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully');
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }


}
