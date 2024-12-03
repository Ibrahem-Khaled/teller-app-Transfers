<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('dashboard.sliders', compact('sliders'));
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
            $imagePath = $request->file('image')->store('sliders', 'public');
        }

        Slider::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Slider added successfully');
    }


    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sliders', 'public');
            $slider->update(['image' => $imagePath]);
        }

        $slider->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
        ]);

        return redirect()->back()->with('success', 'Slider updated successfully');
    }


    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            \Storage::delete('public/' . $slider->image);
        }

        $slider->delete();

        return redirect()->back()->with('success', 'Slider deleted successfully');
    }


}
