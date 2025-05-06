<div class="modal fade" id="restoreCourseModal{{ $course->id }}" tabindex="-1" role="dialog"
    aria-labelledby="restoreCourseModalLabel{{ $course->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreCourseModalLabel{{ $course->id }}">استعادة الدورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('courses.restore', $course->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>هل أنت متأكد من استعادة الدورة <strong>{{ $course->name }}</strong>؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success">استعادة</button>
                </div>
            </form>
        </div>
    </div>
</div>
