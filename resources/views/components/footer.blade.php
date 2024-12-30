<footer class="bg-dark text-white pt-5 pb-4" style="direction: rtl; text-align: right">
    <div class="container text-center text-md-end">
        <div class="row">
            <!-- القسم الأول: معلومات عن الموقع -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">{{ config('app.name') }}</h5>
                <p class="text-white" style="line-height: 2">
                    منصة شاملة لتعلم المهارات الحديثة والتطور المهني. نهدف إلى تمكين الأفراد من تحقيق أهدافهم
                    التعليمية بسهولة واحترافية.
                </p>
            </div>

            <!-- القسم الثاني: الروابط السريعة -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">روابط سريعة</h5>
                <p>
                    <a href="{{ route('home') }}" class="text-white text-decoration-none">الرئيسية</a>
                </p>
                <p>
                    <a href="" class="text-white text-decoration-none">الدورات</a>
                </p>
                <p>
                    <a href="{{ route('certificate') }}" class="text-white text-decoration-none">الشهادات</a>
                </p>
                <p>
                    <a href="" class="text-white text-decoration-none">سياسة الخصوصية</a>
                </p>
            </div>

            <!-- القسم الثالث: التواصل -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">تواصل معنا</h5>
                <p><i class="fas fa-map-marker-alt me-2"></i>123 شارع التقنية، المدينة</p>
                <p><i class="fas fa-envelope me-2"></i>belal2016.abdallah@gmail.com</p>
                <p><i class="fas fa-phone me-2"></i>+962 7 8041 1276</p>
                <p><i class="fas fa-print me-2"></i>+962 7 8041 1276</p>
            </div>

            <!-- القسم الرابع: تابعنا -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-center text-md-start">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">تابعنا</h5>
                <a href="#" class="text-white me-4"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white me-4"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-4"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white me-4"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>

        <hr class="my-3 text-white" />

        <!-- الحقوق -->
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="mb-0">&copy; {{ date('Y') }} جميع الحقوق محفوظة | <a href="#"
                        class="text-warning text-decoration-none">{{ config('app.name') }}</a></p>
            </div>
        </div>
    </div>
</footer>
