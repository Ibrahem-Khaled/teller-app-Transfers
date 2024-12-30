<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>دورة تيللير التدريبية</title>
    <!-- روابط CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            text-align: right;
        }

        .modal-header {
            background-color: #4a2f85;
            color: #fff;
        }

        .btn-primary {
            background-color: #4a2f85;
            border: none;
        }

        .btn-primary:hover {
            background-color: #3a2370;
        }
    </style>
</head>

<body>
    @include('components.header')
    <div class="container mt-5">
        <h1 class="text-center mb-4">اختيار نوع العملية</h1>
        <div class="d-flex justify-content-center">
            <!-- اختيار نوع العملية -->
            <select id="operationType" class="form-select w-50 mb-3" onchange="handleOperationChange()">
                <option value="" disabled selected>اختر نوع العملية</option>
                <option value="receive">استلام</option>
                <option value="send">ارسال</option>
            </select>
        </div>
    </div>

    @include('components.forms.receive_form')


    @include('components.forms.send_form')

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/logic.js') }}"></script>
</body>

</html>
