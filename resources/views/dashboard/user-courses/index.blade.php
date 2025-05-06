@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة ومسار التنقل --}}
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة تسجيلات الدورات</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">تسجيلات الدورات</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        {{-- إحصائيات التسجيلات --}}
        <div class="row mb-4">
            {{-- إجمالي التسجيلات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-book" title="إجمالي التسجيلات" :value="$totalEnrollments" color="primary" />
            </div>
            {{-- التسجيلات المكتملة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-check-circle" title="التسجيلات المكتملة" :value="$completedEnrollments" color="success" />
            </div>
            {{-- التسجيلات قيد التقدم --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-spinner" title="قيد التقدم" :value="$inProgressEnrollments" color="info" />
            </div>
            {{-- نسبة الإكمال --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-percent" title="نسبة الإكمال" :value="$completionRate . '%'" color="warning" />
            </div>
        </div>

        {{-- بطاقة قائمة التسجيلات --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">قائمة تسجيلات الدورات</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createUserCourseModal">
                    <i class="fas fa-plus"></i> تسجيل جديد
                </button>
            </div>
            <div class="card-body">
                {{-- تبويب الحالات --}}
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedStatus === 'all' ? 'active' : '' }}"
                            href="{{ route('user-courses.index') }}">الكل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedStatus === 'in_progress' ? 'active' : '' }}"
                            href="{{ route('user-courses.index', ['status' => 'in_progress']) }}">قيد التقدم</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedStatus === 'completed' ? 'active' : '' }}"
                            href="{{ route('user-courses.index', ['status' => 'completed']) }}">مكتملة</a>
                    </li>
                </ul>

                {{-- نموذج البحث --}}
                <form action="{{ route('user-courses.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="ابحث بالمستخدم أو الدورة..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> بحث
                            </button>
                        </div>
                    </div>
                </form>

                {{-- جدول التسجيلات --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>المستخدم</th>
                                <th>الدورة</th>
                                <th>الحالة</th>
                                <th>تاريخ التسجيل</th>
                                <th>تاريخ التحديث</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($userCourses as $userCourse)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $userCourse->user->avatar ? asset('storage/' . $userCourse->user->avatar) : asset('img/default-avatar.png') }}"
                                                alt="{{ $userCourse->user->name }}" class="rounded-circle mr-2"
                                                width="40" height="40">
                                            {{ $userCourse->user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $userCourse->course->name }}</td>
                                    <td>
                                        @if ($userCourse->status == 'completed')
                                            <span class="badge badge-success">مكتملة</span>
                                        @else
                                            <span class="badge badge-info">قيد التقدم</span>
                                        @endif
                                    </td>
                                    <td>{{ $userCourse->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $userCourse->updated_at->format('Y-m-d') }}</td>
                                    <td>
                                        {{-- زر عرض --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                            data-target="#showUserCourseModal{{ $userCourse->id }}" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- زر تعديل --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-primary" data-toggle="modal"
                                            data-target="#editUserCourseModal{{ $userCourse->id }}" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- زر حذف --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                            data-target="#deleteUserCourseModal{{ $userCourse->id }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- زر إكمال --}}
                                        @if ($userCourse->status != 'completed')
                                            <button type="button" class="btn btn-sm btn-circle btn-success"
                                                onclick="event.preventDefault(); document.getElementById('complete-user-course-{{ $userCourse->id }}').submit();"
                                                title="تمييز كمكتملة">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <form id="complete-user-course-{{ $userCourse->id }}"
                                                action="{{ route('user-courses.complete', $userCourse) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        @endif

                                        {{-- تضمين المودالات لكل تسجيل --}}
                                        @include('dashboard.user-courses.modals.show', [
                                            'userCourse' => $userCourse,
                                        ])
                                        @include('dashboard.user-courses.modals.edit', [
                                            'userCourse' => $userCourse,
                                        ])
                                        @include('dashboard.user-courses.modals.delete', [
                                            'userCourse' => $userCourse,
                                        ])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">لا يوجد تسجيلات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- الترقيم --}}
                <div class="d-flex justify-content-center">
                    {{ $userCourses->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة تسجيل (ثابت) --}}
    @include('dashboard.user-courses.modals.create')
@endsection

@push('scripts')
    {{-- تفعيل التولتيب الافتراضي --}}
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endpush
