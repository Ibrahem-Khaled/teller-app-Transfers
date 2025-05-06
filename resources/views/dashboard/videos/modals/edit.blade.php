<div class="modal fade" id="editVideoModal{{ $video->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editVideoModalLabel{{ $video->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVideoModalLabel{{ $video->id }}">تعديل المقطع: {{ $video->title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_course_id_{{ $video->id }}">الدورة التعليمية *</label>
                                <select class="form-control" id="edit_course_id_{{ $video->id }}" name="course_id"
                                    required>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ $video->course_id == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_title_{{ $video->id }}">عنوان المقطع *</label>
                                <input type="text" class="form-control" id="edit_title_{{ $video->id }}"
                                    name="title" value="{{ old('title', $video->title) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_description_{{ $video->id }}">وصف المقطع</label>
                        <textarea class="form-control" id="edit_description_{{ $video->id }}" name="description" rows="2">{{ old('description', $video->description) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_video_file_{{ $video->id }}">ملف المقطع *</label>
                                <input type="file" class="form-control" id="edit_video_file_{{ $video->id }}"
                                    name="video_file" accept="video/*">
                                @if ($video->video_path)
                                    <small>الملف الحالي: {{ basename($video->video_path) }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_thumbnail_{{ $video->id }}">صورة المقطع</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="edit_thumbnail_{{ $video->id }}" name="thumbnail">
                                    <label class="custom-file-label" for="edit_thumbnail_{{ $video->id }}">اختر
                                        ملف</label>
                                </div>
                                @if ($video->thumbnail)
                                    <div class="mt-2">
                                        <img src="{{ $video->thumbnail_url }}" alt="الصورة الحالية"
                                            class="img-thumbnail" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_status_{{ $video->id }}">حالة المقطع *</label>
                                <select class="form-control" id="edit_status_{{ $video->id }}" name="status"
                                    required>
                                    <option value="active" {{ $video->status === 'active' ? 'selected' : '' }}>نشط
                                    </option>
                                    <option value="inactive" {{ $video->status === 'inactive' ? 'selected' : '' }}>غير
                                        نشط</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_type_{{ $video->id }}">نوع المقطع *</label>
                                <select class="form-control" id="edit_type_{{ $video->id }}" name="type"
                                    required>
                                    <option value="video" {{ $video->type === 'video' ? 'selected' : '' }}>فيديو
                                    </option>
                                    <option value="audio" {{ $video->type === 'audio' ? 'selected' : '' }}>صوت
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="edit_order_{{ $video->id }}">ترتيب المقطع *</label>
                                <input type="number" class="form-control" id="edit_order_{{ $video->id }}"
                                    name="order" min="0" value="{{ old('order', $video->order) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_is_free_{{ $video->id }}"
                                name="is_free" value="1" {{ $video->is_free ? 'checked' : '' }}>
                            <label class="form-check-label" for="edit_is_free_{{ $video->id }}">
                                مقطع مجاني
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تحديث المقطع</button>
                </div>
            </form>
        </div>
    </div>
</div>
