<div class="modal fade" id="showReviewModal{{ $review->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showReviewModalLabel">تفاصيل التقييم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <img src="{{ $review->user->avatar ? asset('storage/' . $review->user->avatar) : asset('img/default-avatar.png') }}"
                                alt="{{ $review->user->name }}" class="rounded-circle mr-3" width="60"
                                height="60">
                            <div>
                                <h6 class="mb-0">{{ $review->user->name }}</h6>
                                <small class="text-muted">{{ $review->user->email }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-1">الدورة: {{ $review->course->title }}</h6>
                        <div class="rating-stars mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                            @endfor
                            <span class="badge badge-light ml-2">{{ $review->rating }}/5</span>
                        </div>
                        <span class="badge badge-{{ $review->is_approved ? 'success' : 'warning' }}">
                            {{ $review->is_approved ? 'معتمد' : 'معلق' }}
                        </span>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">محتوى التقييم</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $review->content }}</p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <small class="text-muted">تاريخ الإنشاء: {{ $review->created_at->format('Y-m-d H:i') }}</small>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">آخر تحديث: {{ $review->updated_at->format('Y-m-d H:i') }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
