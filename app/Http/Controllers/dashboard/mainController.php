<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Courses;
use App\Models\Review;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class mainController extends Controller
{
    public function index()
    {
        // إحصائيات المستخدمين
        $usersCount = User::count();
        $activeUsersCount = User::where('status', true)->count();
        $adminsCount = User::whereIn('role', ['admin', 'super_admin'])->count();
        $studentsCount = User::where('role', 'student')->count();

        $teachersCount = User::where('role', 'teacher')->count();

        // إحصائيات الدورات
        $coursesCount = Courses::count();
        $freeCoursesCount = Courses::where('price', '0.00')->count();
        $popularCourses = Courses::withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->take(5)
            ->get();

        // إحصائيات الفيديوهات
        $videosCount = Video::count();
        $freeVideosCount = Video::where('is_free', true)->count();
        $totalViews = Video::sum('views');

        // إحصائيات التقييمات والتعليقات
        $reviewsCount = Review::count();
        $approvedReviewsCount = Review::where('is_approved', true)->count();
        $commentsCount = Comment::count();

        // إحصائيات الأقسام
        $categoriesCount = Category::count();

        // آخر المستخدمين المسجلين
        $latestUsers = User::latest()->take(5)->get();

        // آخر الدورات المضافة
        $latestCourses = Courses::latest()->take(5)->get();
        $courses = Courses::get();

        return view('dashboard.index', compact(
            'usersCount',
            'activeUsersCount',
            'adminsCount',
            'studentsCount',
            'coursesCount',
            'freeCoursesCount',
            'popularCourses',
            'videosCount',
            'freeVideosCount',
            'totalViews',
            'reviewsCount',
            'approvedReviewsCount',
            'commentsCount',
            'categoriesCount',
            'latestUsers',
            'latestCourses',
            'courses',
            'teachersCount'
        ));
    }
}
