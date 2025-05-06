@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة ومسار التنقل --}}
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة المستخدمين</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">المستخدمين</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        {{-- إحصائيات المستخدمين --}}
        <div class="row mb-4">
            {{-- إجمالي المستخدمين --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-users" title="إجمالي المستخدمين" :value="$usersCount" color="primary" />
            </div>
            {{-- المستخدمون النشطون --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-user-check" title="المستخدمون النشطون" :value="$activeUsersCount" color="success" />
            </div>
            {{-- عدد المشرفين --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-user-shield" title="عدد المشرفين" :value="$adminsCount" color="info" />
            </div>
            {{-- عدد الأدوار --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-user-tag" title="عدد الأدوار" :value="count($roles)" color="warning" />
            </div>
        </div>

        {{-- بطاقة قائمة المستخدمين --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">قائمة المستخدمين</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
                    <i class="fas fa-plus"></i> إضافة مستخدم
                </button>
            </div>
            <div class="card-body">
                {{-- تبويب الأدوار --}}
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedRole === 'all' ? 'active' : '' }}"
                            href="{{ route('users.index') }}">الكل</a>
                    </li>
                    @foreach ($roles as $role)
                        <li class="nav-item">
                            <a class="nav-link {{ $selectedRole === $role ? 'active' : '' }}"
                                href="{{ route('users.index', ['role' => $role]) }}">
                                @php
                                    $roleNames = [
                                        'admin' => 'مدير',
                                        'teacher' => 'معلم',
                                        'student' => 'طالب',
                                        'super_admin' => 'مدير عام',
                                    ];
                                @endphp
                                {{ $roleNames[$role] ?? $role }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                {{-- نموذج البحث --}}
                <form action="{{ route('users.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="ابحث بالاسم أو البريد أو الهاتف..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> بحث
                            </button>
                        </div>
                    </div>
                </form>

                {{-- جدول المستخدمين --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>الاسم</th>
                                <th>الدور</th>
                                <th>البريد الإلكتروني</th>
                                <th>الهاتف</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}"
                                                alt="{{ $user->name }}" class="rounded-circle mr-2" width="40"
                                                height="40">
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $roleNames[$user->role] ?? $user->role }}</td>
                                    <td>{{ $user->email ?? '-' }}</td>
                                    <td>{{ $user->phone ?? '-' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $user->status ? 'success' : 'danger' }}">
                                            {{ $user->status ? 'نشط' : 'غير نشط' }}
                                        </span>
                                    </td>
                                    <td>
                                        {{-- زر عرض --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                            data-target="#showUserModal{{ $user->id }}" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- زر تعديل --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-primary" data-toggle="modal"
                                            data-target="#editUserModal{{ $user->id }}" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- زر حذف --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                            data-target="#deleteUserModal{{ $user->id }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- تضمين المودالات لكل مستخدم --}}
                                        @include('dashboard.users.modals.show', ['user' => $user])
                                        @include('dashboard.users.modals.edit', ['user' => $user])
                                        @include('dashboard.users.modals.delete', ['user' => $user])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">لا يوجد مستخدمون</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- الترقيم --}}
                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة مستخدم (ثابت) --}}
    @include('dashboard.users.modals.create')
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
