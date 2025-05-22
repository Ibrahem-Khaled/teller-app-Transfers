<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        // 1) الأدوار المسموح بها فقط
        $roles = ['admin', 'teacher', 'student', 'super_admin'];

        // 2) قيمة الفلتر الافتراضية (كل الأدوار من المصفوفة)
        $selectedRole = $request->role ?? 'all';
        $search       = $request->search;

        // 3) بناء الاستعلام
        $users = User::whereIn('role', $roles)                                    // قصر النتائج على الأدوار المحددة فقط :contentReference[oaicite:0]{index=0}
            ->when($selectedRole !== 'all', function ($q) use ($selectedRole) {  // إذا اختار المستخدم دورًا محددًا
                return $q->where('role', $selectedRole);
            })
            ->when($search, function ($q, $search) {                              // شرط البحث
                return $q->where(function ($sub) use ($search) {                  // تجميع أو
                    $sub->where('name',  'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();


        // إحصائيات
        $usersCount       = User::count();
        $activeUsersCount = User::where('status', 1)->count();
        $adminsCount      = User::whereIn('role', ['admin', 'super_admin'])->count();

        return view('dashboard.users.index', compact(
            'users',
            'roles',
            'selectedRole',
            'usersCount',
            'activeUsersCount',
            'adminsCount',
            'search'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'nullable|unique:users,phone',
            'role' => 'required|in:admin,teacher,student,super_admin',
            'status' => 'boolean',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('avatar', 'password_confirmation');
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        User::create($data);

        return redirect()->back()->with('success', trans('users.user_created_successfully'));
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,teacher,student,super_admin',
            'status' => 'boolean',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('avatar', 'password_confirmation');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->back()->with('success', trans('users.user_updated_successfully'));
    }

    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->back()->with('success', trans('users.user_deleted_successfully'));
    }
}
