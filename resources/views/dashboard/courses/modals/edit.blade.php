<div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editCourseModalLabel{{ $course->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel{{ $course->id }}">تعديل الدورة: {{ $course->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_name_{{ $course->id }}">اسم الدورة *</label>
                                <input type="text" class="form-control" id="edit_name_{{ $course->id }}"
                                    name="name" value="{{ old('name', $course->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_category_id_{{ $course->id }}">التصنيف</label>
                                <select class="form-control" id="edit_category_id_{{ $course->id }}"
                                    name="category_id">
                                    <option value="">بدون تصنيف</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_teacher_id_{{ $course->id }}">المدرب *</label>
                                <select class="form-control" id="edit_teacher_id_{{ $course->id }}"
                                    name="teacher_id" required>
                                    <option value="">اختر المدرب</option>
                                    @foreach ($teachers as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ $course->teacher_id == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_thumbnail_{{ $course->id }}">صورة الدورة</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="edit_thumbnail_{{ $course->id }}" name="thumbnail">
                                    <label class="custom-file-label" for="edit_thumbnail_{{ $course->id }}">اختر
                                        ملف</label>
                                </div>
                                @if ($course->thumbnail)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="الصورة الحالية"
                                            class="img-thumbnail" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_duration_{{ $course->id }}">مدة الدورة (ساعة:دقيقة) *</label>
                                <input type="time" class="form-control" id="edit_duration_{{ $course->id }}"
                                    name="duration" value="{{ old('duration', substr($course->duration, 0, 5)) }}"
                                    step="60" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_level_{{ $course->id }}">المستوى *</label>
                                <select class="form-control" id="edit_level_{{ $course->id }}" name="level"
                                    required>
                                    <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>مبتدئ
                                    </option>
                                    <option value="intermediate"
                                        {{ $course->level == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                                    <option value="advanced" {{ $course->level == 'advanced' ? 'selected' : '' }}>متقدم
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_language_{{ $course->id }}">اللغة *</label>
                                <input type="text" class="form-control" id="edit_language_{{ $course->id }}"
                                    name="language" value="{{ old('language', $course->language) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_price_{{ $course->id }}">السعر (ر.س) *</label>
                                <input type="number" class="form-control" id="edit_price_{{ $course->id }}"
                                    name="price" value="{{ old('price', $course->price) }}" min="0"
                                    step="0.01" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_discount_{{ $course->id }}">الخصم (%)</label>
                                <input type="number" class="form-control" id="edit_discount_{{ $course->id }}"
                                    name="discount" value="{{ old('discount', $course->discount) }}" min="0"
                                    max="100">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_description_{{ $course->id }}">وصف الدورة</label>
                        <textarea class="form-control" id="edit_description_{{ $course->id }}" name="description" rows="3">{{ old('description', $course->description) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تحديث الدورة</button>
                </div>
            </form>
        </div>
    </div>
</div>
