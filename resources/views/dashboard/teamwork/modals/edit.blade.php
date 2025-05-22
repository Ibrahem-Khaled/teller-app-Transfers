<div class="modal fade" id="editTeamMemberModal{{ $teamMember->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editTeamMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTeamMemberModalLabel">تعديل عضو الفريق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('teamwork.update', $teamMember) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">الاسم</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $teamMember->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $teamMember->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">رقم الهاتف</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $teamMember->phone }}" required>
                    </div>

                    <div class="form-group">
                        <label for="address">العنوان</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $teamMember->address }}">
                    </div>

                    <div class="form-group">
                        <label for="password">كلمة المرور الجديدة</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="text-muted">اتركه فارغاً إذا كنت لا تريد تغيير كلمة المرور</small>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">تأكيد كلمة المرور</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation">
                    </div>

                    <div class="form-group">
                        <label for="status">الحالة</label>
                        <select class="form-control" id="status" name="status">
                            <option value="1" {{ $teamMember->status ? 'selected' : '' }}>نشط</option>
                            <option value="0" {{ !$teamMember->status ? 'selected' : '' }}>غير نشط</option>
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
