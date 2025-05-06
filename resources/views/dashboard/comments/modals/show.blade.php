<div class="modal fade" id="showCommentModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="showCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCommentModalLabel">تفاصيل التعليق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <img src="{{ $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('img/default-avatar.png') }}"
                                alt="{{ $comment->user->name }}" class="rounded-circle mr-3" width="60"
                                height="60">
                            <div>
                                <h6 class="mb-0">{{ $comment->user->name }}</h6>
                                <small class="text-muted">{{ $comment->user->email }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-1">الفيديو: {{ $comment->video->title }}</h6>
                        <small class="text-muted">تاريخ النشر: {{ $comment->created_at->format('Y-m-d') }}</small>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">نص التعليق</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $comment->comment }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>