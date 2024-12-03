<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-ct.png') }}">

    <title>استعادة كلمة المرور</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #072D38;
            color: white;
        }

        .reset-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .reset-card {
            background-color: #035971;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
        }

        .reset-card h3 {
            color: #F48140;
            font-weight: bold;
        }

        .form-control {
            border-radius: 10px;
            background-color: #055160;
            color: white;
            border: 1px solid #F48140;
        }

        .form-control::placeholder {
            color: #ddd;
        }

        .form-control:focus {
            background-color: #055160;
            color: white;
            border: 1px solid #F48140;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #F48140;
            border: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #ffb68b;
        }

        .reset-footer {
            text-align: center;
            margin-top: 15px;
        }

        .reset-footer a {
            text-decoration: none;
            color: #F48140;
        }

        .reset-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @include('homeComponents.header')

    <div class="reset-container">
        <div class="reset-card">
            <h3 class="text-center mb-4">استعادة كلمة المرور</h3>
            <form  method="POST">
                @csrf
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" id="email"
                        placeholder="أدخل بريدك الإلكتروني" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">إرسال رابط الاستعادة</button>
                </div>
            </form>
            <!-- Login Redirect -->
            <div class="reset-footer mt-3">
                <p>تذكرت كلمة المرور؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
            </div>
        </div>
    </div>

    @include('homeComponents.footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
