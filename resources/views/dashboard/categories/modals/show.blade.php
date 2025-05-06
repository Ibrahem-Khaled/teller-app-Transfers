<div class="modal fade" id="showCategoryModal{{ $category->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showCategoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCategoryModalLabel{{ $category->id }}">تفاصيل الفئة:
                    {{ $category->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if ($category->icon)
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}"
                                class="img-fluid rounded mb-3" width="150">
                        @else
                            <i class="fas fa-folder fa-5x text-muted mb-3"></i>
                        @endif
                        <h4>{{ $category->name }}</h4>
                        <span class="badge badge-{{ $category->status_class }}">
                            {{ $category->status }}
                        </span>
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">الوصف</th>
                                    <td>{{ $category->description ?? 'لا يوجد وصف' }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء</th>
                                    <td>{{ $category->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>آخر تحديث</th>
                                    <td>{{ $category->updated_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                @if ($category->trashed())
                                    <tr>
                                        <th>تاريخ الحذف</th>
                                        <td>{{ $category->deleted_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endif
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
