<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeamworkController extends Controller
{
    public function index()
    {
        $teamMembers = User::where('role', 'team_work')->latest()->paginate(10);
        return view('dashboard.teamwork.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('dashboard.teamwork.modals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'team_work',
            'status' => 1,
        ]);

        return redirect()->route('teamwork.index')
            ->with('success', 'تم إضافة عضو الفريق بنجاح');
    }

    public function edit(User $teamMember)
    {
        $this->authorize('updateTeamwork', $teamMember);
        return view('dashboard.teamwork.modals.edit', compact('teamMember'));
    }

    public function update(Request $request, User $teamMember)
    {
        $this->authorize('updateTeamwork', $teamMember);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($teamMember->id),
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('users')->ignore($teamMember->id),
            ],
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $teamMember->update($data);

        return redirect()->route('teamwork.index')
            ->with('success', 'تم تحديث بيانات عضو الفريق بنجاح');
    }

    public function destroy(User $teamMember)
    {
        $this->authorize('deleteTeamwork', $teamMember);

        // منع حذف آخر عضو في الفريق
        if (User::where('role', 'team_work')->count() <= 1) {
            return redirect()->back()
                ->with('error', 'لا يمكن حذف آخر عضو في الفريق');
        }

        $teamMember->delete();
        return redirect()->route('teamwork.index')
            ->with('success', 'تم حذف عضو الفريق بنجاح');
    }
}
