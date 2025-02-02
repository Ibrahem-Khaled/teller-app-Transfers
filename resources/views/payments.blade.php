<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خيارات الدفع</title>
    @include('components.seo')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        h1 {
            color: #4a2f85;
        }

        .description {
            text-align: center;
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #555;
        }

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4a2f85;
            margin-bottom: 20px;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .payment-option {
            background: linear-gradient(135deg, #ffffff, #f2f2f2);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .payment-option:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .payment-option h3 {
            font-size: 1.5rem;
            color: #4a2f85;
        }

        .payment-option p {
            color: #666;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #4a2f85;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #3a2370;
        }

        .btn-whatsapp {
            background-color: #25d366;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            color: #fff;
        }

        .btn-whatsapp:hover {
            background-color: #128c7e;
        }

        .form-control {
            border: 2px solid #ddd;
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: #4a2f85;
            box-shadow: 0 0 8px rgba(74, 47, 133, 0.5);
        }
    </style>
</head>

<body>
    @include('components.header')

    <div class="container mt-5">
        @include('components.alert')

        <h1 class="text-center mb-4">خيارات الدفع</h1>
        <p class="description">
            اختر الطريقة الأنسب لك لإتمام عملية الدفع، ثم قم برفع الوصل الخاص بالدفع. نحن هنا لتسهيل تجربتك.
        </p>
        <p class="text-center price">سعر الدورة: 25 دينار أردني</p>

        <div class="payment-grid">
            <!-- خيار زين كاش -->
            <div class="payment-option">
                <h3>زين كاش</h3>
                <p>رقم الهاتف: <strong>0780411276</strong></p>
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="method" value="zaincash">
                    <div class="mb-3">
                        <label for="receipt-zain" class="form-label">رفع الوصل</label>
                        <input disabled type="file" name="receipt" id="receipt-zain" class="form-control" required>
                    </div>
                    <button disabled type="submit" class="btn btn-primary w-100">ادفع الآن</button>
                </form>
            </div>

            <!-- خيار البنك العربي الإسلامي -->
            <div class="payment-option">
                <h3>البنك العربي الإسلامي الدولي (كليك)</h3>
                <p>رقم الحساب: <strong>00962780411276</strong></p>
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="method" value="click">
                    <div class="mb-3">
                        <label for="receipt-click" class="form-label">رفع الوصل</label>
                        <input disabled type="file" name="receipt" id="receipt-click" class="form-control" required>
                    </div>
                    <button disabled type="submit" class="btn btn-primary w-100">ادفع الآن</button>
                </form>
            </div>

            <!-- خيار واتساب -->
            <div class="payment-option">
                <h3>توثيق الدفع عبر واتساب</h3>
                <p>قم بإرسال صورة الوصل عبر واتساب لتوثيق الدفع.</p>
                <a href="https://wa.me/962780411276?text=%D9%85%D8%B1%D8%AD%D8%A8%D8%A7%D9%8B%20%D8%A7%D9%84%D8%B3%D9%8A%D8%AF%20%D8%A7%D9%84%D9%85%D8%AD%D8%AA%D8%B1%D9%85%D8%8C%20%D8%A3%D8%B1%D9%8A%D8%AF%20%D9%85%D8%B9%D9%84%D9%88%D9%85%D8%A7%D8%AA%20%D9%85%D9%88%D8%AB%D9%82%D8%A9%20%D8%AD%D9%88%D9%84%20%D8%AE%D8%AF%D9%85%D8%A7%D8%AA%D9%83%D9%85%20%D8%A7%D9%84%D9%85%D8%AD%D8%AA%D8%B1%D9%81%D8%A9."
                    target="_blank" class="btn btn-success w-100">
                    <i class="fab fa-whatsapp"></i> تواصل معنا عبر واتساب
                </a>

            </div>
        </div>
    </div>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
