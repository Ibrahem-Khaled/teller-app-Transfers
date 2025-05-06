@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة ومسار التنقل --}}
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة مقاطع الفيديو</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">مقاطع الفيديو</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        {{-- إحصائيات الفيديوهات --}}
        <div class="row mb-4">
            {{-- إجمالي الفيديوهات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-video" title="إجمالي المقاطع" :value="$totalCount" color="primary" />
            </div>
            {{-- الفيديوهات النشطة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-check-circle" title="المقاطع النشطة" :value="$activeCount" color="success" />
            </div>
            {{-- الفيديوهات غير النشطة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-eye-slash" title="المقاطع غير النشطة" :value="$inactiveCount" color="warning" />
            </div>
            {{-- إجراءات سريعة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    إجراءات سريعة</div>
                                <div class="h5 mb-0">
                                    <button class="btn btn-sm btn-success" data-toggle="modal"
                                        data-target="#createVideoModal">
                                        <i class="fas fa-plus"></i> إضافة مقطع
                                    </button>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bolt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- بطاقة قائمة الفيديوهات --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">قائمة مقاطع الفيديو</h6>
                <div class="btn-group">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createVideoModal">
                        <i class="fas fa-plus"></i> إضافة مقطع
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{-- تصفية الفيديوهات --}}
                <form action="{{ route('videos.index') }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status">حالة المقطع</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="all" {{ $status === 'all' ? 'selected' : '' }}>الكل</option>
                                    <option value="active" {{ $status === 'active' ? 'selected' : '' }}>نشط</option>
                                    <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>غير نشط</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="type">نوع المقطع</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="all" {{ $type === 'all' ? 'selected' : '' }}>الكل</option>
                                    <option value="video" {{ $type === 'video' ? 'selected' : '' }}>فيديو</option>
                                    <option value="audio" {{ $type === 'audio' ? 'selected' : '' }}>صوت</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="course_id">الدورة التعليمية</label>
                                <select name="course_id" id="course_id" class="form-control">
                                    <option value="">كل الدورات</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ $course_id == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search">بحث</label>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="ابحث..."
                                        value="{{ $search }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- جدول الفيديوهات --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>الصورة</th>
                                <th>العنوان</th>
                                <th>الدورة</th>
                                <th>النوع</th>
                                <th>المشاهدات</th>
                                <th>الحالة</th>
                                <th>مجاني؟</th>
                                <th>الترتيب</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($videos as $video)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" width="50"
                                            class="rounded">
                                    </td>
                                    <td>{{ Str::limit($video->title, 30) }}</td>
                                    <td>{{ $video->course->name }}</td>
                                    <td>{{ $video->type_name }}</td>
                                    <td>{{ number_format($video->views) }}</td>
                                    <td>
                                        <span
                                            class="badge badge-{{ $video->status === 'active' ? 'success' : 'warning' }}">
                                            {{ $video->status_name }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($video->is_free)
                                            <span class="badge badge-success">مجاني</span>
                                        @else
                                            <span class="badge badge-primary">مدفوع</span>
                                        @endif
                                    </td>
                                    <td>{{ $video->order }}</td>
                                    <td>
                                        {{-- زر عرض --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                            data-target="#showVideoModal{{ $video->id }}" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- زر تعديل --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-primary"
                                            data-toggle="modal" data-target="#editVideoModal{{ $video->id }}"
                                            title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- زر حذف --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-danger"
                                            data-toggle="modal" data-target="#deleteVideoModal{{ $video->id }}"
                                            title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- تضمين المودالات لكل فيديو --}}
                                        @include('dashboard.videos.modals.show', ['video' => $video])
                                        @include('dashboard.videos.modals.edit', ['video' => $video])
                                        @include('dashboard.videos.modals.delete', ['video' => $video])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">لا توجد مقاطع فيديو</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- الترقيم --}}
                <div class="d-flex justify-content-center">
                    {{ $videos->appends([
                            'search' => $search,
                            'status' => $status,
                            'type' => $type,
                            'course_id' => $course_id,
                        ])->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة فيديو --}}
    @include('dashboard.videos.modals.create')
@endsection

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
