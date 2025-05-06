<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->name }} | {{ $video->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #6d28d9;
            --primary-light: #8b5cf6;
            --primary-dark: #4c1d95;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f9fafb;
        }

        .gradient-text {
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .video-container iframe,
        .video-container video {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            border-radius: 0.75rem;
        }

        .tabs {
            display: flex;
            border-bottom: 2px solid #e5e7eb;
        }

        .tab {
            padding: 1rem 1.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            font-weight: 600;
            color: #6b7280;
        }

        .tab:hover {
            color: var(--primary);
        }

        .tab.active {
            color: var(--primary-dark);
        }

        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            right: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            border-radius: 3px 3px 0 0;
        }

        .tab-content {
            display: none;
            padding: 1.75rem 0;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tab-content.active {
            display: block;
        }

        .sidebar {
            scrollbar-width: thin;
            scrollbar-color: var(--primary) #f3f4f6;
            max-height: 70vh;
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #f3f4f6;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background-color: var(--primary);
            border-radius: 3px;
        }

        .lesson-item {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .lesson-item:hover {
            background-color: #f5f3ff;
            transform: translateX(-5px);
        }

        .lesson-item.current {
            background-color: #ede9fe;
            border-right: 3px solid var(--primary);
        }

        .card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(109, 40, 217, 0.3);
        }

        .resource-badge {
            background-color: #ede9fe;
            color: var(--primary-dark);
            transition: all 0.3s ease;
        }

        .resource-badge:hover {
            background-color: #ddd6fe;
        }

        .teacher-social-icon {
            transition: all 0.3s ease;
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .teacher-social-icon:hover {
            transform: translateY(-3px) scale(1.1);
        }

        .comment-avatar {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .comment-avatar:hover {
            border-color: var(--primary);
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .tabs {
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }

            .tabs::-webkit-scrollbar {
                display: none;
            }

            .tab {
                padding: 0.75rem 1.25rem;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    @include('components.web.header')

    <section class="py-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-3/4 space-y-6">
                    <!-- Video Player -->
                    <div class="card bg-white rounded-xl overflow-hidden transition-all duration-300">
                        <div class="video-container">
                            <video controls controlsList="nodownload" disablePictureInPicture
                                oncontextmenu="return false;" class="w-full h-full">
                                <source src="{{ Storage::url($video->video_path) }}" type="video/mp4">
                                متصفحك لا يدعم تشغيل الفيديو.
                            </video>
                        </div>
                        <div
                            class="p-6 border-t border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $video->title }}</h2>
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <button class="text-gray-500 hover:text-purple-600 transition transform hover:scale-110"
                                    title="حفظ للاحقاً">
                                    <i class="far fa-bookmark text-xl"></i>
                                </button>
                                <button class="text-gray-500 hover:text-purple-600 transition transform hover:scale-110"
                                    title="مشاركة">
                                    <i class="fas fa-share-alt text-xl"></i>
                                </button>
                                <button
                                    class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm font-medium hover:bg-purple-200 transition">
                                    <i class="fas fa-thumbs-up ml-2"></i> أعجبني
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs Section -->
                    <div class="card bg-white rounded-xl overflow-hidden">
                        <div class="tabs">
                            <div class="tab active" data-tab="description">
                                <i class="fas fa-info-circle ml-2"></i> الوصف
                            </div>
                            <div class="tab" data-tab="comments">
                                <i class="fas fa-comments ml-2"></i> التعليقات ({{ $video->comments->count() }})
                            </div>
                            <div class="tab" data-tab="resources">
                                <i class="fas fa-file-download ml-2"></i> الموارد ({{ $video->resources->count() }})
                            </div>
                            <div class="tab" data-tab="course-content">
                                <i class="fas fa-list-ol ml-2"></i> محتوى الدورة
                            </div>
                        </div>

                        <div class="tab-contents px-6">
                            <!-- Description Tab -->
                            <div id="description" class="tab-content active">
                                <h3 class="text-xl font-bold mb-4 text-gray-800">عن هذا الدرس</h3>
                                <div class="prose max-w-none text-gray-700 leading-relaxed">
                                    {!! nl2br(e($video->description)) !!}
                                </div>

                                <div class="mt-8 pt-6 border-t border-gray-200">
                                    <h4 class="text-lg font-semibold mb-3">ما ستتعلمه في هذا الدرس:</h4>
                                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mt-1 mr-2"><i
                                                    class="fas fa-check-circle"></i></span>
                                            <span>فهم المفاهيم الأساسية للموضوع</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mt-1 mr-2"><i
                                                    class="fas fa-check-circle"></i></span>
                                            <span>تطبيق المعرفة في مشاريع عملية</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mt-1 mr-2"><i
                                                    class="fas fa-check-circle"></i></span>
                                            <span>حل المشكلات الشائعة في هذا المجال</span>
                                        </li>
                                        <li class="flex items-start">
                                            <span class="text-purple-500 mt-1 mr-2"><i
                                                    class="fas fa-check-circle"></i></span>
                                            <span>أفضل الممارسات والمعايير</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Comments Tab -->
                            <div id="comments" class="tab-content">
                                <h3 class="text-xl font-bold mb-6 text-gray-800">التعليقات والمناقشات</h3>

                                <form method="POST" action="{{ route('videos.comments.store', $video->id) }}"
                                    class="space-y-4 mb-8">
                                    @csrf
                                    <div class="flex items-start space-x-4 rtl:space-x-reverse">
                                        <img src="{{ Auth::user()->avatar_url }}"
                                            class="w-12 h-12 rounded-full border-2 border-purple-200 comment-avatar">
                                        <div class="flex-1">
                                            <textarea name="comment" rows="3"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-300 focus:border-transparent transition"
                                                placeholder="شاركنا رأيك أو اطرح سؤالك..."></textarea>
                                            <div class="mt-3 flex justify-end">
                                                <button type="submit"
                                                    class="btn-primary py-2 px-6 rounded-full font-medium">
                                                    نشر التعليق
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="space-y-6">
                                    @foreach ($video->comments as $comment)
                                        <div
                                            class="flex items-start space-x-4 rtl:space-x-reverse pb-6 border-b border-gray-100 last:border-0 last:pb-0">
                                            <img src="{{ $comment->user->avatar_url }}"
                                                class="w-12 h-12 rounded-full border-2 border-purple-200 comment-avatar">
                                            <div class="flex-1">
                                                <div class="flex justify-between items-center mb-1">
                                                    <h4 class="font-bold text-gray-900">{{ $comment->user->name }}</h4>
                                                    <span class="text-sm text-gray-500">
                                                        <i class="far fa-clock ml-1"></i>
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                                <p class="mt-2 text-gray-600">{{ $comment->comment }}</p>
                                                <div
                                                    class="mt-3 flex items-center space-x-4 rtl:space-x-reverse text-sm">
                                                    <button
                                                        class="text-gray-500 hover:text-purple-600 flex items-center">
                                                        <i class="far fa-thumbs-up ml-1"></i> أعجبني
                                                    </button>
                                                    <button
                                                        class="text-gray-500 hover:text-purple-600 flex items-center">
                                                        <i class="far fa-comment ml-1"></i> رد
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Resources Tab -->
                            <div id="resources" class="tab-content">
                                <h3 class="text-xl font-bold mb-6 text-gray-800">الموارد والملفات</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($video->resources as $res)
                                        <a href="{{ Storage::url($res->path) }}"
                                            class="flex items-center p-4 rounded-lg resource-badge hover:shadow-md transition">
                                            <div class="bg-purple-100 p-3 rounded-full mr-3 rtl:mr-0 rtl:ml-3">
                                                <i class="fas fa-file-download text-purple-600"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $res->name }}</h4>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ strtoupper(pathinfo($res->path, PATHINFO_EXTENSION)) }} •
                                                    {{ round(filesize(storage_path('app/public/' . $res->path)) / 1024) }}
                                                    كيلوبايت
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Course Content Tab -->
                            <div id="course-content" class="tab-content">
                                <h3 class="text-xl font-bold mb-6 text-gray-800">محتوى الدورة التدريبية</h3>

                                <div class="space-y-2">
                                    @foreach ($course->videos->groupBy('section') as $section => $videos)
                                        <div class="mb-6">
                                            <div class="flex items-center mb-4">
                                                <div class="gradient-bg w-1 h-6 rounded-full mr-3"></div>
                                                <h4 class="text-lg font-bold text-gray-900">
                                                    {{ $section ?: 'دروس عامة' }}</h4>
                                            </div>

                                            <ul class="space-y-2">
                                                @foreach ($videos as $vid)
                                                    <li>
                                                        <a href="{{ route('course.details', [$course->id, $vid->id]) }}"
                                                            class="flex items-center py-3 px-4 rounded-lg transition {{ $vid->id == $video->id ? 'bg-purple-50 text-purple-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}">
                                                            <i
                                                                class="fas {{ $vid->id == $video->id ? 'fa-play-circle text-purple-600' : 'fa-circle-play text-gray-400' }} ml-3 rtl:ml-0 rtl:mr-3"></i>
                                                            <span class="truncate">{{ $vid->title }}</span>
                                                            <span
                                                                class="ml-auto rtl:ml-0 rtl:mr-auto text-sm text-gray-500">
                                                                {{ $vid->duration }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:w-1/4 space-y-6">
                    <!-- Course Lessons -->
                    <div class="card bg-white rounded-xl overflow-hidden">
                        <div class="p-5 border-b border-gray-200">
                            <h3 class="font-bold text-xl gradient-text flex items-center">
                                <i class="fas fa-list-check ml-2 rtl:ml-0 rtl:mr-2"></i>
                                محتوى الدورة
                            </h3>
                        </div>
                        <div class="sidebar p-4">
                            <ul class="space-y-2">
                                @foreach ($course->videos as $vid)
                                    <li>
                                        <a href="{{ route('course.details', [$course->id, $vid->id]) }}"
                                            class="lesson-item flex items-center py-3 px-3 {{ $vid->id == $video->id ? 'current' : '' }}">
                                            <div
                                                class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center 
                                                        {{ $vid->id == $video->id ? 'bg-purple-100 text-purple-600' : 'bg-gray-100 text-gray-500' }}">
                                                {{ $loop->iteration }}
                                            </div>
                                            <div class="mr-3 rtl:mr-0 rtl:ml-3 truncate">
                                                <h4
                                                    class="text-sm font-medium {{ $vid->id == $video->id ? 'text-purple-700' : 'text-gray-700' }}">
                                                    {{ $vid->title }}
                                                </h4>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <i class="far fa-clock ml-1"></i> {{ $vid->duration }}
                                                </p>
                                            </div>
                                            @if ($vid->id == $video->id)
                                                <div class="ml-auto rtl:ml-0 rtl:mr-auto">
                                                    <div class="w-2 h-2 rounded-full bg-purple-500 animate-pulse">
                                                    </div>
                                                </div>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Instructor Card -->
                    <div class="card bg-white rounded-xl overflow-hidden text-center">
                        <div class="gradient-bg py-4">
                            <h3 class="text-xl font-bold text-white">عن المدرب</h3>
                        </div>
                        <div class="p-6">
                            <img src="{{ $course->teacher->avatar_url }}" alt="{{ $course->teacher->name }}"
                                class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-white shadow-md">
                            <h4 class="text-xl font-bold text-gray-900">{{ $course->teacher->name }}</h4>
                            <p class="text-gray-600 mb-4">{{ $course->teacher->bio }}</p>
                            <button class="btn-primary w-full py-2 rounded-full mt-6 font-medium">
                                <i class="fas fa-envelope ml-2"></i> تواصل مع المدرب
                            </button>
                        </div>
                    </div>

                    <!-- Course Progress -->
                    <div class="card bg-white rounded-xl overflow-hidden">
                        <div class="p-5 border-b border-gray-200">
                            <h3 class="font-bold text-xl gradient-text flex items-center">
                                <i class="fas fa-chart-line ml-2 rtl:ml-0 rtl:mr-2"></i>
                                تقدمك في الدورة
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">إكمال الدورة</span>
                                    <span class="text-sm font-bold text-purple-600">25%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-purple-600 h-2.5 rounded-full" style="width: 25%"></div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-6">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-purple-600">{{$course->videos->count()}}</div>
                                    <div class="text-sm text-gray-500">اجمالي عدد الدروس</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-700">18</div>
                                    <div class="text-sm text-gray-500">دروس متبقية</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-gray-700">3h 45m</div>
                                    <div class="text-sm text-gray-500">متبقي</div>
                                </div>
                            </div>

                            <button class="btn-primary w-full py-2 rounded-full mt-6 font-medium">
                                <i class="fas fa-certificate ml-2"></i> الحصول على الشهادة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.web.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabs = document.querySelectorAll('.tab');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                document.getElementById(this.dataset.tab).classList.add('active');
            }));

            // Video progress tracking
            const video = document.querySelector('video');
            if (video) {
                video.addEventListener('timeupdate', function() {
                    const progress = (video.currentTime / video.duration) * 100;
                    // You can send this progress to the server via AJAX
                });

                video.addEventListener('ended', function() {
                    // Mark video as completed
                    fetch(`/api/videos/{{ $video->id }}/complete`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    });
                });
            }

            // Smooth scroll for lesson items
            document.querySelectorAll('.lesson-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    if (this.href) {
                        e.preventDefault();
                        document.body.classList.add('opacity-0');
                        setTimeout(() => {
                            window.location.href = this.href;
                        }, 300);
                    }
                });
            });
        });
    </script>
</body>

</html>
