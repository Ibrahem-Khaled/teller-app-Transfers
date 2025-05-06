<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة تعليمية | دوراتنا</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(90deg, #1E3A8A, #4a2f85);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero-pattern {
            background-image: radial-gradient(circle, rgba(59, 130, 246, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .filter-card {
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .filter-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    @include('components.web.header')

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-900 to-blue-600 py-24 text-white overflow-hidden hero-pattern">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-400 opacity-20 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-1/3 h-full bg-indigo-400 opacity-20 rounded-full filter blur-3xl">
            </div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-right mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $category->name }}</h1>
                    <p class="text-xl opacity-90 mb-8">{{ $category->description ?? 'لا يوجد وصف لهذا التصنيف' }}</p>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="{{ asset('storage/' . $category->icon) }}" alt="الدورات التعليمية"
                        class="floating w-64 max-w-md ">
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-blue-900 mb-4 md:mb-0 gradient-text">أحدث الدورات
                    {{ $category->name }}</h2>

                <div class="flex space-x-reverse space-x-4">
                    <div class="filter-card bg-white p-3 rounded-lg shadow-sm">
                        <select class="bg-transparent border-0 text-gray-700 focus:ring-0 focus:border-blue-500">
                            <option>ترتيب حسب</option>
                            <option>الأحدث</option>
                            <option>الأكثر شعبية</option>
                            <option>الأعلى تقييماً</option>
                        </select>
                    </div>

                    <div class="filter-card bg-white p-3 rounded-lg shadow-sm">
                        <select class="bg-transparent border-0 text-gray-700 focus:ring-0 focus:border-blue-500">
                            <option>جميع التصنيفات</option>
                            <option>البرمجة</option>
                            <option>التصميم</option>
                            <option>الأعمال</option>
                            <option>التسويق</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courses as $item)
                    @include('components.web.course-card', ['course' => $item])
                @endforeach
            </div>

            {{-- <div class="mt-12 text-center">
                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300 shadow-lg">
                    عرض المزيد من الدورات
                </button>
            </div> --}}
        </div>
    </section>

    @include('components.web.footer')
</body>

</html>
