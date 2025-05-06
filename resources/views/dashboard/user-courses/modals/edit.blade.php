<div class="modal fade" id="editUserCourseModal{{ $userCourse->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editUserCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserCourseModalLabel">تعديل تسجيل الدورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user-courses.update', $userCourse) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">المستخدم</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            @foreach ($users as $id => $name)
                                <option value="{{ $id }}" {{ $userCourse->user_id == $id ? 'selected' : '' }}>
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="course_id">الدورة</label>
                        <select class="form-control" id="course_id" name="course_id" required>
                            @foreach ($courses as $id => $name)
                                <option value="{{ $id }}"
                                    {{ $userCourse->course_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">حالة التسجيل</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="in_progress" {{ $userCourse->status == 'in_progress' ? 'selected' : '' }}>قيد
                                التقدم</option>
                            <option value="completed" {{ $userCourse->status == 'completed' ? 'selected' : '' }}>مكتملة
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>
</div>
