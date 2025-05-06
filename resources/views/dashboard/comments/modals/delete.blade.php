<div class="modal fade" id="deleteCommentModal{{ $comment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCommentModalLabel">حذف التعليق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> هل أنت متأكد من حذف هذا التعليق؟
                    </div>
                    <div class="text-center">
                        <p class="mb-1"><strong>المستخدم:</strong> {{ $comment->user->name }}</p>
                        <p class="mb-1"><strong>الفيديو:</strong> {{ Str::limit($comment->video->title, 30) }}</p>
                        <p class="mb-0">{{ Str::limit($comment->comment, 100) }}</p>
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
