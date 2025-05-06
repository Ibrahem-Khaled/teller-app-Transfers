<div class="modal fade" id="showCourseModal{{ $course->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showCourseModalLabel{{ $course->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCourseModalLabel{{ $course->id }}">تفاصيل الدورة: {{ $course->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if ($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->name }}"
                                class="img-fluid rounded mb-3" style="max-height: 200px;">
                        @else
                            <i class="fas fa-image fa-5x text-muted mb-3"></i>
                        @endif
                        <h4>{{ $course->name }}</h4>
                        <span class="badge badge-{{ $course->status_class }}">
                            {{ $course->status }}
                        </span>
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">التصنيف</th>
                                    <td>{{ $course->category->name ?? 'بدون تصنيف' }}</td>
                                </tr>
                                <tr>
                                    <th>المدرب</th>
                                    <td>{{ $course->teacher->name ?? 'بدون مدرب' }}</td>
                                </tr>
                                <tr>
                                    <th>الوصف</th>
                                    <td>{{ $course->description ?? 'لا يوجد وصف' }}</td>
                                </tr>
                                <tr>
                                    <th>المدة</th>
                                    <td>{{ $course->duration }}</td>
                                </tr>
                                <tr>
                                    <th>المستوى</th>
                                    <td>{{ $course->level_name }}</td>
                                </tr>
                                <tr>
                                    <th>اللغة</th>
                                    <td>{{ $course->language }}</td>
                                </tr>
                                <tr>
                                    <th>السعر</th>
                                    <td>
                                        @if ($course->discount > 0)
                                            <span class="text-danger"><del>{{ $course->price }} ر.س</del></span>
                                            <br>
                                            <span class="text-success">{{ $course->final_price }} ر.س (بعد
                                                الخصم)</span>
                                        @else
                                            {{ $course->price }} ر.س
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء</th>
                                    <td>{{ $course->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                                @if ($course->trashed())
                                    <tr>
                                        <th>تاريخ الحذف</th>
                                        <td>{{ $course->deleted_at->format('Y-m-d H:i') }}</td>
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
