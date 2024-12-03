<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\AppNotification;
use Illuminate\Http\Request;

class AppNotificationController extends Controller
{
    public function index()
    {
        $notifications = AppNotification::all();
        return view('dashboard.app-notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('notifications', 'public');
        }

        AppNotification::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Notification added successfully');
    }
    public function update(Request $request, AppNotification $notification)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('notifications', 'public');
            $notification->update(['image' => $imagePath]);
        }

        $notification->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('success', 'Notification updated successfully');
    }

    public function destroy(AppNotification $notification)
    {
        if ($notification->image) {
            \Storage::delete('public/' . $notification->image);
        }

        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully');
    }

}
