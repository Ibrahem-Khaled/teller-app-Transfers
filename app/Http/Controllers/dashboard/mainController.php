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
        // إحصائيات الدورات
        $coursesCount     = Courses::count();
        $freeCoursesCount = Courses::where('price', '0.00')->count();

        // حساب النسبة بشكل آمن
        $percentageFreeCourses = $coursesCount > 0
            ? round($freeCoursesCount / $coursesCount * 100) . '%'
            : '0%';

        // إحصائيات الفيديوهات
        $videosCount     = Video::count();
        $freeVideosCount = Video::where('is_free', true)->count();

        // حساب النسبة بشكل آمن
        $percentageFreeVideos = $videosCount > 0
            ? round($freeVideosCount / $videosCount * 100) . '%'
            : '0%';

        // باقي الإحصائيات...
        $usersCount            = User::count();
        $activeUsersCount      = User::where('status', true)->count();
        $adminsCount           = User::whereIn('role', ['admin', 'super_admin'])->count();
        $studentsCount         = User::where('role', 'student')->count();
        $teachersCount         = User::where('role', 'teacher')->count();
        $popularCourses        = Courses::withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->take(5)
            ->get();
        $totalViews            = Video::sum('views');
        $reviewsCount          = Review::count();
        $approvedReviewsCount  = Review::where('is_approved', true)->count();
        $commentsCount         = Comment::count();
        $categoriesCount       = Category::count();
        $latestUsers           = User::latest()->take(5)->get();
        $latestCourses         = Courses::latest()->take(5)->get();
        $courses               = Courses::all();

        return view('dashboard.index', compact(
            'usersCount',
            'activeUsersCount',
            'adminsCount',
            'studentsCount',
            'teachersCount',
            'coursesCount',
            'freeCoursesCount',
            'percentageFreeCourses',   // النسبة المحسوبة
            'popularCourses',
            'videosCount',
            'freeVideosCount',
            'percentageFreeVideos',    // النسبة المحسوبة
            'totalViews',
            'reviewsCount',
            'approvedReviewsCount',
            'commentsCount',
            'categoriesCount',
            'latestUsers',
            'latestCourses',
            'courses'
        ));
    }
}
