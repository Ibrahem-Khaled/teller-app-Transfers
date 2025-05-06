<div class="modal fade" id="showUserCourseModal{{ $userCourse->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showUserCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showUserCourseModalLabel">تفاصيل تسجيل الدورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">معلومات المستخدم</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $userCourse->user->avatar ? asset('storage/' . $userCourse->user->avatar) : asset('img/default-avatar.png') }}"
                                        alt="{{ $userCourse->user->name }}" class="rounded-circle mr-3" width="60"
                                        height="60">
                                    <div>
                                        <h6 class="mb-0">{{ $userCourse->user->name }}</h6>
                                        <p class="mb-0 text-muted">{{ $userCourse->user->email }}</p>
                                        <p class="mb-0">{{ $userCourse->user->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">معلومات الدورة</h6>
                            </div>
                            <div class="card-body">
                                <h6 class="mb-1">{{ $userCourse->course->name }}</h6>
                                <p class="mb-1 text-muted">المستوى: {{ $userCourse->course->level }}</p>
                                <p class="mb-0">
                                    السعر:
                                    @if ($userCourse->course->price == '0.00')
                                        <span class="badge badge-success">مجاني</span>
                                    @else
                                        {{ $userCourse->course->price }} ر.س
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-light d-flex justify-content-between">
                        <h6 class="mb-0">معلومات التسجيل</h6>
                        <span class="badge badge-{{ $userCourse->status == 'completed' ? 'success' : 'info' }}">
                            {{ $userCourse->status == 'completed' ? 'مكتملة' : 'قيد التقدم' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>تاريخ التسجيل:</strong>
                                    {{ $userCourse->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>آخر تحديث:</strong>
                                    {{ $userCourse->updated_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
