<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('components.seo')


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            text-align: right;
        }
    </style>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{ asset('assets/img/logo-ct.png') }}" style="width: 185px;"
                                            alt="الشعار">
                                        {{-- <h4 class="mt-1 mb-5 pb-1">إنشاء حساب جديد</h4> --}}
                                    </div>

                                    @if (session('error'))
                                        <div class="alert alert-danger text-center">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('customRegister') }}">
                                        @csrf

                                        <p>يرجى ملء البيانات لإنشاء حساب جديد</p>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" name="name" id="formName" class="form-control"
                                                placeholder="أدخل اسمك الكامل" required />
                                            <label class="form-label" for="formName">الاسم الكامل</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" name="email" id="formEmail" class="form-control"
                                                placeholder="أدخل بريدك الإلكتروني" required />
                                            <label class="form-label" for="formEmail">البريد الإلكتروني</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" name="phone" id="formPhone" class="form-control"
                                                placeholder="أدخل رقم هاتفك" required />
                                            <label class="form-label" for="formPhone">رقم الهاتف</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="text" name="address" id="formAddress" class="form-control"
                                                placeholder="أدخل عنوانك" required />
                                            <label class="form-label" for="formAddress">العنوان</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password" id="formPassword"
                                                class="form-control" placeholder="أدخل كلمة المرور" required />
                                            <label class="form-label" for="formPassword">كلمة المرور</label>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" name="password_confirmation"
                                                id="formPasswordConfirmation" class="form-control"
                                                placeholder="أعد إدخال كلمة المرور" required />
                                            <label class="form-label" for="formPasswordConfirmation">تأكيد كلمة
                                                المرور</label>
                                        </div>
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                style="background-color: #4a2f85" type="submit">إنشاء حساب</button>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">لديك حساب بالفعل؟</p>
                                            <a href="{{ route('login') }}" class="btn btn-outline-danger">تسجيل
                                                الدخول</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2"
                                style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/Others/images/76.jpg'); 
                                background-size: cover; background-position: center;">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">نحن هنا لمساعدتك</h4>
                                    <p class="small mb-0">إذا كنت تواجه أي مشاكل، يرجى التواصل معنا وسنقوم بمساعدتك بكل
                                        سرور.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>
