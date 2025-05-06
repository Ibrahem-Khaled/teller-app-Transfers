<div class="modal fade" id="forceDeleteCourseModal{{ $course->id }}" tabindex="-1" role="dialog"
    aria-labelledby="forceDeleteCourseModalLabel{{ $course->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forceDeleteCourseModalLabel{{ $course->id }}">حذف الدورة نهائياً</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('courses.force-delete', $course->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>هل أنت متأكد من الحذف النهائي للدورة <strong>{{ $course->name }}</strong>؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه وسيتم حذف جميع البيانات المرتبطة بهذه الدورة.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">حذف نهائي</button>
                </div>
            </form>
        </div>
    </div>

</div>
