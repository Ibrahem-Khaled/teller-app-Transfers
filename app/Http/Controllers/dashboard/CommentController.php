<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $selectedVideo = request('video', 'all');
        $search = request('search');

        $comments = Comment::query()
            ->when($selectedVideo !== 'all', function ($query) use ($selectedVideo) {
                $query->where('video_id', $selectedVideo);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('comment', 'like', '%' . $search . '%');
            })
            ->with(['user', 'video'])
            ->latest()
            ->paginate(10);

        $videos = Video::pluck('title', 'id');
        $totalComments = Comment::count();
        $recentComments = Comment::where('created_at', '>', now()->subDays(7))->count();
        $topUser = User::withCount('comments')->orderBy('comments_count', 'desc')->first();
        $users = User::pluck('name', 'id');
        return view('dashboard.comments.index', compact(
            'comments',
            'videos',
            'selectedVideo',
            'totalComments',
            'recentComments',
            'topUser',
            'users'
        ));
    }

    public function create()
    {
        $videos = Video::pluck('title', 'id');
        $users = User::pluck('name', 'id');
        return view('dashboard.comments.modals.create', compact('videos', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'video_id' => 'required|exists:videos,id',
            'comment' => 'required|string|min:3|max:1000',
        ]);

        Comment::create($request->only(['user_id', 'video_id', 'comment']));

        return redirect()->route('comments.index')
            ->with('success', 'تم إضافة التعليق بنجاح');
    }

    public function show(Comment $comment)
    {
        return view('dashboard.comments.modals.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        $videos = Video::pluck('title', 'id');
        $users = User::pluck('name', 'id');
        return view('dashboard.comments.modals.edit', compact('comment', 'videos', 'users'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'video_id' => 'required|exists:videos,id',
            'comment' => 'required|string|min:3|max:1000',
        ]);

        $comment->update($request->only(['user_id', 'video_id', 'comment']));

        return redirect()->route('comments.index')
            ->with('success', 'تم تحديث التعليق بنجاح');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.index')
            ->with('success', 'تم حذف التعليق بنجاح');
    }
}
