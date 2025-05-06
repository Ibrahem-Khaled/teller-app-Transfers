@php
    $categories = \App\Models\Category::all();
@endphp

<nav class="bg-white shadow-md sticky top-0 z-50 font-arabic">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center">
        <!-- الشعار -->
        <a href="{{ route('home') }}" class="text-2xl font-bold text-primary-DEFAULT flex items-center">
            {{-- <img src="{{ asset('assets/img/logo-ct.png') }}" alt="شعار المنصة" class="h-10 mr-2"> --}}
            عالم المال والاعمال بي إس
        </a>

        <!-- قائمة الديسكتوب -->
        <div class="hidden md:flex items-center space-x-reverse space-x-5">
            <a href="{{ route('home') }}"
                class="text-gray-700 hover:text-primary-light px-3 py-2 rounded-md text-sm font-medium">
                الرئيسية
            </a>

            <!-- دروبداون الدورات المحسّن -->
            <div class="relative group inline-block text-left">
                <button type="button" tabindex="0"
                    class="inline-flex items-center text-gray-700 hover:text-primary-light px-3 py-2 rounded-md text-sm font-medium focus:outline-none">
                    الدورات
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul tabindex="0"
                    class="absolute right-0 mt-2 w-48 max-h-64 overflow-auto
                 bg-white rounded-md shadow-lg py-1 z-20
                 invisible opacity-0
                 group-hover:visible group-hover:opacity-100
                 group-focus-within:visible group-focus-within:opacity-100
                 transition-opacity duration-200 ease-out">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('courses', $category->id) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <a href="{{ route('about.us') }}"
                class="text-gray-700 hover:text-primary-light px-3 py-2 rounded-md text-sm font-medium">
                من نحن
            </a>
            <a href="{{ route('contact.us') }}"
                class="text-gray-700 hover:text-primary-light px-3 py-2 rounded-md text-sm font-medium">
                اتصل بنا
            </a>
        </div>

        <!-- منطقة المستخدم والإشعارات -->
        <div class="flex items-center space-x-4">
            @guest
                <a href="{{ route('login') }}" style="background-color: rgb(250, 239, 93);"
                    class="bg-secondary hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg text-sm transition duration-300 ease-in-out">
                    تسجيل / دخول
                </a>
            @endguest

            @auth
                <!-- أيقونة الإشعارات -->
                <a href="3" class="relative text-gray-600 hover:text-primary-DEFAULT">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    @if ($unread = 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-1.5">
                            {{ $unread }}
                        </span>
                    @endif
                </a>

                <!-- ملف المستخدم -->
                <div class="relative group inline-block text-left">
                    <button type="button" tabindex="0"
                        class="flex items-center space-x-2 focus:outline-none px-3 py-2 hover:bg-gray-100 rounded-md transition">
                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar"
                            class="w-8 h-8 rounded-full object-cover border-2 border-primary-DEFAULT ml-2">
                        <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <ul tabindex="0"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20
                   invisible opacity-0
                   group-hover:visible group-hover:opacity-100
                   group-focus-within:visible group-focus-within:opacity-100
                   transition-opacity duration-200 ease-out">
                        <li>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                الملف الشخصي
                            </a>
                        </li>
                        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                            <li>
                                <a href="{{ route('home.dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    لوحة التحكم
                                </a>
                            </li>
                        @endif
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    تسجيل خروج
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            <!-- زر قائمة الموبايل -->
            <button class="md:hidden text-gray-600 focus:outline-none" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- قائمة الموبايل -->
    <div id="mobile-menu" class="md:hidden hidden bg-white shadow-inner">
        <div class="px-4 py-3 border-b">
            @auth
                <div class="flex items-center space-x-3">
                    <img src="{{ Auth::user()->avatar_url ?? asset('assets/img/default-avatar.png') }}" alt="Avatar"
                        class="w-10 h-10 rounded-full object-cover border-2 border-primary-DEFAULT">
                    <div>
                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="block w-full text-center bg-secondary hover:bg-yellow-600 text-white font-bold py-2 rounded-lg">
                    تسجيل / دخول
                </a>
            @endauth
        </div>

        <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">الرئيسية</a>

        <!-- دروبداون الدورات في الموبايل -->
        <div class="border-t border-gray-100">
            <button id="mobile-courses-button"
                class="w-full flex justify-between items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none">
                الدورات
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <ul id="mobile-courses-menu" class="hidden bg-white max-h-64 overflow-auto">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('courses', $category->id) }}"
                            class="block px-6 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <a href="{{ route('about.us') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">من نحن</a>
        <a href="{{ route('contact.us') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">اتصل
            بنا</a>

        @auth
            <a href="3" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">الإشعارات</a>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">الملف
                الشخصي</a>
            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'super_admin')
                <a href="{{ route('home.dashboard') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">لوحة التحكم</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full px-4 text-right py-2 text-sm text-red-600 hover:bg-gray-100">
                    تسجيل خروج
                </button>
            </form>
        @endauth
    </div>
</nav>

<script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileCoursesButton = document.getElementById('mobile-courses-button');
    const mobileCoursesMenu = document.getElementById('mobile-courses-menu');

    // تبديل إظهار/إخفاء قائمة الموبايل
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // تبديل دروبداون الدورات في الموبايل
    mobileCoursesButton.addEventListener('click', e => {
        e.stopPropagation();
        mobileCoursesMenu.classList.toggle('hidden');
    });

    // إغلاق القوائم عند النقر خارجها
    document.addEventListener('click', event => {
        if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            mobileCoursesMenu.classList.add('hidden');
        }
    });
</script>
