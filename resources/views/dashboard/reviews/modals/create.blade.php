<div class="modal fade" id="createReviewModal" tabindex="-1" role="dialog" aria-labelledby="createReviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createReviewModalLabel">إضافة تقييم جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">المستخدم</label>
                                <select class="form-control" id="user_id" name="user_id" required>
                                    <option value="">اختر المستخدم</option>
                                    @foreach ($users as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course_id">الدورة</label>
                                <select class="form-control" id="course_id" name="course_id" required>
                                    <option value="">اختر الدورة</option>
                                    @foreach ($courses as $id => $title)
                                        <option value="{{ $id }}">{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content">محتوى التقييم</label>
                        <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rating">التقييم</label>
                                <select class="form-control" id="rating" name="rating" required>
                                    <option value="">اختر التقييم</option>
                                    <option value="1">1 نجمة</option>
                                    <option value="2">2 نجمات</option>
                                    <option value="3">3 نجمات</option>
                                    <option value="4">4 نجمات</option>
                                    <option value="5">5 نجمات</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_approved">حالة التقييم</label>
                                <select class="form-control" id="is_approved" name="is_approved">
                                    <option value="0">معلق</option>
                                    <option value="1">معتمد</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ التقييم</button>
                </div>
            </form>
        </div>
    </div>
</div>
