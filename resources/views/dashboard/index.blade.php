@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">لوحة التحكم</h1>
        </div>

        @include('components.alerts')

        {{-- صف الإحصائيات الرئيسية --}}
        <div class="row">
            {{-- إجمالي المستخدمين --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-users" title="إجمالي المستخدمين" :value="$usersCount" color="primary"
                    link="users.index" />
            </div>

            {{-- إجمالي الدورات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-book" title="إجمالي الدورات" :value="$coursesCount" color="success"
                    link="courses.index" />
            </div>

            {{-- إجمالي الفيديوهات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-video" title="إجمالي الفيديوهات" :value="$videosCount" color="info"
                    link="videos.index" />
            </div>

            {{-- إجمالي التقييمات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-star" title="إجمالي التقييمات" :value="$reviewsCount" color="warning"
                    link="reviews.index" />
            </div>
        </div>

        {{-- صف الإحصائيات الثانوية --}}
        <div class="row">
            {{-- المستخدمون النشطون --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-user-check" title="المستخدمون النشطون" :value="$activeUsersCount" color="success"
                    subIcon="fas fa-percentage" :subValue="round(($activeUsersCount / $usersCount) * 100) . '%'" />
            </div>

            {{-- الدورات المجانية --}}
            <x-stats-card icon="fas fa-gift" title="الدورات المجانية" :value="$freeCoursesCount" color="info"
                subIcon="fas fa-percentage" :subValue="$percentageFreeCourses" />

            {{-- الفيديوهات المجانية --}}
            <x-stats-card icon="fas fa-video" title="الفيديوهات المجانية" :value="$freeVideosCount" color="success"
                subIcon="fas fa-percentage" :subValue="$percentageFreeVideos" />

            {{-- التقييمات المعتمدة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-check-circle" title="التقييمات المعتمدة" :value="$approvedReviewsCount" color="primary"
                    subIcon="fas fa-percentage" :numerator="$approvedReviewsCount" :denominator="$reviewsCount" />
            </div>
        </div>

        {{-- صف الرسوم البيانية والجداول --}}
        <div class="row">
            {{-- رسم بياني للمستخدمين حسب النوع --}}
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">توزيع المستخدمين حسب النوع</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="userTypeChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> طلاب
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> معلمون
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> مدراء
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- رسم بياني للدورات حسب المستوى --}}
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">توزيع الدورات حسب المستوى</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar pt-4 pb-2">
                            <canvas id="courseLevelChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- صف الجداول الأخيرة --}}
        <div class="row">
            {{-- آخر المستخدمين المسجلين --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">آخر المستخدمين المسجلين</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>الدور</th>
                                        <th>الحالة</th>
                                        <th>التاريخ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latestUsers as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}"
                                                        alt="{{ $user->name }}" class="rounded-circle mr-2" width="30"
                                                        height="30">
                                                    {{ $user->name }}
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $roleNames = [
                                                        'admin' => 'مدير',
                                                        'teacher' => 'معلم',
                                                        'student' => 'طالب',
                                                        'super_admin' => 'مدير عام',
                                                    ];
                                                @endphp
                                                {{ $roleNames[$user->role] ?? $user->role }}
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $user->status ? 'success' : 'danger' }}">
                                                    {{ $user->status ? 'نشط' : 'غير نشط' }}
                                                </span>
                                            </td>
                                            <td>{{ $user?->created_at?->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- آخر الدورات المضافة --}}
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">آخر الدورات المضافة</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>اسم الدورة</th>
                                        <th>المستوى</th>
                                        <th>السعر</th>
                                        <th>التقييم</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latestCourses as $course)
                                        <tr>
                                            <td>{{ Str::limit($course->name, 20) }}</td>
                                            <td>
                                                @php
                                                    $levelNames = [
                                                        'beginner' => 'مبتدئ',
                                                        'intermediate' => 'متوسط',
                                                        'advanced' => 'متقدم',
                                                    ];
                                                @endphp
                                                {{ $levelNames[$course->level] ?? $course->level }}
                                            </td>
                                            <td>
                                                @if ($course->price == '0.00')
                                                    <span class="badge badge-success">مجاني</span>
                                                @else
                                                    {{ $course->price }} ر.س
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $avgRating = $course->reviews()->avg('rating') ?? 0;
                                                @endphp
                                                <div class="rating-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fas fa-star {{ $i <= $avgRating ? 'text-warning' : 'text-secondary' }}"></i>
                                                    @endfor
                                                    <small
                                                        class="text-muted ml-1">({{ number_format($avgRating, 1) }})</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- صف الدورات الأكثر شعبية --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">الدورات الأكثر شعبية</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الدورة</th>
                                        <th>عدد التقييمات</th>
                                        <th>متوسط التقييم</th>
                                        <th>السعر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($popularCourses as $index => $course)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $course->name }}</td>
                                            <td>{{ $course->reviews_count }}</td>
                                            <td>
                                                @php
                                                    $avgRating = $course->reviews()->avg('rating') ?? 0;
                                                @endphp
                                                <div class="rating-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fas fa-star {{ $i <= $avgRating ? 'text-warning' : 'text-secondary' }}"></i>
                                                    @endfor
                                                    <small
                                                        class="text-muted ml-1">({{ number_format($avgRating, 1) }})</small>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($course->price == '0.00')
                                                    <span class="badge badge-success">مجاني</span>
                                                @else
                                                    {{ $course->price }} ر.س
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .rating-stars {
            display: inline-flex;
            align-items: center;
        }

        .rating-stars .fa-star {
            font-size: 0.9rem;
            margin-right: 1px;
        }

        .rating-stars .fa-star.text-warning {
            color: #ffc107 !important;
        }
    </style>
@endpush

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <script>
        // رسم بياني دائري لأنواع المستخدمين
        var ctx = document.getElementById("userTypeChart");
        var userTypeChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["طلاب", "معلمون", "مدراء"],
                datasets: [{
                    data: [{{ $studentsCount }}, {{ $teachersCount }},
                        {{ $adminsCount }}
                    ],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });

        // رسم بياني أعمدة لمستويات الدورات
        var ctx2 = document.getElementById("courseLevelChart");
        var courseLevelChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ["مبتدئ", "متوسط", "متقدم"],
                datasets: [{
                    label: "عدد الدورات",
                    backgroundColor: '#4e73df',
                    hoverBackgroundColor: '#2e59d9',
                    borderColor: '#4e73df',
                    data: [
                        {{ $courses->where('level', 'beginner')->count() }},
                        {{ $courses->where('level', 'intermediate')->count() }},
                        {{ $courses->where('level', 'advanced')->count() }},
                    ],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            maxTicksLimit: 5,
                            padding: 10,
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
            }
        });
    </script>
@endpush
