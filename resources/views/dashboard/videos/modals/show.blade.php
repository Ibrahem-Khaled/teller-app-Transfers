<div class="modal fade" id="showVideoModal{{ $video->id }}" tabindex="-1" role="dialog"
    aria-labelledby="showVideoModalLabel{{ $video->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showVideoModalLabel{{ $video->id }}">تفاصيل المقطع: {{ $video->title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="img-fluid rounded mb-3">
                        <h4>{{ $video->title }}</h4>
                        <span class="badge badge-{{ $video->status === 'active' ? 'success' : 'warning' }}">
                            {{ $video->status_name }}
                        </span>
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="30%">الدورة التعليمية</th>
                                    <td>{{ $video->course->name }}</td>
                                </tr>
                                <tr>
                                    <th>الوصف</th>
                                    <td>{{ $video->description ?? 'لا يوجد وصف' }}</td>
                                </tr>
                                <tr>
                                    <th>رابط المقطع</th>
                                    <td>
                                        <video width="100%" controls>
                                            <source src="{{ Storage::url($video->video_path) }}" type="video/mp4">
                                            متصفحك لا يدعم عرض الفيديو.
                                        </video>
                                    </td>
                                </tr>
                                <tr>
                                    <th>النوع</th>
                                    <td>{{ $video->type_name }}</td>
                                </tr>
                                <tr>
                                    <th>المشاهدات</th>
                                    <td>{{ number_format($video->views) }}</td>
                                </tr>
                                <tr>
                                    <th>الحالة</th>
                                    <td>{{ $video->status_name }}</td>
                                </tr>
                                <tr>
                                    <th>مجاني؟</th>
                                    <td>{{ $video->is_free ? 'نعم' : 'لا' }}</td>
                                </tr>
                                <tr>
                                    <th>الترتيب</th>
                                    <td>{{ $video->order }}</td>
                                </tr>
                                <tr>
                                    <th>تاريخ الإنشاء</th>
                                    <td>{{ $video->created_at->format('Y-m-d H:i') }}</td>
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
