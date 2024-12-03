<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الملف الشخصي للمحامي</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f5f5f5;
        }

        .profile-header {
            background-color: #8B4513;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .profile-header img {
            border-radius: 50%;
            border: 5px solid #fff;
            width: 150px;
            height: 150px;
        }

        .profile-header h2 {
            margin-top: 15px;
        }

        .profile-header p {
            margin: 0;
        }

        .info-section {
            margin: 20px 0;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .info-section .info-item {
            margin-bottom: 15px;
        }

        .info-section .info-item i {
            color: #8B4513;
            margin-right: 10px;
        }

        .posts-section {
            margin-top: 20px;
        }

        .posts-section .post-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .posts-section .post-card:hover {
            transform: scale(1.05);
        }

        .post-card h5 {
            color: #8B4513;
            margin-bottom: 10px;
        }

        .post-card p {
            margin-bottom: 10px;
            color: #333;
        }

        .post-card img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .post-card a {
            text-decoration: none;
            color: #8B4513;
            font-weight: bold;
        }

        .post-card a:hover {
            text-decoration: underline;
        }

        .edit-profile-btn {
            background-color: #8B4513;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
            display: block;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            text-decoration: none;
        }

        .edit-profile-btn:hover {
            background-color: #6c3413;
            color: #fff;
        }
    </style>
</head>

<body>
    @include('homeLayouts.nav-bar')
    <div class="profile-header">
        <img src="{{ $user->avatar ? asset( $user->avatar) : asset('assets/img/logo-ct.png') }}"
            alt="محامي">
        <h2>{{ $user->name }}</h2>
        <p>{{ $user->role === 'lawyer' ? 'محامي متخصص في القانون الجنائي' : 'مستخدم عادي' }}</p>
    </div>

    <div class="container" style="flex-direction: column;">
        <div class="info-section">
            <div class="row">
                <div class="col-md-6 info-item">
                    <i class="fas fa-user"></i> اسم المستخدم: {{ $user->username ?? 'غير متوفر' }}
                </div>
                <div class="col-md-6 info-item">
                    <i class="fas fa-envelope"></i> البريد الإلكتروني: {{ $user->email }}
                </div>
                <div class="col-md-6 info-item">
                    <i class="fas fa-phone"></i> رقم الهاتف: {{ $user->phone ?? 'غير متوفر' }}
                </div>
                <div class="col-md-6 info-item">
                    <i class="fas fa-map-marker-alt"></i> العنوان: {{ $user->address ?? 'غير متوفر' }},
                    {{ $user->city ?? 'غير متوفر' }} ،{{ $user->country ?? 'غير متوفر' }}
                </div>
                <div class="col-md-6 info-item">
                    <i class="fas fa-flag"></i> الدولة: {{ $user->country ?? 'غير متوفر' }}
                </div>
                <div class="col-md-6 info-item">
                    <i class="fas fa-calendar"></i> تاريخ الميلاد: {{ $user->birth_date ?? 'غير متوفر' }}
                </div>
                <div class="col-md-6 info-item">
                    <i class="fas fa-venus-mars"></i> الجنس: {{ $user->gender ?? 'غير متوفر' }}
                </div>
                <div class="col-md-6 info-item">
                    <i class="fas fa-globe"></i> خط العرض: {{ $user->lat ?? 'غير متوفر' }}, خط الطول:
                    {{ $user->lng ?? 'غير متوفر' }}
                </div>
                <div class="col-md-6 info-item">
                    <i class="fas fa-user-tag"></i> الدور: {{ $user->role }}
                </div>
                <div class="col-md-6 info-item">
                    <i class="fas fa-info-circle"></i> الحالة: {{ $user->status === 'active' ? 'نشط' : 'غير نشط' }}
                </div>
            </div>
        </div>

        <!-- زر لتعديل الملف الشخصي -->
        @if (Auth::user()->id === $user->id)
            <button type="button" class="edit-profile-btn" data-bs-toggle="modal"
                data-bs-target="#editProfileModal">تعديل
                الملف الشخصي</button>
        @endif

        @if ($user->posts->count() === 0)
            <div class="posts-section">
                <h3 class="text-center mb-4">لا يوجد مشاركات لهذا المستخدم</h3>
            </div>
        @else
            <div class="posts-section">
                <h3 class="text-center mb-4">أحدث المنشورات</h3>
                <div class="row">
                    @foreach ($user->posts as $post)
                        <div class="col-md-4">
                            <div class="post-card">
                                <h5>{{ $post->title }}</h5>
                                <p>{{ Str::limit($post->body, 100) }}</p>
                                <img src="{{ asset( $post->image) }}" alt="Post Image">
                                <a href="#">اقرأ المزيد</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- مودال تعديل الملف الشخصي -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">تعديل الملف الشخصي</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">الاسم الكامل</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">رقم الهاتف</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="country">الدولة</label>
                            <input type="text" name="country" class="form-control" value="{{ $user->country }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="city">المدينة</label>
                            <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="birth_date">تاريخ الميلاد</label>
                            <input type="text" name="birth_date" class="form-control"
                                value="{{ $user->birth_date }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">العنوان</label>
                            <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="avatar">تغيير الصورة الشخصية</label>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('homeLayouts.contact-us')
    @include('homeLayouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
