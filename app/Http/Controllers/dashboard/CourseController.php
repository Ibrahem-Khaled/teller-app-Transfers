<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Courses as Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'all');
        $level = $request->input('level', 'all');
        $courses = Course::with(['category'])
            ->withTrashed()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->when($status !== 'all', function ($query) use ($status) {
                return $status === 'active'
                    ? $query->whereNull('deleted_at')
                    : $query->whereNotNull('deleted_at');
            })
            ->when($level !== 'all', function ($query) use ($level) {
                return $query->where('level', $level);
            })
            ->latest()
            ->paginate(10);

        $activeCount = Course::count();
        $trashedCount = Course::onlyTrashed()->count();
        $teachers = User::where('role', 'teacher')->get();

        $totalCount = $activeCount + $trashedCount;

        $levels = [
            'beginner' => 'مبتدئ',
            'intermediate' => 'متوسط',
            'advanced' => 'متقدم'
        ];

        $categories = Category::all();

        return view('dashboard.courses.index', compact(
            'courses',
            'activeCount',
            'trashedCount',
            'totalCount',
            'search',
            'status',
            'level',
            'levels',
            'teachers',
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'teacher_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required|date_format:H:i',
            'level' => 'required|in:beginner,intermediate,advanced',
            'language' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100'
        ]);

        $data = $request->except('thumbnail');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'تم إضافة الدورة بنجاح');
    }

    public function show(Course $course)
    {
        return view('dashboard.courses.show', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'teacher_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'required|date_format:H:i',
            'level' => 'required|in:beginner,intermediate,advanced',
            'language' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100'
        ]);

        $data = $request->except('thumbnail');

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'تم تحديث الدورة بنجاح');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'تم حذف الدورة بنجاح');
    }

    public function restore($id)
    {
        Course::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('courses.index')->with('success', 'تم استعادة الدورة بنجاح');
    }

    public function forceDelete($id)
    {
        $course = Course::withTrashed()->findOrFail($id);

        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->forceDelete();

        return redirect()->route('courses.index')->with('success', 'تم الحذف النهائي للدورة بنجاح');
    }
}
