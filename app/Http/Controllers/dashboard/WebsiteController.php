<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class WebsiteController extends Controller
{
    public function edit()
    {
        $websiteUser = User::where('role', 'website')->firstOrFail();
        return view('dashboard.website.edit', compact('websiteUser'));
    }

    public function update(Request $request)
    {
        $websiteUser = User::where('role', 'website')->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($websiteUser->id),
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('users')->ignore($websiteUser->id),
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

        $websiteUser->update($data);

        return redirect()->route('website.edit')
            ->with('success', 'تم تحديث بيانات حساب الموقع بنجاح');
    }

    // Middleware للتأكد من وجود حساب الموقع
    public static function ensureWebsiteUserExists()
    {
        if (!User::where('role', 'website')->exists()) {
            User::create([
                'name' => 'Website Account',
                'email' => 'website@website.com',
                'phone' => '0000000000',
                'address' => 'Website Address',
                'role' => 'website',
                'password' => Hash::make('password'),
                'status' => 1,
            ]);
        }
    }
}
