<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'all');
        $type = $request->input('type', 'all');
        $course_id = $request->input('course_id');

        $videos = Video::with(['course'])
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->when($status !== 'all', function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($type !== 'all', function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->when($course_id, function ($query, $course_id) {
                return $query->where('course_id', $course_id);
            })
            ->orderBy('order')
            ->paginate(10);

        $activeCount = Video::where('status', 'active')->count();
        $inactiveCount = Video::where('status', 'inactive')->count();
        $totalCount = $activeCount + $inactiveCount;

        $courses = Courses::all();

        return view('dashboard.videos.index', compact(
            'videos',
            'activeCount',
            'inactiveCount',
            'totalCount',
            'search',
            'status',
            'type',
            'course_id',
            'courses'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'required|file|mimes:mp4,avi,mpeg,mpg|max:512000', // حتى 500MB :contentReference[oaicite:0]{index=0}
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'type' => 'required|in:video,audio',
            'order' => 'required|integer|min:0',
            'is_free' => 'nullable|boolean'
        ]);

        $data = $request->except(['thumbnail', 'video_file']);

        if ($request->hasFile('video_file')) {
            $data['video_path'] = $request->file('video_file')
                ->store('videos/files', 'public');  // يولّد اسمًا فريدًا ويحفظه في storage/app/public/videos/files :contentReference[oaicite:1]{index=1}
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }

        Video::create($data);

        return redirect()->route('videos.index')->with('success', 'تم إضافة المقطع بنجاح');
    }

    public function show(Video $video)
    {
        return view('dashboard.videos.show', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'required|file|mimes:mp4,avi,mpeg,mpg|max:512000', // حتى 500MB :contentReference[oaicite:0]{index=0}
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'type' => 'required|in:video,audio',
            'order' => 'required|integer|min:0',
            'is_free' => 'nullable|boolean'
        ]);

        $data = $request->except(['thumbnail', 'video_file']);

        if ($request->hasFile('video_file')) {
            if ($video->video_path) {
                Storage::disk('public')->delete($video->video_path);
            }
            $data['video_path'] = $request->file('video_file')
                ->store('videos/files', 'public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbnails', 'public');
        }

        $video->update($data);

        return redirect()->route('videos.index')->with('success', 'تم تحديث المقطع بنجاح');
    }

    public function destroy(Video $video)
    {
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }

        $video->delete();

        return redirect()->route('videos.index')->with('success', 'تم حذف المقطع بنجاح');
    }
}
