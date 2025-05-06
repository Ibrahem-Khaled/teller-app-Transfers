<div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReviewModalLabel">تعديل التقييم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('reviews.update', $review) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">المستخدم</label>
                                <select class="form-control" id="user_id" name="user_id" required>
                                    @foreach ($users as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ $review->user_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course_id">الدورة</label>
                                <select class="form-control" id="course_id" name="course_id" required>
                                    @foreach ($courses as $id => $title)
                                        <option value="{{ $id }}"
                                            {{ $review->course_id == $id ? 'selected' : '' }}>{{ $title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content">محتوى التقييم</label>
                        <textarea class="form-control" id="content" name="content" rows="3" required>{{ $review->content }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rating">التقييم</label>
                                <select class="form-control" id="rating" name="rating" required>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}"
                                            {{ $review->rating == $i ? 'selected' : '' }}>{{ $i }} نجمة
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_approved">حالة التقييم</label>
                                <select class="form-control" id="is_approved" name="is_approved">
                                    <option value="0" {{ !$review->is_approved ? 'selected' : '' }}>معلق</option>
                                    <option value="1" {{ $review->is_approved ? 'selected' : '' }}>معتمد</option>
                                </select>
                            </div>
                        </div>
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
