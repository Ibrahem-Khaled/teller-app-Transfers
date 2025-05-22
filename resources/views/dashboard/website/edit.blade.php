@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-0 text-gray-800">إعدادات حساب الموقع</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.dashboard') }}">لوحة التحكم</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">حساب الموقع</li>
                    </ol>
                </nav>
            </div>
        </div>

        @include('components.alerts')

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">تعديل بيانات حساب الموقع</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('website.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $websiteUser->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $websiteUser->email) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">رقم الهاتف</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $websiteUser->phone) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">العنوان</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address', $websiteUser->address) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">كلمة المرور الجديدة</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <small class="text-muted">اتركه فارغاً إذا كنت لا تريد تغيير كلمة المرور</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-danger text-white">
                <h6 class="m-0 font-weight-bold">منطقة الخطر</h6>
            </div>
            <div class="card-body">
                <p class="text-danger">هذه المنطقة تحتوي على إجراءات لا يمكن التراجع عنها. كن حذراً عند استخدامها.</p>

                <form action="{{ route('website.reset') }}" method="POST"
                    onsubmit="return confirm('هل أنت متأكد أنك تريد إعادة تعيين حساب الموقع إلى الإعدادات الافتراضية؟ هذا الإجراء لا يمكن التراجع عنه.');">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-redo"></i> إعادة تعيين إلى الإعدادات الافتراضية
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
