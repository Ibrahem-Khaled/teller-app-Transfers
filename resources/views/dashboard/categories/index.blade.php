@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة ومسار التنقل --}}
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة الفئات</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">الفئات</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        {{-- إحصائيات الفئات --}}
        <div class="row mb-4">
            {{-- إجمالي الفئات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-list" title="إجمالي الفئات" :value="$totalCount" color="primary" />
            </div>
            {{-- الفئات النشطة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-check-circle" title="الفئات النشطة" :value="$activeCount" color="success" />
            </div>
            {{-- الفئات المحذوفة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-trash-alt" title="الفئات المحذوفة" :value="$trashedCount" color="danger" />
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
                                        data-target="#createCategoryModal">
                                        <i class="fas fa-plus"></i> إضافة فئة
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

        {{-- بطاقة قائمة الفئات --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">قائمة الفئات</h6>
                <div class="btn-group">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModal">
                        <i class="fas fa-plus"></i> إضافة فئة
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{-- تبويب الحالة --}}
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ $status === 'all' ? 'active' : '' }}"
                            href="{{ route('categories.index', ['status' => 'all']) }}">الكل</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $status === 'active' ? 'active' : '' }}"
                            href="{{ route('categories.index', ['status' => 'active']) }}">النشطة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $status === 'trashed' ? 'active' : '' }}"
                            href="{{ route('categories.index', ['status' => 'trashed']) }}">المحذوفة</a>
                    </li>
                </ul>

                {{-- نموذج البحث --}}
                <form action="{{ route('categories.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="ابحث باسم الفئة أو الوصف..."
                            value="{{ $search }}">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> بحث
                            </button>
                        </div>
                    </div>
                </form>

                {{-- جدول الفئات --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>الوصف</th>
                                <th>الأيقونة</th>
                                <th>الحالة</th>
                                <th>تاريخ الإنشاء</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ Str::limit($category->description, 50) }}</td>
                                    <td>
                                        @if ($category->icon)
                                            <img src="{{ asset('storage/' . $category->icon) }}"
                                                alt="{{ $category->name }}" width="30">
                                        @else
                                            <i class="fas fa-folder text-muted"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $category->status_class }}">
                                            {{ $category->status }}
                                        </span>
                                    </td>
                                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        {{-- زر عرض --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                            data-target="#showCategoryModal{{ $category->id }}" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- زر تعديل --}}
                                        @if (!$category->trashed())
                                            <button type="button" class="btn btn-sm btn-circle btn-primary"
                                                data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}"
                                                title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif

                                        {{-- زر حذف/استعادة --}}
                                        @if ($category->trashed())
                                            <button type="button" class="btn btn-sm btn-circle btn-success"
                                                data-toggle="modal" data-target="#restoreCategoryModal{{ $category->id }}"
                                                title="استعادة">
                                                <i class="fas fa-trash-restore"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-circle btn-danger"
                                                data-toggle="modal" data-target="#deleteCategoryModal{{ $category->id }}"
                                                title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif

                                        {{-- زر حذف نهائي --}}
                                        @if ($category->trashed())
                                            <button type="button" class="btn btn-sm btn-circle btn-danger"
                                                data-toggle="modal"
                                                data-target="#forceDeleteCategoryModal{{ $category->id }}"
                                                title="حذف نهائي">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif

                                        {{-- تضمين المودالات لكل فئة --}}
                                        @include('dashboard.categories.modals.show', [
                                            'category' => $category,
                                        ])
                                        @include('dashboard.categories.modals.edit', [
                                            'category' => $category,
                                        ])
                                        @include('dashboard.categories.modals.delete', [
                                            'category' => $category,
                                        ])
                                        @include('dashboard.categories.modals.restore', [
                                            'category' => $category,
                                        ])
                                        @include('dashboard.categories.modals.force-delete', [
                                            'category' => $category,
                                        ])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">لا توجد فئات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- الترقيم --}}
                <div class="d-flex justify-content-center">
                    {{ $categories->appends(['search' => $search, 'status' => $status])->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة فئة --}}
    @include('dashboard.categories.modals.create')
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
