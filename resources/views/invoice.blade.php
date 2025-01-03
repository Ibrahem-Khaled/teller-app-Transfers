<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('components.seo')

    <!-- روابط CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            text-align: right;
        }

        .invoice-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-header h1 {
            font-size: 2rem;
            color: #4a2f85;
        }

        .invoice-header p {
            font-size: 1rem;
            color: #666;
        }

        .invoice-table {
            margin-top: 20px;
        }

        .invoice-table th {
            background-color: #4a2f85;
            color: #fff;
        }

        .invoice-footer {
            text-align: center;
            margin-top: 30px;
        }

        .invoice-footer p {
            font-size: 0.9rem;
            color: #999;
        }
    </style>
</head>

<body>
    @include('components.header')
    <div class="container">
        <div class="invoice-container">
            <div class="invoice-header">
                <h1>فاتورة</h1>
                <p>تفاصيل الفاتورة الخاصة بالمعاملة</p>
            </div>
            <table class="table table-bordered invoice-table">
                <tbody>
                    <tr>
                        <th>رقم الفاتورة</th>
                        <td>{{ $invoice->invoice_number }}</td>
                    </tr>
                    <tr>
                        <th>اسم المرسل</th>
                        <td>{{ $invoice->sender->name ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>رقم هاتف المرسل</th>
                        <td>{{ $invoice->sender->phone ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>اسم المستلم</th>
                        <td>{{ $invoice->receiver->name ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>رقم هاتف المستلم</th>
                        <td>{{ $invoice->receiver->phone ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>الدولة</th>
                        <td>{{ $invoice->country ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>المبلغ</th>
                        <td>{{ $invoice->amount }}</td>
                    </tr>
                    <tr>
                        <th>نوع العملية</th>
                        <td>{{ $invoice->type === 'send' ? 'إرسال' : 'استلام' }}</td>
                    </tr>
                    <tr>
                        <th>طريقة الدفع</th>
                        <td>{{ $invoice->paid === 'cash' ? 'نقدًا' : 'بنك' }}</td>
                    </tr>
                    <tr>
                        <th>الحالة</th>
                        <td>{{ $invoice->status ? 'مكتملة' : 'غير مكتملة' }}</td>
                    </tr>
                    <tr>
                        <th>IBAN</th>
                        <td>{{ $invoice->iban ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>SWIFT</th>
                        <td>{{ $invoice->swift ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>اسم البنك</th>
                        <td>{{ $invoice->bank_name ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>مدينة البنك</th>
                        <td>{{ $invoice->bank_city ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>IFSC</th>
                        <td>{{ $invoice->ifsc ?? 'غير متوفر' }}</td>
                    </tr>
                    <tr>
                        <th>Routing Number</th>
                        <td>{{ $invoice->routeing_number ?? 'غير متوفر' }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="invoice-footer">
                <p>جميع الحقوق محفوظة © {{ date('Y') }}</p>
            </div>
        </div>
    </div>

    @include('components.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
