<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Courses;
use App\Models\Review;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $courses = Courses::where('status', 'active')
            ->with(['category', 'teacher'])
            ->latest()->take(4)->get();

        $reviews = Review::where('is_approved', 1)
            ->with(['user', 'course'])
            ->latest()->take(3)->get();

        $trainers = User::where('role', 'teacher')
            ->withCount([
                'courses' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->latest()->take(4)->get();

        $categories = Category::latest()->take(8)->get();

        return view('home', compact('courses', 'reviews', 'trainers', 'categories'));
    }

    public function about()
    {
        $worker_team = User::whereIn('role', ['admin', 'super_admin', 'teacher'])
            ->withCount([
                'courses' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->latest()->take(4)->get();

        return view('about-us', compact('worker_team'));
    }

    public function contact()
    {
        return view('contact-us');
    }

    public function courses(Category $category)
    {
        // نحمل علاقة الدورات
        $category->load('courses');

        // ننشئ متغيّراً يحتوي على المجموع
        $courses = $category->courses;

        // نمرّر الدورات إلى الـ view
        return view('courses', compact('courses', 'category'));
    }

    public function courseDetails(Courses $course, Video $video = null)
    {
        // إذا لم يُمرَّر فيديو، نأخذ أول فيديو في الدورة
        if ($video) {
            // نتحقّق أن الفيديو ينتمي للدورة وإلا نرمي 404
            $video = $course->videos()->findOrFail($video->id);
        } else {
            $video = $course->videos()->firstOrFail();
        }

        // نحمّل العلاقات المطلوبة
        $course->load(['category', 'teacher', 'reviews.user']);

        // نمرّر المتغيّرات إلى الواجهة
        return view('course-details', compact('course', 'video'));
    }

    public function storeComment(Request $request, $video)
    {
        $video = Video::find($video);

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $video->comments()->create([
            'user_id' => auth()->user()->id,
            'video_id' => $video->id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function payment()
    {
        return view('payment');
    }
}
