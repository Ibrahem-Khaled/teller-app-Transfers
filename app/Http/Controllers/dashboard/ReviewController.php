<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $selectedCourse = request('course', 'all');
        $search = request('search');

        $reviews = Review::query()
            ->when($selectedCourse !== 'all', function ($query) use ($selectedCourse) {
                $query->where('course_id', $selectedCourse);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('content', 'like', '%' . $search . '%');
            })
            ->with(['user', 'course'])
            ->latest()
            ->paginate(10);

        $courses = Courses::pluck('name', 'id');
        $totalReviews = Review::count();
        $approvedReviews = Review::where('is_approved', true)->count();
        $pendingReviews = Review::where('is_approved', false)->count();
        $averageRating = Review::avg('rating') ?? 0;
        $users = User::pluck('name', 'id');

        return view('dashboard.reviews.index', compact(
            'reviews',
            'courses',
            'selectedCourse',
            'totalReviews',
            'approvedReviews',
            'pendingReviews',
            'averageRating',
            'users',
        ));
    }

    public function create()
    {
        $courses = Courses::pluck('title', 'id');
        $users = User::pluck('name', 'id');
        return view('dashboard.reviews.modals.create', compact('courses', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'content' => 'required|string|min:10',
            'rating' => 'required|integer|between:1,5',
            'is_approved' => 'sometimes|boolean'
        ]);

        Review::create($request->all());

        return redirect()->route('reviews.index')
            ->with('success', 'تم إضافة التقييم بنجاح');
    }

    public function show(Review $review)
    {
        return view('dashboard.reviews.modals.show', compact('review'));
    }

    public function edit(Review $review)
    {
        $courses = Courses::pluck('title', 'id');
        $users = User::pluck('name', 'id');
        return view('dashboard.reviews.modals.edit', compact('review', 'courses', 'users'));
    }

    public function update(Request $request, Review $review)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'content' => 'required|string|min:10',
            'rating' => 'required|integer|between:1,5',
            'is_approved' => 'sometimes|boolean'
        ]);

        $review->update($request->all());

        return redirect()->route('reviews.index')
            ->with('success', 'تم تحديث التقييم بنجاح');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')
            ->with('success', 'تم حذف التقييم بنجاح');
    }

    public function approve(Review $review)
    {
        $review->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'تم الموافقة على التقييم بنجاح');
    }
}
