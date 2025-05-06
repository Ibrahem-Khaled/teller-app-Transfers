@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- عنوان الصفحة ومسار التنقل --}}
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إدارة التعليقات</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">التعليقات</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        {{-- إحصائيات التعليقات --}}
        <div class="row mb-4">
            {{-- إجمالي التعليقات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-comments" title="إجمالي التعليقات" :value="$totalComments" color="primary" />
            </div>
            {{-- التعليقات الحديثة --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-clock" title="تعليقات الأسبوع" :value="$recentComments" color="success" />
            </div>
            {{-- المستخدم الأكثر تعليقا --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-user" title="الأكثر تعليقا" :value="$topUser->name ?? 'لا يوجد'" :subValue="($topUser->comments_count ?? 0) . ' تعليق'" color="info" />
            </div>
            {{-- عدد الفيديوهات --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <x-stats-card icon="fas fa-video" title="عدد الفيديوهات" :value="count($videos)" color="warning" />
            </div>
        </div>

        {{-- بطاقة قائمة التعليقات --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">قائمة التعليقات</h6>
                <button class="btn btn-primary" data-toggle="modal" data-target="#createCommentModal">
                    <i class="fas fa-plus"></i> إضافة تعليق
                </button>
            </div>
            <div class="card-body">
                {{-- تبويب الفيديوهات --}}
                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ $selectedVideo === 'all' ? 'active' : '' }}"
                            href="{{ route('comments.index') }}">الكل</a>
                    </li>
                    {{-- @foreach ($videos as $id => $title)
                        <li class="nav-item">
                            <a class="nav-link {{ $selectedVideo == $id ? 'active' : '' }}"
                                href="{{ route('comments.index', ['video' => $id]) }}">
                                {{ Str::limit($title, 20) }}
                            </a>
                        </li>
                    @endforeach --}}
                </ul>

                {{-- نموذج البحث --}}
                <form action="{{ route('comments.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="ابحث في محتوى التعليقات..."
                            value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> بحث
                            </button>
                        </div>
                    </div>
                </form>

                {{-- جدول التعليقات --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>المستخدم</th>
                                <th>الفيديو</th>
                                <th>التعليق</th>
                                <th>التاريخ</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comments as $comment)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('img/default-avatar.png') }}"
                                                alt="{{ $comment->user->name }}" class="rounded-circle mr-2" width="40"
                                                height="40">
                                            {{ $comment->user->name }}
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($comment->video->title, 20) }}</td>
                                    <td>{{ Str::limit($comment->comment, 50) }}</td>
                                    <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        {{-- زر عرض --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-info" data-toggle="modal"
                                            data-target="#showCommentModal{{ $comment->id }}" title="عرض">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- زر تعديل --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-primary" data-toggle="modal"
                                            data-target="#editCommentModal{{ $comment->id }}" title="تعديل">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- زر حذف --}}
                                        <button type="button" class="btn btn-sm btn-circle btn-danger" data-toggle="modal"
                                            data-target="#deleteCommentModal{{ $comment->id }}" title="حذف">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- تضمين المودالات لكل تعليق --}}
                                        @include('dashboard.comments.modals.show', ['comment' => $comment])
                                        @include('dashboard.comments.modals.edit', ['comment' => $comment])
                                        @include('dashboard.comments.modals.delete', [
                                            'comment' => $comment,
                                        ])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">لا يوجد تعليقات</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- الترقيم --}}
                <div class="d-flex justify-content-center">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- مودال إضافة تعليق (ثابت) --}}
    @include('dashboard.comments.modals.create')
@endsection

@push('scripts')
    {{-- تفعيل التولتيب الافتراضي --}}
    <script>
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endpush
