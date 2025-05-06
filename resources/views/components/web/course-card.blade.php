<style>
    body {
        font-family: 'Tajawal', sans-serif;
    }

    .course-card {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
    }
</style>



<a href="{{ route('course.details', $course->id) }}" class="course-card bg-white overflow-hidden">
    <div class="relative">
        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="برمجة تطبيقات الويب" class="w-full h-48 object-cover">
        @if ($course->is_new)
            <div class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                جديد
            </div>
        @endif
    </div>
    <div class="p-6">
        <div class="flex items-center mb-3">
            <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $course->category->name }}</span>
            <span class="text-yellow-500 ml-2">
                <i class="fas fa-star"></i>
                <span class="text-gray-700">
                    {{ number_format($course->reviews->avg('rating') ?? 0, 1) }}
                    ({{ $course->reviews->count() }})
                </span>
            </span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $course->name }}</h3>
        <p class="text-gray-600 mb-4">{{ $course->description ?? 'لا يوجد وصف' }}</p>

        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <img src="{{ asset('storage/' . $course->teacher->avatar) ?? asset('assets/img/default-avatar.png') }}"
                    alt="المدرب" class="w-8 h-8 rounded-full ml-2">
                <span class="text-sm text-gray-700">{{ $course->teacher->name }}</span>
            </div>
            <div class="text-sm text-gray-500">32 ساعة</div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <div class="flex items-center">
                <div class="relative w-10 h-10 ml-2">
                    <svg class="w-full h-full" viewBox="0 0 36 36">
                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-gray-200"
                            stroke-width="3"></circle>
                        <circle cx="18" cy="18" r="16" fill="none" class="stroke-blue-600"
                            stroke-width="3" stroke-dasharray="80 100">
                        </circle>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center text-xs font-bold text-blue-600">
                        80%</div>
                </div>
                <span class="text-sm text-gray-500">مكتمل</span>
            </div>
            <div>
                @if ($course->discount > 0)
                    <span class="text-lg font-bold text-green-600">خصم {{ $course->discount }} </span>
                    <span class="text-sm text-gray-500 line-through mr-2">{{ $course->price }}</span>

                @else
                    <span class="text-lg font-bold text-green-600">{{ $course->price }}</span>
                @endif

            </div>
        </div>
    </div>
</a>
