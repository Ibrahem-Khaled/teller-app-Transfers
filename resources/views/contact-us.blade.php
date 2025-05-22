<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة تعليمية | اتصل بنا</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
        }

        .contact-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .form-input {
            transition: all 0.3s ease;
            border-bottom: 2px solid #e5e7eb;
        }

        .form-input:focus {
            border-bottom-color: #4a2f85;
        }

        .map-container {
            height: 400px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
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

        .gradient-text {
            background: linear-gradient(90deg, #1E3A8A, #4a2f85);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    @include('components.web.header')

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-900 to-blue-600 py-20 text-white overflow-hidden">
        <div class="absolute top-0 right-0 opacity-20">
            <svg width="518" height="518" viewBox="0 0 518 518" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="259" cy="259" r="259" fill="url(#paint0_linear)" />
                <defs>
                    <linearGradient id="paint0_linear" x1="0" y1="0" x2="518" y2="518"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="#F59E0B" />
                        <stop offset="1" stop-color="#F59E0B" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-right mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">نحن هنا لمساعدتك</h1>
                    <p class="text-xl opacity-90 mb-8">لديك أي استفسار أو اقتراح؟ لا تتردد في التواصل معنا، فريق الدعم
                        جاهز لمساعدتك على مدار الساعة</p>
                    <div class="flex justify-center md:justify-start space-x-reverse space-x-4">
                        <a href="#contact-form"
                            class="bg-white hover:bg-gray-100 text-blue-900 font-bold py-3 px-6 rounded-lg text-lg transition duration-300 shadow-md">
                            أرسل رسالة
                        </a>
                        <a href="#contact-info"
                            class="bg-transparent hover:bg-blue-700 text-white border border-white font-bold py-3 px-6 rounded-lg text-lg transition duration-300">
                            معلومات التواصل
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/128/1256/1256652.png" alt="اتصل بنا"
                        class="floating W-50 max-w-md">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info -->
    <section id="contact-info" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-16 gradient-text">طرق التواصل معنا</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Email Card -->
                <div class="contact-card bg-white p-8 rounded-xl border border-gray-100 text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">البريد الإلكتروني</h3>
                    <p class="text-gray-600 mb-4">أرسل رسالتك وسنرد عليك خلال 24 ساعة</p>
                    <a href="mailto:{{ $website->email }}"
                        class="text-blue-600 hover:text-blue-800 font-medium">{{ $website->email }}</a>
                </div>

                <!-- Phone Card -->
                <div class="contact-card bg-white p-8 rounded-xl border border-gray-100 text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">الاتصال الهاتفي</h3>
                    <p class="text-gray-600 mb-4">من الأحد إلى الخميس من 8 صباحاً إلى 4 مساءً</p>
                    <a href="tel:+{{ $website->phone }}"
                        class="text-blue-600 hover:text-blue-800 font-medium">+{{ $website->phone }}</a>
                </div>

                <!-- Social Card -->
                <div class="contact-card bg-white p-8 rounded-xl border border-gray-100 text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">وسائل التواصل الاجتماعي</h3>
                    <p class="text-gray-600 mb-4">تواصل معنا عبر منصات التواصل الاجتماعي</p>
                    <div class="flex justify-center space-x-reverse space-x-4">
                        <a href="https://www.facebook.com/share/1ELNa6ZnJM/" class="text-blue-400 hover:text-blue-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/financeandbusinessworldbs?igsh=MXBnbHIyc3NueHMwbw==" class="text-red-500 hover:text-red-700">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Map -->
    <section id="contact-form" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Contact Form -->
                <div class="lg:w-1/2">
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <h3 class="text-2xl font-bold text-blue-900 mb-6">أرسل رسالتك</h3>
                        <form>
                            <div class="mb-6">
                                <label for="name" class="block text-gray-700 font-medium mb-2">الاسم
                                    الكامل</label>
                                <input type="text" id="name"
                                    class="form-input w-full p-3 border-0 focus:ring-0 focus:border-blue-600 transition duration-300">
                            </div>
                            <div class="mb-6">
                                <label for="email" class="block text-gray-700 font-medium mb-2">البريد
                                    الإلكتروني</label>
                                <input type="email" id="email"
                                    class="form-input w-full p-3 border-0 focus:ring-0 focus:border-blue-600 transition duration-300">
                            </div>
                            <div class="mb-6">
                                <label for="subject" class="block text-gray-700 font-medium mb-2">الموضوع</label>
                                <input type="text" id="subject"
                                    class="form-input w-full p-3 border-0 focus:ring-0 focus:border-blue-600 transition duration-300">
                            </div>
                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 font-medium mb-2">الرسالة</label>
                                <textarea id="message" rows="5"
                                    class="form-input w-full p-3 border-0 focus:ring-0 focus:border-blue-600 transition duration-300"></textarea>
                            </div>
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                إرسال الرسالة
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Map -->
                <div class="lg:w-1/2">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3621.853781627942!2d46.67554531500066!3d24.81351898408245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2ee3d9a6d5e6b5%3A0x3b1d5e5e5e5e5e5e!2sRiyadh%2C%20Saudi%20Arabia!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus"
                            width="100%" height="100%" style="border:0;" allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>

                    <div class="mt-8 bg-white p-6 rounded-xl shadow-lg">
                        <h4 class="text-xl font-bold text-blue-900 mb-4">معلومات المقر</h4>
                        <div class="flex items-start mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-3 mt-1"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="text-gray-700">الرياض، المملكة العربية السعودية</p>
                        </div>
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-3 mt-1"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-gray-700">الأحد - الخميس: 8 صباحاً - 4 مساءً</p>
                                <p class="text-gray-700">الجمعة - السبت: مغلق</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-16 gradient-text">أسئلة شائعة</h2>

            <div class="max-w-3xl mx-auto space-y-4">
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                        <h3 class="text-lg font-medium text-blue-900">كم تستغرق وقتاً للرد على استفساري؟</h3>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-600 transition-transform duration-300"
                            :class="{ 'transform rotate-180': open }" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6 text-gray-600">
                        <p>نهدف للرد على جميع الاستفسارات خلال 24 ساعة عمل. في حالات الذروة قد يستغرق الرد حتى 48 ساعة
                            عمل.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                        <h3 class="text-lg font-medium text-blue-900">هل لديكم دعم فني على مدار الساعة؟</h3>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-600 transition-transform duration-300"
                            :class="{ 'transform rotate-180': open }" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6 text-gray-600">
                        <p>نعم، لدينا فريق دعم فني يعمل على مدار الساعة طوال أيام الأسبوع للرد على استفساراتكم الفنية
                            العاجلة.</p>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open" class="w-full flex justify-between items-center p-6 text-left">
                        <h3 class="text-lg font-medium text-blue-900">كيف يمكنني متابعة طلب الدعم الفني الخاص بي؟</h3>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-blue-600 transition-transform duration-300"
                            :class="{ 'transform rotate-180': open }" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-6 pb-6 text-gray-600">
                        <p>يمكنك متابعة طلبك من خلال البريد الإلكتروني الذي ستصلك عليه جميع التحديثات، أو من خلال الدخول
                            إلى حسابك في المنصة ومتابعة التذاكر المفتوحة.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.web.footer')
</body>

</html>
