<div class="modal fade" id="deleteUserCourseModal{{ $userCourse->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteUserCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserCourseModalLabel">حذف تسجيل الدورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user-courses.destroy', $userCourse) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> هل أنت متأكد من حذف هذا التسجيل؟
                    </div>
                    <div class="text-center">
                        <p class="mb-1"><strong>المستخدم:</strong> {{ $userCourse->user->name }}</p>
                        <p class="mb-1"><strong>الدورة:</strong> {{ $userCourse->course->name }}</p>
                        <p class="mb-0">
                            <strong>الحالة:</strong>
                            <span class="badge badge-{{ $userCourse->status == 'completed' ? 'success' : 'info' }}">
                                {{ $userCourse->status == 'completed' ? 'مكتملة' : 'قيد التقدم' }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
