<div class="modal fade" id="editCommentModal{{ $comment->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">تعديل التعليق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('comments.update', $comment) }}" method="POST">
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
                                            {{ $comment->user_id == $id ? 'selected' : '' }}>{{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="video_id">الفيديو</label>
                                <select class="form-control" id="video_id" name="video_id" required>
                                    @foreach ($videos as $id => $title)
                                        <option value="{{ $id }}"
                                            {{ $comment->video_id == $id ? 'selected' : '' }}>{{ $title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comment">نص التعليق</label>
                        <textarea class="form-control" id="comment" name="comment" rows="5" required>{{ $comment->comment }}</textarea>
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
