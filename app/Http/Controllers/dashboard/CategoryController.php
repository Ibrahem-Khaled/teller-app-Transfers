<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status', 'all');

        $categories = Category::withTrashed()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->when($status !== 'all', function ($query) use ($status) {
                return $status === 'active'
                    ? $query->whereNull('deleted_at')
                    : $query->whereNotNull('deleted_at');
            })
            ->latest()
            ->paginate(10);

        $activeCount = Category::count();
        $trashedCount = Category::onlyTrashed()->count();
        $totalCount = $activeCount + $trashedCount;

        return view('dashboard.categories.index', compact(
            'categories',
            'activeCount',
            'trashedCount',
            'totalCount',
            'search',
            'status'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('categories/icons', 'public');
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'تم إضافة الفئة بنجاح');
    }

    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('icon');

        if ($request->hasFile('icon')) {
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }
            $data['icon'] = $request->file('icon')->store('categories/icons', 'public');
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'تم تحديث الفئة بنجاح');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'تم حذف الفئة بنجاح');
    }

    public function restore($id)
    {
        Category::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('categories.index')->with('success', 'تم استعادة الفئة بنجاح');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        if ($category->icon) {
            Storage::disk('public')->delete($category->icon);
        }

        $category->forceDelete();

        return redirect()->route('categories.index')->with('success', 'تم الحذف النهائي للفئة بنجاح');
    }
}
