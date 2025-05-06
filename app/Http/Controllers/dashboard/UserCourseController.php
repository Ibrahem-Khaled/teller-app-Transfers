<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;

class UserCourseController extends Controller
{
    public function index()
    {
        $selectedStatus = request('status', 'all');
        $search = request('search');

        $userCourses = UserCourse::query()
            ->when($selectedStatus !== 'all', function ($query) use ($selectedStatus) {
                $query->where('status', $selectedStatus);
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })->orWhereHas('course', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            })
            ->with(['user', 'course'])
            ->latest()
            ->paginate(10);

        $totalEnrollments = UserCourse::count();
        $completedEnrollments = UserCourse::where('status', 'completed')->count();
        $inProgressEnrollments = UserCourse::where('status', 'in_progress')->count();
        $completionRate = $totalEnrollments > 0 ? round(($completedEnrollments / $totalEnrollments) * 100) : 0;
        // $users = User::where('role', 'student')->pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $courses = Courses::pluck('name', 'id');
        return view('dashboard.user-courses.index', compact(
            'userCourses',
            'selectedStatus',
            'totalEnrollments',
            'completedEnrollments',
            'inProgressEnrollments',
            'completionRate',
            'users',
            'courses',
        ));
    }

    public function create()
    {
        $users = User::where('role', 'student')->pluck('name', 'id');
        $courses = Courses::pluck('name', 'id');
        return view('dashboard.user-courses.modals.create', compact('users', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:in_progress,completed',
        ]);

        // التحقق من عدم وجود تسجيل مسبق
        $exists = UserCourse::where('user_id', $request->user_id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'المستخدم مسجل بالفعل في هذه الدورة');
        }

        UserCourse::create($request->all());

        return redirect()->route('user-courses.index')
            ->with('success', 'تم تسجيل المستخدم في الدورة بنجاح');
    }

    public function show(UserCourse $userCourse)
    {
        return view('dashboard.user-courses.modals.show', compact('userCourse'));
    }

    public function edit(UserCourse $userCourse)
    {
        $users = User::where('role', 'student')->pluck('name', 'id');
        $courses = Courses::pluck('name', 'id');
        return view('dashboard.user-courses.modals.edit', compact('userCourse', 'users', 'courses'));
    }

    public function update(Request $request, UserCourse $userCourse)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:in_progress,completed',
        ]);

        $userCourse->update($request->all());

        return redirect()->route('user-courses.index')
            ->with('success', 'تم تحديث تسجيل الدورة بنجاح');
    }

    public function destroy(UserCourse $userCourse)
    {
        $userCourse->delete();
        return redirect()->route('user-courses.index')
            ->with('success', 'تم حذف تسجيل الدورة بنجاح');
    }

    public function complete(UserCourse $userCourse)
    {
        $userCourse->update(['status' => 'completed']);
        return redirect()->back()
            ->with('success', 'تم تحديث حالة الدورة إلى مكتملة');
    }
}
