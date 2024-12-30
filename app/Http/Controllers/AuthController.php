<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function profile()
    {
        $user = User::find(Auth::id());
        return view('Auth.proflie', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();

        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح.');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home.dashboard')->with('success', 'تم تسجيل الدخول بنجاح.');
        }
        return view('Auth.login');
    }

    public function customLogin(Request $request)
    {
        // التحقق من صحة الإدخال
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب إدخال بريد إلكتروني صالح.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min' => 'يجب أن تحتوي كلمة المرور على 6 أحرف على الأقل.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (auth()->attempt($credentials, $remember)) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('home.dashboard')->with('success', 'تم تسجيل الدخول بنجاح.');
            } else {
                return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح.');
            }
        }
        return redirect()->back()->with('error', 'تفاصيل تسجيل الدخول غير صحيحة. يرجى المحاولة مرة أخرى.');
    }


    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('home.dashboard')->with('success', 'تم تسجيل الدخول بنجاح.');
        }
        return view('Auth.register');
    }

    public function customRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'address' => 'required|max:255',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $data['role'] = 'employee';
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        Auth::login($user);
        return redirect()->back()->with('success', 'تم انشاء حسابك بنجاح');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful.');
    }

    public function forgetPassword()
    {
        return view('Auth.forgetPassword');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب إدخال بريد إلكتروني صالح.',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'لم يتم العثور على مستخدم بهذا البريد الإلكتروني.']);
        }
        // إرسال رسالة نجاح
        return redirect()->back()->with('success', 'تم إرسال رابط استعادة كلمة المرور إلى بريدك الإلكتروني.');
    }

}
