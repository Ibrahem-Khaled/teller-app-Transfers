<div class="modal fade" id="deleteTeamMemberModal{{ $teamMember->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteTeamMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTeamMemberModalLabel">حذف عضو الفريق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('teamwork.destroy', $teamMember) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> هل أنت متأكد من حذف هذا العضو من الفريق؟
                    </div>
                    <div class="text-center">
                        <p class="mb-1"><strong>الاسم:</strong> {{ $teamMember->name }}</p>
                        <p class="mb-1"><strong>البريد الإلكتروني:</strong> {{ $teamMember->email }}</p>
                        <p class="mb-0">
                            <strong>الحالة:</strong>
                            <span class="badge badge-{{ $teamMember->status ? 'success' : 'danger' }}">
                                {{ $teamMember->status ? 'نشط' : 'غير نشط' }}
                            </span>
                        </p>
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
