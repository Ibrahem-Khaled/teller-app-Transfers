<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>شهادة تدريبية</title>
    <!-- روابط CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }

        .certificate-container {
            background-image: url('https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.pinimg.com%2Foriginals%2F15%2Fc6%2F68%2F15c668707f4060912522d323741d47d2.jpg&f=1&nofb=1&ipt=e26a2c769d687a0e72aca5ed0ff2a695e5b95111a2792ad10dd2486b8f8ac35a&ipo=images');
            background-size: cover;
            background-position: center;
            border-radius: 15px;
            padding: 30px;
            max-width: 800px;
            margin: 50px auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .certificate-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #d9534f;
        }

        .certificate-body {
            text-align: center;
            margin: 20px 0;
        }

        .certificate-body p {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .certificate-footer {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }

        .signature {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            margin-top: 30px;
        }

        .signature img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
        }

        .signature .text {
            font-size: 1.2rem;
            color: #d9534f;
            font-weight: 700;
        }

        .save-button {
            display: block;
            margin: 20px auto 0;
            text-align: center;
        }

        .btn-save {
            background-color: #d9534f;
            color: #fff;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-save:hover {
            background-color: #c9302c;
        }
    </style>
</head>

<body>
    @include('components.header')
    <div class="certificate-container">
        <!-- العنوان -->
        <div class="certificate-header">
            <h1>شهادة تدريبية</h1>
        </div>

        <!-- المحتوى -->
        <div class="certificate-body">
            <p>تشهد منصة تيلير</p>
            <p>لـ <strong>{{ auth()->user()->name }}</strong></p>
            <p>أنه قد حصل على دورة تدريبية من منصة تيلير</p>
            <p>بعنوان <strong>[تيلير]</strong></p>
        </div>

        <!-- التوقيع -->
        <div class="signature">
            <img src="{{ asset('assets/img/logo-ct.png') }}" alt="Logo">
            <span class="text">منصة تيلير</span>
        </div>

        <!-- الحقوق -->
        <div class="certificate-footer">
            <p>جميع الحقوق محفوظة © 2024</p>
        </div>
    </div>

    <!-- زر الحفظ -->
    <div class="save-button">
        <a href="#" class="btn-save">حفظ كملف PDF</a>
    </div>

    @include('components.footer')

    <!-- مكتبة Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
