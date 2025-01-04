<style>
    /* الهيدر */
    header {
        position: sticky;
        top: 0;
        z-index: 1030;
        background-color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand span {
        font-weight: bold;
        font-size: 18px;
        color: #4a2f85;
        transition: color 0.3s;
    }

    .navbar-brand span:hover {
        color: #d9534f;
    }

    /* الروابط */
    .nav-link {
        color: #333;
        font-weight: 500;
        transition: all 0.3s ease-in-out;
        position: relative;
    }

    .nav-link:hover {
        color: #4a2f85;
        text-decoration: underline;
    }

    .nav-link::after {
        content: "";
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #4a2f85;
        transition: width 0.3s ease-in-out;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    /* قائمة الدروب منيو */
    .dropdown-menu a {
        display: flex;
        align-items: center;
        transition: all 0.3s ease-in-out;
        justify-content: space-between;
    }

    .dropdown-menu a i {
        color: #4a2f85;
        font-size: 18px;
        transition: color 0.3s;
    }

    .dropdown-menu a:hover {
        background-color: #f8f9fa;
        color: #4a2f85;
    }

    .dropdown-menu a:hover i {
        color: #d9534f;
    }

    /* الصورة */
    .dropdown img {
        border: 2px solid #4a2f85;
        transition: border 0.3s, transform 0.3s ease-in-out;
    }

    .dropdown img:hover {
        border: 2px solid #d9534f;
        transform: scale(1.1);
    }
</style>

<header class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- الشعار -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo-ct.png') }}" alt="Logo" style="width: 40px; height: 40px;">
            <span class="ms-2">تيللير</span>
        </a>

        <!-- زر القائمة في الشاشات الصغيرة -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- قائمة الروابط -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">التواصل مع الدعم</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">سياسة الخصوصية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('certificate') }}">الشهادات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">الدورات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">الرئيسية</a>
                </li>
            </ul>

            <!-- الصورة الافتراضية والدروب منيو -->
            <div class="dropdown ms-3">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/img/theme/tim.png') }}"
                        alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px;">
                    <h6 class="mb-0 me-2 text-sm ms-2">{{ auth()->user()->name }}</h6>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            تعديل البيانات<i class="fas fa-user-edit me-2"></i>
                        </a>
                    </li>
                    <li>
                        <form id="deleteAccountForm" method="POST" action="{{ route('deleteAccount') }}">
                            @csrf
                            <button type="button" class="dropdown-item text-danger" onclick="confirmDelete()">
                                حذف الحساب<i class="fas fa-trash me-2"></i>
                            </button>
                        </form>
                    </li>

                    <script>
                        function confirmDelete() {
                            // عرض نافذة تأكيد
                            if (confirm('هل أنت متأكد أنك تريد حذف حسابك؟ هذه العملية لا يمكن التراجع عنها.')) {
                                // إذا وافق المستخدم، يتم إرسال الفورم
                                document.getElementById('deleteAccountForm').submit();
                            }
                        }
                    </script>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-primary" href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
