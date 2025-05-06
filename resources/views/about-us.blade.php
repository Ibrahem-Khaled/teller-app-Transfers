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
        }

        .about-img:hover {
            transform: scale(1.02);
        }

        /* خطوط مميزة للعناوين */
        .section-title {
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            background: linear-gradient(to right, #F59E0B, #1E3A8A);
            bottom: -10px;
            right: 0;
            border-radius: 2px;
        }

        /* تأثيرات للبطاقات */
        .feature-card {
            transition: all 0.3s ease;
            border-top: 3px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-top-color: #F59E0B;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* خط زمني */
        .timeline-item {
            position: relative;
            padding-right: 30px;
        }

        .timeline-item:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #4a2f85;
            border: 3px solid #1E3A8A;
        }

        .timeline-item:after {
            content: '';
            position: absolute;
            top: 15px;
            right: 7px;
            width: 2px;
            height: calc(100% - 15px);
            background: #4a2f85;
        }

        .timeline-item:last-child:after {
            display: none;
        }
    </style>
</head>

<body class="bg-white text-darkgray">
    @include('components.web.header')

    <!-- قسم البطل -->
    <section class="relative bg-gradient-to-r from-primary-DEFAULT to-primary-light py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6">من نحن</h1>
            <p class="text-xl max-w-3xl mx-auto">نحن منصة تعليمية رائدة نهدف إلى تمكين الأفراد عبر تقديم تعليم عالي
                الجودة يواكب متطلبات سوق العمل</p>
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-white transform skew-y-1 -mb-8"></div>
        </div>
    </section>

    <!-- قسم الرؤية والرسالة -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <img src="{{ asset('assets/img/about-us.jpg') }}" alt="فريق العمل"
                        class="rounded-lg about-img w-full">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-3xl font-bold text-primary-DEFAULT mb-8 section-title">قصتنا</h2>
                    <p class="text-lg mb-6">
                        تأسست منصتنا عام 2018 بمبادرة من مجموعة من الخبراء في مجال التعليم الإلكتروني والتقنية، بهدف سد
                        الفجوة بين مخرجات التعليم واحتياجات سوق العمل في العالم العربي.
                    </p>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-lightgray p-6 rounded-lg feature-card">
                            <div class="flex items-center mb-3">
                                <div class="bg-primary-DEFAULT p-2 rounded-full mr-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="font-bold text-lg">رؤيتنا</h3>
                            </div>
                            <p class="text-darkgray">أن نكون المنصة الرائدة في التعليم الإلكتروني بالعالم العربي، ونصل
                                بمليون متعلم إلى أهدافهم المهنية.</p>
                        </div>

                        <div class="bg-lightgray p-6 rounded-lg feature-card">
                            <div class="flex items-center mb-3">
                                <div class="bg-secondary p-2 rounded-full mr-3">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="font-bold text-lg">رسالتنا</h3>
                            </div>
                            <p class="text-darkgray">تمكين الأفراد عبر تقديم تعليم عالي الجودة، مرن، ومتوافق مع احتياجات
                                سوق العمل بأسعار في متناول الجميع.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم الأرقام -->
    <section class="py-16 bg-primary-DEFAULT">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-16 section-title">إنجازاتنا بالأرقام</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <div class="text-4xl font-bold mb-2 text-secondary">+50</div>
                    <div class="text-lg text-darkgray">مدرب محترف</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold mb-2 text-secondary">+500</div>
                    <div class="text-lg text-darkgray">دورة تدريبية</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold mb-2 text-secondary">+100K</div>
                    <div class="text-lg text-darkgray">متدرب مسجل</div>
                </div>
                <div class="p-6">
                    <div class="text-4xl font-bold mb-2 text-secondary">+95%</div>
                    <div class="text-lg text-darkgray">رضا العملاء</div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم الخط الزمني -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-primary-DEFAULT mb-16 section-title">رحلة التطور</h2>

            <div class="max-w-3xl mx-auto">
                <div class="timeline-item mb-12">
                    <div class="bg-lightgray p-6 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-bold text-xl text-primary-DEFAULT">التأسيس</h3>
                            <span class="bg-primary-light text-white px-3 py-1 rounded-full text-sm">2018</span>
                        </div>
                        <p class="text-darkgray">انطلاق المنصة بأول 10 دورات في مجالات البرمجة والتصميم، وتخرج الدفعة
                            الأولى من المتدربين.</p>
                    </div>
                </div>

                <div class="timeline-item mb-12">
                    <div class="bg-lightgray p-6 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-bold text-xl text-primary-DEFAULT">التوسع</h3>
                            <span class="bg-primary-light text-white px-3 py-1 rounded-full text-sm">2020</span>
                        </div>
                        <p class="text-darkgray">إضافة تخصصات جديدة في التسويق الرقمي وإدارة الأعمال، ووصول عدد
                            المتدربين إلى 10,000 متدرب.</p>
                    </div>
                </div>

                <div class="timeline-item mb-12">
                    <div class="bg-lightgray p-6 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-bold text-xl text-primary-DEFAULT">الشراكات</h3>
                            <span class="bg-primary-light text-white px-3 py-1 rounded-full text-sm">2022</span>
                        </div>
                        <p class="text-darkgray">تعاون مع جامعات وشركات رائدة لتقديم شهادات معتمدة وفرص توظيف للمتميزين.
                        </p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="bg-lightgray p-6 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-bold text-xl text-primary-DEFAULT">التميز</h3>
                            <span class="bg-primary-light text-white px-3 py-1 rounded-full text-sm">2024</span>
                        </div>
                        <p class="text-darkgray">فوز المنصة بجائزة أفضل منصة تعليم إلكتروني عربي، ووصول عدد المستفيدين
                            إلى 100,000 متدرب.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- قسم فريق العمل -->
    <section class="py-16 bg-lightgray">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-primary-DEFAULT mb-16 section-title">فريق العمل</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach ($worker_team as $item)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md text-center">
                        <img src="{{ asset('storage/' . $item->avatar) }}" alt="{{ $item->name }}"
                            class="w-full h-64 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl text-primary-DEFAULT mb-1">{{ $item->name }}</h3>
                            <p class="text-secondary mb-3">المؤسس والرئيس التنفيذي</p>
                            <p class="text-sm text-darkgray">خبرة 15 عاماً في مجال التعليم الإلكتروني وتطوير الأعمال.
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- قسم الشهادات والاعتمادات -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-primary-DEFAULT mb-16 section-title">شركاؤنا</h2>

            <div class="flex flex-wrap justify-center items-center gap-12">
                <img src="{{ asset('assets/img/avatar-male.jpeg') }}" alt="شريك 1"
                    class="h-16 opacity-70 hover:opacity-100 transition">
                <img src="{{ asset('assets/img/avatar-female.jpeg') }}" alt="شريك 2"
                    class="h-16 opacity-70 hover:opacity-100 transition">
            </div>
        </div>
    </section>

    <!-- دعوة للعمل -->
    <section class="py-16 bg-gradient-to-r from-primary-DEFAULT to-primary-light">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">انضم إلى رحلتنا التعليمية</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">سجل في منصتنا اليوم وابدأ رحلة التعلم التي ستغير مسارك المهني</p>
            @if (!Auth::check())
                <a href="{{ route('register') }}"
                    class="inline-block bg-secondary hover:bg-yellow-600 text-primary-DEFAULT font-bold py-3 px-8 rounded-lg text-lg transition duration-300 ease-in-out shadow-lg transform hover:scale-105">
                    سجل الآن
                </a>
            @endif
        </div>
    </section>

    @include('components.web.footer')
</body>

</html>
