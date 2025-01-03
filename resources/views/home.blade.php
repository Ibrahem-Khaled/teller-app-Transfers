<!DOCTYPE html>
<html lang="ar">

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
        }

        .video-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 30px auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
        }

        .video-container iframe {
            width: 100%;
            height: 450px;
            border: none;
        }

        .course-details {
            max-width: 800px;
            margin: 40px auto;
            text-align: right;
        }

        h1 {
            font-size: 2rem;
            color: #4a2f85;
            margin-bottom: 15px;
            text-align: right;

        }

        p {
            font-size: 1.1rem;
            color: #555;
        }

        .start-course-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #4a2f85;
            color: #fff;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 1.2rem;
            text-decoration: none;
            transition: all 0.3s ease;
            max-width: 250px;
            margin: 20px auto;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .start-course-btn img {
            width: 25px;
            margin-left: 10px;
        }

        .start-course-btn:hover {
            background-color: #3a2370;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        }

        .note {
            color: #d9534f;
            font-size: 1rem;
            text-align: right;
            margin-top: 10px;
        }

        @media (max-width: 768px) {
            .video-container iframe {
                height: 300px;
            }

            .course-details h1 {
                font-size: 1.8rem;
            }

            .course-details p {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .video-container iframe {
                height: 200px;
            }

            .course-details h1 {
                font-size: 1.5rem;
            }

            .course-details p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    @include('components.header')
    @include('components.slider')

    <!-- قسم معلومات الدورة -->
    <div class="course-details">
        @include('components.alert')
        <h1>دورة تعلم التيلر</h1>
        <p>دورة شاملة لتعلم التيلر وكيفية استخدامها بشكل احترافي. للحصول على شهادة إتمام الدورة، يجب اجتياز الثلاث مراحل
            بنجاح في الدول التالية: الهند، بنغلاديش، وسريلانكا.</p>
        <p class="note">ملاحظة: يجب مشاهدة الفيديو قبل البدء بالدورة.</p>
        <!-- زر بدء الدورة -->
        <a href="{{ route('fullCourse') }}" class="start-course-btn w-50">
            <img src="{{ asset('assets/img/logo-ct.png') }}" alt="Start Icon">
            ابدأ الدورة الآن
        </a>
    </div>

    <!-- قسم الفيديو -->
    <h1 class="text-center mt-5 mb-3">فيديو تعلم التيلر</h1>
    <div class="video-container">
        <iframe src="https://www.youtube.com/embed/syg4mdPPmlM?si=alGk6crzKFhkTdVE" title="YouTube video player"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
        </iframe>
    </div>

    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
