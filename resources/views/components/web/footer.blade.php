<footer class="bg-gray-800 text-gray-300 py-12 font-arabic">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">{{ $website->name }}</h4>
                <p class="text-sm">منصة رائدة تقدم دورات عالية الجودة في مختلف المجالات لمساعدتك على تحقيق أهدافك
                    المهنية والشخصية.</p>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">روابط سريعة</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">الرئيسية</a></li>
                    <li><a href="#courses" class="hover:text-white">الدورات</a></li>
                    <li><a href="#" class="hover:text-white">المدونة</a></li>
                    <li><a href="#" class="hover:text-white">سياسة الخصوصية</a></li>
                    <li><a href="#" class="hover:text-white">شروط الاستخدام</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">تواصل معنا</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="mailto:{{ $website->email }}" class="hover:text-white">{{ $website->email }}</a></li>
                    <li><a href="tel:+{{ $website->phone }}" class="hover:text-white"
                            lang="en">{{ $website->phone }}</a></li>
                    <li>{{ $website->address }}</li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-white mb-4">تابعنا على</h4>
                <div class="flex space-x-reverse space-x-4">
                    <a href="https://www.facebook.com/share/1ELNa6ZnJM/" class="text-gray-400 hover:text-white"
                        aria-label="Facebook">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z">
                            </path>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/financeandbusinessworldbs" class="text-gray-400 hover:text-white"
                        aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0C5.82 0 5.556.01 4.697.05 3.838.091 3.23.232 2.708.43c-.522.198-.97.462-1.418.91
             -.448.447-.712.896-.91 1.418-.198.522-.34 1.13-.38 1.989C.01 5.556 0 5.82 0 8c0 2.18.01
             2.444.05 3.303.041.859.182 1.467.38 1.989.198.522.462.97.91 1.418.447.448.896.712
             1.418.91.522.198 1.13.34 1.989.38C5.556 15.99 5.82 16 8 16c2.18 0 2.444-.01
             3.303-.05.859-.041 1.467-.182 1.989-.38.522-.198.97-.462 1.418-.91.448-.447.712-.896
             .91-1.418.198-.522.34-1.13.38-1.989.04-.859.05-1.123.05-3.303 0-2.18-.01-2.444-.05-3.303
             -.041-.859-.182-1.467-.38-1.989-.198-.522-.462-.97-.91-1.418-.447-.448-.896-.712-1.418
             -.91C13.77.232 13.162.091 12.303.05 11.444.01 11.18 0 8 0z" />
                            <path d="M8 3.838a4.162 4.162 0 110 8.324 4.162 4.162 0 010-8.324zM8
             9.838a1.838 1.838 0 100-3.676 1.838 1.838 0 000 3.676z" />
                            <path d="M12.954 3.646a.9.9 0 11-1.8 0 .9.9 0 011.8 0z" />
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/in/financeandbusinessworld-bs-ba1031365?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"
                        class="text-gray-400 hover:text-white" aria-label="LinkedIn">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.594-11.018-3.714v-2.155z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 pt-8 text-center text-sm">
            <p>&copy; <span lang="en">
                    {{ date('Y') }}
                </span> {{ $website->name }} التعليمية. جميع الحقوق محفوظة.</p>
        </div>
    </div>
</footer>
