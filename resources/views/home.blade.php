<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة تعليمية | الرئيسية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#1E3A8A', // أزرق داكن
                            light: '#4a2f85', // أزرق أفتح
                        },
                        secondary: '#F59E0B', // أصفر للمسة مميزة
                        accent: '#10B981', // أخضر للمسة مميزة بديلة
                        lightgray: '#F3F4F6', // رمادي فاتح للخلفيات
                        darkgray: '#4B5563', // رمادي للنصوص
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'], // الخط الأجنبي الافتراضي
                        arabic: ['Tajawal', 'sans-serif'], // الخط العربي
                    },
                }
            }
        }
    </script>
    <style>
        /* تطبيق الخط العربي على النص العربي */
        body {
            font-family: 'Tajawal', sans-serif;
        }

        /* تطبيق الخط الأجنبي على النص الأجنبي (إذا لزم الأمر) */
        [lang="en"] {
            font-family: 'Inter', sans-serif;
        }

        /* تحسينات بسيطة للـ Carousel (بدون JS) */
        .carousel-container {
            scroll-snap-type: x mandatory;
            overflow-x: scroll;
            scroll-behavior: smooth;
            /* يجعل التمرير أكثر سلاسة */
            -webkit-overflow-scrolling: touch;
            /* تمرير سلس على iOS */
        }

        .carousel-item {
            scroll-snap-align: center;
            flex: 0 0 auto;
            /* يمنع العناصر من التقلص أو التمدد */
        }

        .category-chip {
            transition: all 0.3s ease;
        }

        .category-chip:hover {
            transform: scale(1.05);
        }

        /* إخفاء شريط التمرير */
        .carousel-container::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        .carousel-container {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* تأثيرات خاصة لبطاقات المدربين */
        .trainer-card {
            transition: all 0.3s ease;
            perspective: 1000px;
        }

        .trainer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .trainer-social {
            opacity: 0;
            transition: all 0.3s ease;
        }

        .trainer-card:hover .trainer-social {
            opacity: 1;
        }
    </style>
</head>
@php
    // مصفوفة بأسماء الألوان المتوفرة في Tailwind
    $colors = [
        'red',
        'orange',
        'amber',
        'yellow',
        'lime',
        'green',
        'emerald',
        'teal',
        'cyan',
        'sky',
        'blue',
        'indigo',
        'violet',
        'purple',
        'fuchsia',
        'pink',
        'rose',
    ];
    // اختيار اسم لون عشوائي
    $color = $colors[array_rand($colors)];
@endphp

<body class="bg-white text-darkgray">

    @include('components.web.header')

    <header class="bg-lightgray font-arabic">
        <div class="container mx-auto px-6 py-16 md:py-24 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-center md:text-right mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold text-primary-DEFAULT mb-4 leading-tight">
                    تعلم مهارات المستقبل <br class="hidden md:block"> بسهولة عبر الإنترنت
                </h1>
                <p class="text-lg text-darkgray mb-8">
                    دورات تفاعلية مصممة بعناية، يقدمها مدربون محترفون، لتحصل على شهادات معتمدة تعزز مسيرتك المهنية.
                </p>
                <div class="flex justify-center md:justify-start space-x-reverse space-x-4">
                    <a href="#"
                        class="bg-primary-DEFAULT hover:bg-primary-light text-dark font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out shadow-md">
                        ابدأ الآن
                    </a>
                    <a href="#courses"
                        class="bg-white hover:bg-gray-100 text-primary-DEFAULT border border-primary-DEFAULT font-bold py-3 px-6 rounded-lg text-lg transition duration-300 ease-in-out shadow-md">
                        استعرض الدورات
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <img src="{{ asset('assets/img/hero-section-student.png') }}" alt="[صورة تعليم رقمي]"
                    class="rounded-lg shadow-xl w-full max-w-md">
            </div>
        </div>
    </header>


    <!-- Categories Section -->
    <section id="categories" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-16 gradient-text">تصفح حسب التصنيف</h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <!-- Programming -->
                @foreach ($categories as $item)
                    <a href="#"
                        class="category-chip
                    bg-{{ $color }}-200 hover:bg-{{ $color }}-300
                    border border-{{ $color }}-200
                    rounded-xl p-4 text-center
                    transition duration-300 ease-in-out">

                        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                            <img src="{{ asset('storage/' . $item->icon) }}" alt="{{ $item->name }}" class="w-8 h-8">
                        </div>
                        <h3 class="font-bold text-blue-900">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $item->courses->count() }} دورة</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section id="courses" class="py-16 font-arabic">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-primary-DEFAULT mb-10">دوراتنا المميزة</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                @foreach ($courses as $course)
                    @include('components.web.course-card', ['course' => $course])
                @endforeach

            </div>
        </div>
    </section>

    <!-- قسم المدربين المتميزين -->
    <section id="trainers" class="py-16 bg-gradient-to-b from-lightgray to-white font-arabic">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-primary-DEFAULT mb-4">تعرف على مدربينا المتميزين</h2>
                <p class="text-lg text-darkgray max-w-2xl mx-auto">
                    فريق من الخبراء والمتخصصين في مجالاتهم، جاهزون لمساعدتك في رحلة التعلم وتحقيق أهدافك
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($trainers as $trainer)
                    <div class="trainer-card bg-white rounded-xl shadow-md overflow-hidden relative">
                        <div class="relative">
                            <img src="{{ $trainer->avatar ? asset('storage/' . $trainer->avatar) : asset('assets/img/default-trainer.jpg') }}"
                                alt="{{ $trainer->name }}" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                            <div class="absolute bottom-4 right-4">
                                <h3 class="text-xl font-bold text-white">{{ $trainer->name }}</h3>
                                <p class="text-primary-light">{{ $trainer->specialization }}</p>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                @for ($i = 0; $i < round($trainer->avg_rating); $i++)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                                <span class="text-sm text-gray-500 mr-1">({{ $trainer->courses_count }} دورات)</span>
                            </div>

                            <p class="text-darkgray text-sm mb-4 line-clamp-3">{{ $trainer->bio }}</p>

                            <div class="flex justify-between items-center">
                                <a href="3"
                                    class="text-primary-light hover:text-primary-DEFAULT font-medium text-sm">
                                    عرض الملف الشخصي
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="3"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-light hover:bg-primary-DEFAULT transition duration-300">
                    تصفح جميع المدربين
                    <svg class="mr-2 -ml-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-lightgray py-16 font-arabic">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-primary-DEFAULT mb-10">لماذا تختار منصتنا؟</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-primary-DEFAULT">شهادات معتمدة</h3>
                    <p class="text-darkgray">احصل على شهادات معترف بها بعد إتمامك للدورات بنجاح.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12 text-secondary" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-primary-DEFAULT">تعلم بالوتيرة التي تناسبك</h3>
                    <p class="text-darkgray">وصول غير محدود لمحتوى الدورات لتتعلم في أي وقت ومن أي مكان.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12 text-secondary" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-primary-DEFAULT">دعم فني ومجتمع تفاعلي</h3>
                    <p class="text-darkgray">فريق دعم جاهز للمساعدة ومنتديات للتواصل مع المدربين والطلاب.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 font-arabic">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-primary-DEFAULT mb-10">ماذا يقول طلابنا؟</h2>
            <div class="flex overflow-x-auto space-x-reverse space-x-8 pb-4 carousel-container">

                @foreach ($reviews as $review)
                    <div
                        class="carousel-item flex-shrink-0 w-full sm:w-1/2 lg:w-1/3 bg-white p-8 rounded-lg shadow-lg text-center">
                        <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('assets/img/logo-ct-bg.png') }}"
                            alt="{{ $review->user->name }}" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                        <p class="text-darkgray mb-4 italic">"{{ $review->content }}"</p>
                        <h4 class="font-semibold text-primary-DEFAULT">{{ $review->user->name }}</h4>
                        <p class="text-sm text-gray-500 mb-2">دورة {{ $review->course->name }}</p>
                        <div class="flex justify-center text-yellow-400">

                            @for ($i = 0; $i < $review->avg('rating'); $i++)
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="bg-primary-DEFAULT py-16 font-arabic">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-dark">هل أنت جاهز للانطلاقة نحو مستقبل أفضل؟</h2>
            <p class="text-lg mb-8 text-blue-900">انضم إلى آلاف الطلاب الذين يطورون مهاراتهم معنا يومياً.</p>

            @if (!Auth::check())
                <a href="#"
                    class="bg-secondary hover:bg-yellow-600 text-primary-DEFAULT font-bold py-3 px-8 rounded-lg text-lg transition duration-300 ease-in-out shadow-lg transform hover:scale-105">
                    انضم الآن مجاناً
                </a>
            @endif
        </div>
    </section>

    @include('components/web/footer')
</body>

</html>
