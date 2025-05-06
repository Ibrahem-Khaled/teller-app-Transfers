@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- عنوان الصفحة ومسار التنقل --}}
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-0 text-gray-800">إدارة الدورات التعليمية</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">الدورات</li>
                </ol>
            </nav>
        </div>
    </div>

    @include('components.alerts')

    {{-- إحصائيات الدورات --}}
    <div class="row mb-4">
        {{-- إجمالي الدورات --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <x-stats-card icon="fas fa-book" title="إجمالي الدورات" :value="$totalCount" color="primary" />
        </div>
        {{-- الدورات النشطة --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <x-stats-card icon="fas fa-check-circle" title="الدورات النشطة" :value="$activeCount" color="success" />
        </div>
        {{-- الدورات المحذوفة --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <x-stats-card icon="fas fa-trash-alt" title="الدورات المحذوفة" :value="$trashedCount" color="danger" />
        </div>
        {{-- إجراءات سريعة --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                إجراءات سريعة</div>
                            <div class="h5 mb-0">
                                <button class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#createCourseModal">
                                    <i class="fas fa-plus"></i> إضافة دورة
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

    {{-- بطاقة قائمة الدورات --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">قائمة الدورات</h6>
            <div class="btn-group">
                <button class="btn btn-primary" data-toggle="modal" data-target="#createCourseModal">
                    <i class="fas fa-plus"></i> إضافة دورة
                </button>
            </div>
        </div>
        <div class="card-body">
            {{-- تبويب الحالة --}}
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link {{ $status === 'all' ? 'active' : '' }}"
                        href="{{ route('courses.index', ['status' => 'all']) }}">الكل</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status === 'active' ? 'active' : '' }}"
                        href="{{ route('courses.index', ['status' => 'active']) }}">النشطة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $status === 'trashed' ? 'active' : '' }}"
                        href="{{ route('courses.index', ['status' => 'trashed']) }}">المحذوفة</a>
                </li>
            </ul>

            {{-- تصفية إضافية --}}
            <div class="row mb-4">
                <div class="col-md-4">
                    <form action="{{ route('courses.index') }}" method="GET">
                        <div class="form-group">
                            <label for="level">تصفية حسب المستوى</label>
                            <select name="level" id="level" class="form-control" onchange="this.form.submit()">
                                <option value="all" {{ $level==='all' ? 'selected' : '' }}>جميع المستويات</option>
                                @foreach($levels as $key => $value)
                                <option value="{{ $key }}" {{ $level===$key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="hidden" name="search" value="{{ $search }}">
                    </form>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('courses.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="ابحث باسم الدورة أو الوصف..." value="{{ $search }}">
                            <input type="hidden" name="status" value="{{ $status }}">
                            <input type="hidden" name="level" value="{{ $level }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i> بحث
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- جدول الدورات --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>الصورة</th>
                            <th>اسم الدورة</th>
                            <th>التصنيف</th>
                            <th>المدة</th>
                            <th>المستوى</th>
                            <th>السعر</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                                    width="50" class="rounded">
                                @else
                                <i class="fas fa-image text-muted fa-2x"></i>
                                @endif
                            </td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->category->name ?? 'بدون تصنيف' }}</td>
                            <td>{{ $course->duration }}</td>
                            <td>{{ $course->level_name }}</td>
                            <td>
                                @if($course->discount > 0)
                                <span class="text-danger"><del>{{ $course->price }} ر.س</del></span>
                                <br>
                                <span class="text-success">{{ $course->final_price }} ر.س</span>
                                @else
                                {{ $course->price }} ر.س
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $course->status_class }}">
                                    {{ $course->status }}
                                </span>
                            </td>
                            <td>
                                {{-- زر عرض --}}
                                <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                    data-target="#showCourseModal{{ $course->id }}" title="عرض">
                                    <i class="fas fa-eye"></i>
                                </button>

                                {{-- زر تعديل --}}
                                @if(!$course->trashed())
                                <button type="button" class="btn btn-sm btn-circle btn-primary" data-toggle="modal"
                                    data-target="#editCourseModal{{ $course->id }}" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @endif

                                {{-- زر حذف/استعادة --}}
                                @if($course->trashed())
                                <button type="button" class="btn btn-sm btn-circle btn-success" data-toggle="modal"
                                    data-target="#restoreCourseModal{{ $course->id }}" title="استعادة">
                                    <i class="fas fa-trash-restore"></i>
                                </button>
                                @else
                                <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                    data-target="#deleteCourseModal{{ $course->id }}" title="حذف">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif

                                {{-- زر حذف نهائي --}}
                                @if($course->trashed())
                                <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                    data-target="#forceDeleteCourseModal{{ $course->id }}" title="حذف نهائي">
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif

                                {{-- تضمين المودالات لكل دورة --}}
                                @include('dashboard.courses.modals.show', ['course' => $course])
                                @include('dashboard.courses.modals.edit', ['course' => $course])
                                @include('dashboard.courses.modals.delete', ['course' => $course])
                                @include('dashboard.courses.modals.restore', ['course' => $course])
                                @include('dashboard.courses.modals.force-delete', ['course' => $course])
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">لا توجد دورات</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- الترقيم --}}
            <div class="d-flex justify-content-center">
                {{ $courses->appends(['search' => $search, 'status' => $status, 'level' => $level])->links() }}
            </div>
        </div>
    </div>
</div>

{{-- مودال إضافة دورة --}}
@include('dashboard.courses.modals.create')
@endsection

@push('scripts')
{{-- عرض اسم الملف المختار في حقول upload --}}
<script>
    $('.custom-file-input').on('change', function () {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(fileName);
    });

    { { --تفعيل التولتيب الافتراضي-- } }
    $('[data-toggle="tooltip"]').tooltip();

    { { --تحويل حقول الوقت-- } }
    $('input[type="time"]').attr('step', 60);
</script>
@endpush