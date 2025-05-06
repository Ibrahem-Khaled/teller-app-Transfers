@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة ومسار التنقل --}}
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة التقييمات</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">التقييمات</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        {{-- إحصائيات التقييمات --}}
        <div class="row mb-4">
            {{-- إجمالي التقييمات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-star" title="إجمالي التقييمات" :value="$totalReviews" color="primary" />
            </div>
            {{-- التقييمات المعتمدة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-check-circle" title="التقييمات المعتمدة" :value="$approvedReviews" color="success" />
            </div>
            {{-- التقييمات المعلقة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-clock" title="التقييمات المعلقة" :value="$pendingReviews" color="warning" />
            </div>
            {{-- متوسط التقييم --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-chart-line" title="متوسط التقييم" :value="number_format($averageRating, 1) . '/5'" color="info" />
            </div>
        </div>

        {{-- بطاقة قائمة التقييمات --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">قائمة التقييمات</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createReviewModal">
                    <i class="fas fa-plus"></i> إضافة تقييم
                </button>
            </div>
            <div class="card-body">
                {{-- تبويب الدورات --}}
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedCourse === 'all' ? 'active' : '' }}"
                            href="{{ route('reviews.index') }}">الكل</a>
                    </li>
                    @foreach ($courses as $id => $title)
                        <li class="nav-item">
                            <a class="nav-link {{ $selectedCourse == $id ? 'active' : '' }}"
                                href="{{ route('reviews.index', ['course' => $id]) }}">
                                {{ Str::limit($title, 20) }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- نموذج البحث --}}
                <form action="{{ route('reviews.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="ابحث في محتوى التقييمات..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> بحث
                            </button>
                        </div>
                    </div>
                </form>

                {{-- جدول التقييمات --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>المستخدم</th>
                                <th>الدورة</th>
                                <th>المحتوى</th>
                                <th>التقييم</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('img/default-avatar.png') }}"
                                                alt="{{ $review->user->name }}" class="rounded-circle mr-2" width="40"
                                                height="40">
                                            {{ $review->user->name }}
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($review->course->title, 20) }}</td>
                                    <td>{{ Str::limit($review->content, 50) }}</td>
                                    <td>
                                        <div class="rating-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                            <span class="badge badge-light">{{ $review->rating }}/5</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $review->is_approved ? 'success' : 'warning' }}">
                                            {{ $review->is_approved ? 'معتمد' : 'معلق' }}
                                        </span>
                                    </td>
                                    <td>{{ $review->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        {{-- زر عرض --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                            data-target="#showReviewModal{{ $review->id }}" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- زر تعديل --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-primary" data-toggle="modal"
                                            data-target="#editReviewModal{{ $review->id }}" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- زر حذف --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                            data-target="#deleteReviewModal{{ $review->id }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- زر الموافقة --}}
                                        @if (!$review->is_approved)
                                            <button type="button" class="btn btn-sm btn-circle btn-success"
                                                onclick="event.preventDefault(); document.getElementById('approve-review-{{ $review->id }}').submit();"
                                                title="موافقة">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <form id="approve-review-{{ $review->id }}"
                                                action="{{ route('reviews.approve', $review) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        @endif

                                        {{-- تضمين المودالات لكل تقييم --}}
                                        @include('dashboard.reviews.modals.show', ['review' => $review])
                                        @include('dashboard.reviews.modals.edit', ['review' => $review])
                                        @include('dashboard.reviews.modals.delete', ['review' => $review])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">لا يوجد تقييمات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- الترقيم --}}
                <div class="d-flex justify-content-center">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة تقييم (ثابت) --}}
    @include('dashboard.reviews.modals.create')
@endsection

@push('styles')
    <style>
        .rating-stars {
            display: inline-flex;
            align-items: center;
        }

        .rating-stars .fa-star {
            font-size: 1rem;
            margin-right: 2px;
        }
    </style>
@endpush

@push('scripts')
    {{-- عرض اسم الملف المختار في حقول upload --}}
    <script>
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);
        });

        {{-- تفعيل التولتيب الافتراضي --}}
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endpush
