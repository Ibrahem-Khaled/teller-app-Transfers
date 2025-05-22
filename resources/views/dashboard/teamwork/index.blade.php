@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة فريق العمل</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">فريق العمل</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">قائمة أعضاء الفريق</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createTeamMemberModal">
                    <i class="fas fa-plus"></i> إضافة عضو
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>الهاتف</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teamMembers as $member)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $member->avatar ? asset('storage/' . $member->avatar) : asset('img/default-avatar.png') }}"
                                                alt="{{ $member->name }}" class="rounded-circle mr-2" width="40"
                                                height="40">
                                            {{ $member->name }}
                                        </div>
                                    </td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>
                                        <span class="badge badge-{{ $member->status ? 'success' : 'danger' }}">
                                            {{ $member->status ? 'نشط' : 'غير نشط' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-circle btn-primary" data-toggle="modal"
                                            data-target="#editTeamMemberModal{{ $member->id }}" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                            data-target="#deleteTeamMemberModal{{ $member->id }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        @include('dashboard.teamwork.modals.edit', [
                                            'teamMember' => $member,
                                        ])
                                        @include('dashboard.teamwork.modals.delete', [
                                            'teamMember' => $member,
                                        ])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">لا يوجد أعضاء في الفريق</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $teamMembers->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.teamwork.modals.create')
@endsection
