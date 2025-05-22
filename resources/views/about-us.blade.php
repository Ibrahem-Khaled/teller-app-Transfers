<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة تعليمية | من نحن</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Tajawal:wght@400;500;700&display=swap"
        rel="stylesheet">
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
        body {
            font-family: 'Tajawal', sans-serif;
        }

        [lang="en"] {
            font-family: 'Inter', sans-serif;
        }

        /* تأثيرات للصور */
        .about-img {
            transition: transform 0.3s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .about-img:hover {
            transform: scale(1.02);
        }

        /* خطوط مميزة للعناوين */
        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
            color: #000;
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            background: linear-gradient(to right, #F59E0B, #1E3A8A);
            bottom: 0;
            right: 0;
            border-radius: 2px;
        }

        /* تأثيرات للبطاقات */
        .feature-card {
            transition: all 0.3s ease;
            border-top: 3px solid transparent;
            border-radius: 12px;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-top-color: #F59E0B;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* تأثيرات الأزرار */
        .btn-primary {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="bg-white text-darkgray">
    @include('components.web.header')

    <!-- قسم البطل -->
    <section class="relative bg-gradient-to-r from-primary-DEFAULT to-primary-light py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-dark">من نحن</h1>
            <p class="text-xl text-dark max-w-3xl mx-auto">منصة تعليمية رائدة تهدف إلى تمكين الأفراد عبر تقديم تعليم
                عالي الجودة يواكب متطلبات العصر</p>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-white transform skew-y-1 -mb-8"></div>
        </div>
    </section>

    <!-- قسم القيم الأساسية -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-primary-DEFAULT mb-16 section-title">قيمنا الأساسية</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-lightgray p-8 rounded-lg feature-card text-center">
                    <div class="bg-primary-DEFAULT p-3 rounded-full inline-flex mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-DEFAULT mb-3">الجودة</h3>
                    <p class="text-darkgray">نلتزم بأعلى معايير الجودة في تقديم المحتوى التعليمي وخدمات الدعم للمتعلمين.
                    </p>
                </div>

                <div class="bg-lightgray p-8 rounded-lg feature-card text-center">
                    <div class="bg-secondary p-3 rounded-full inline-flex mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-DEFAULT mb-3">الشفافية</h3>
                    <p class="text-darkgray">نؤمن بالشفافية الكاملة في كل ما نقدمه من معلومات وخدمات.</p>
                </div>

                <div class="bg-lightgray p-8 rounded-lg feature-card text-center">
                    <div class="bg-accent p-3 rounded-full inline-flex mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-primary-DEFAULT mb-3">التميز</h3>
                    <p class="text-darkgray">نسعى دائماً للتميز والإبداع في تقديم الحلول التعليمية.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم الرؤية والرسالة -->
    <section class="py-20 bg-lightgray">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <img src="{{ asset('assets/img/about-us.jpg') }}" alt="فريق العمل"
                        class="rounded-lg about-img w-full">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-3xl font-bold text-primary-DEFAULT mb-8 section-title">من نكون</h2>
                    <p class="text-lg mb-6">
                        نحن فريق من الخبراء والمتخصصين في مجال التعليم الإلكتروني، نعمل معاً لبناء مستقبل أفضل للتعليم
                        في العالم العربي.
                    </p>
                    <p class="text-lg mb-6">
                        نقدم تجربة تعليمية فريدة تجمع بين الجودة العالية والمرونة الكاملة، لتلبي احتياجات جميع المتعلمين
                        في مختلف المراحل.
                    </p>

                    <div class="mt-8">
                        <a href="{{ route('courses.index') }}"
                            class="btn-primary bg-secondary text-primary-DEFAULT font-bold py-3 px-8 rounded-lg inline-block">
                            تصفح دوراتنا
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم فريق العمل -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-primary-DEFAULT mb-16 section-title">فريق العمل</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($worker_team as $item)
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-lg text-center transition transform hover:-translate-y-2">
                        <img src="{{ asset('storage/' . $item->avatar) }}" alt="{{ $item->name }}"
                            class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl text-primary-DEFAULT mb-1">{{ $item->name }}</h3>
                            <p class="text-secondary mb-3">{{ $item->job_title }}</p>
                            <div class="flex justify-center space-x-4">
                                <a href="#" class="text-primary-light hover:text-primary-DEFAULT">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                                    </svg>
                                </a>
                                <a href="#" class="text-primary-light hover:text-primary-DEFAULT">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                    </svg>
                                </a>
                                <a href="#" class="text-primary-light hover:text-primary-DEFAULT">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.167 6.839 9.49.5.09.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.202 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.578.688.48C19.138 20.163 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- قسم الشهادات -->
    {{-- <section class="py-16 bg-primary-DEFAULT text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-16 section-title">ماذا يقولون عنا</h2>

            <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div class="bg-white bg-opacity-10 p-8 rounded-lg backdrop-filter backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('assets/img/avatar-male.jpeg') }}" alt="محمد أحمد"
                            class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">محمد أحمد</h4>
                            <p class="text-sm opacity-80">طالب</p>
                        </div>
                    </div>
                    <p class="text-left">"لقد غيرت هذه المنصة طريقة تعلمي تماماً، المحتوى مميز والشرح واضح جداً."</p>
                </div>

                <div class="bg-white bg-opacity-10 p-8 rounded-lg backdrop-filter backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('assets/img/avatar-female.jpeg') }}" alt="سارة محمد"
                            class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">سارة محمد</h4>
                            <p class="text-sm opacity-80">مهندسة برمجيات</p>
                        </div>
                    </div>
                    <p class="text-left">"ساعدتني الدورات على تطوير مهاراتي والحصول على ترقية في عملي."</p>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- دعوة للعمل -->
    <section class="py-16 bg-gradient-to-r from-secondary to-accent">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">ابدأ رحلتك التعليمية اليوم</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">انضم إلى آلاف المتعلمين الذين طوروا مهاراتهم معنا</p>
            @if (!Auth::check())
                <a href="{{ route('register') }}"
                    class="inline-block bg-white hover:bg-gray-100 text-primary-DEFAULT font-bold py-3 px-8 rounded-lg text-lg transition duration-300 shadow-lg transform hover:scale-105">
                    سجل الآن مجاناً
                </a>
            @else
                <a href="{{ route('courses.index') }}"
                    class="inline-block bg-white hover:bg-gray-100 text-primary-DEFAULT font-bold py-3 px-8 rounded-lg text-lg transition duration-300 shadow-lg transform hover:scale-105">
                    تصفح الدورات
                </a>
            @endif
        </div>
    </section>

    @include('components.web.footer')
</body>

</html>
