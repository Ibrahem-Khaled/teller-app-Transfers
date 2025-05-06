{{-- resources/views/dashboard/users/modals/show.blade.php --}}
@php
    // تعريف أسماء الأدوار
    $roleNames = [
        'admin' => 'مدير',
        'teacher' => 'معلم',
        'student' => 'طالب',
        'super_admin' => 'مدير عام',
    ];
@endphp

<div class="modal fade" id="showUserModal{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showUserModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showUserModalLabel{{ $user->id }}">تفاصيل المستخدم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{-- صورة واسم ودور وحالة المستخدم --}}
                    <div class="col-md-4 text-center">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('img/default-avatar.png') }}"
                            alt="صورة {{ $user->name }}" class="img-fluid rounded-circle mb-3" width="150">
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <span class="badge badge-primary">
                            {{ $roleNames[$user->role] ?? $user->role }}
                        </span>
                        <div class="mt-2">
                            <span class="badge badge-{{ $user->status ? 'success' : 'danger' }}">
                                {{ $user->status ? 'نشط' : 'غير نشط' }}
                            </span>
                        </div>
                    </div>
                    {{-- باقي التفاصيل في جدول --}}
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <th width="30%">البريد الإلكتروني</th>
                                    <td>{{ $user->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>الهاتف</th>
                                    <td>{{ $user->phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>العنوان</th>
                                    <td>{{ $user->address ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء</th>
                                    <td>{{ $user?->created_at?->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>آخر تحديث</th>
                                    <td>{{ $user?->updated_at?->format('Y-m-d H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
