<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">تعديل المستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_name_{{ $user->id }}">الاسم *</label>
                                <input type="text" class="form-control" id="edit_name_{{ $user->id }}"
                                    name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_email_{{ $user->id }}">البريد الإلكتروني</label>
                                <input type="email" class="form-control" id="edit_email_{{ $user->id }}"
                                    name="email" value="{{ old('email', $user->email) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_phone_{{ $user->id }}">الهاتف</label>
                                <input type="text" class="form-control" id="edit_phone_{{ $user->id }}"
                                    name="phone" value="{{ old('phone', $user->phone) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_role_{{ $user->id }}">الدور *</label>
                                <select class="form-control" id="edit_role_{{ $user->id }}" name="role"
                                    required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            @if (old('role', $user->role) === $role) selected @endif>
                                            @php
                                                $names = [
                                                    'admin' => 'مدير',
                                                    'teacher' => 'معلم',
                                                    'student' => 'طالب',
                                                    'super_admin' => 'مدير عام',
                                                ];
                                            @endphp
                                            {{ $names[$role] ?? $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_password_{{ $user->id }}">كلمة المرور</label>
                                <input type="password" class="form-control" id="edit_password_{{ $user->id }}"
                                    name="password">
                                <small class="text-muted">اتركه فارغاً إذا لم ترد تغيير كلمة المرور</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_password_confirmation_{{ $user->id }}">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control"
                                    id="edit_password_confirmation_{{ $user->id }}" name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_status_{{ $user->id }}">الحالة</label>
                                <select class="form-control" id="edit_status_{{ $user->id }}" name="status">
                                    <option value="1" @if (old('status', $user->status) == 1) selected @endif>نشط
                                    </option>
                                    <option value="0" @if (old('status', $user->status) == 0) selected @endif>غير نشط
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_avatar_{{ $user->id }}">الصورة الشخصية</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"
                                        id="edit_avatar_{{ $user->id }}" name="avatar">
                                    <label class="custom-file-label" for="edit_avatar_{{ $user->id }}">اختر
                                        ملف</label>
                                </div>
                                @if ($user->avatar)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                                            class="img-thumbnail" width="80">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_address_{{ $user->id }}">العنوان</label>
                        <textarea class="form-control" id="edit_address_{{ $user->id }}" name="address" rows="2">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تحديث المستخدم</button>
                </div>
            </form>
        </div>
    </div>
</div>
