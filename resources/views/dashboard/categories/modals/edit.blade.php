<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">تعديل الفئة:
                    {{ $category->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_name_{{ $category->id }}">اسم الفئة *</label>
                                <input type="text" class="form-control" id="edit_name_{{ $category->id }}"
                                    name="name" value="{{ old('name', $category->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_icon_{{ $category->id }}">أيقونة الفئة</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit_icon_{{ $category->id }}"
                                        name="icon">
                                    <label class="custom-file-label" for="edit_icon_{{ $category->id }}">اختر
                                        ملف</label>
                                </div>
                                @if ($category->icon)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $category->icon) }}" alt="الأيقونة الحالية"
                                            class="img-thumbnail" width="80">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_description_{{ $category->id }}">وصف الفئة</label>
                        <textarea class="form-control" id="edit_description_{{ $category->id }}" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">تحديث الفئة</button>
                </div>
            </form>
        </div>
    </div>
</div>
