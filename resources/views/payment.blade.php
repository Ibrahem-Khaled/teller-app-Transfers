<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام عملية الدفع</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #6d28d9;
            --primary-light: #8b5cf6;
            --primary-dark: #4c1d95;
            --zain: #00AEEF;
            --cliq: #00A651;
            --paypal: #003087;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f9fafb;
        }

        .gradient-text {
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
        }

        .card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 0.75rem;
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(109, 40, 217, 0.3);
        }

        .payment-method {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }

        .payment-method:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .payment-method.selected {
            border-color: var(--primary);
            background-color: #f5f3ff;
        }

        .payment-method.zain.selected {
            border-color: var(--zain);
            background-color: #e6f7ff;
        }

        .payment-method.cliq.selected {
            border-color: var(--cliq);
            background-color: #e8f5e9;
        }

        .payment-method.paypal.selected {
            border-color: var(--paypal);
            background-color: #e0e8f7;
        }

        .input-field {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .input-field:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }

        .checkbox:checked {
            background-color: var(--primary);
        }

        .progress-step {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: #e5e7eb;
            color: #6b7280;
            font-weight: bold;
        }

        .progress-step.active {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }

        .progress-step.completed {
            background-color: #10b981;
            color: white;
        }

        .progress-line {
            height: 0.25rem;
            background-color: #e5e7eb;
            flex: 1;
        }

        .progress-line.active {
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }

        .progress-line.completed {
            background-color: #10b981;
        }

        .coupon-input {
            transition: all 0.3s ease;
        }

        .coupon-input:focus-within {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }

        .payment-form {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .payment-form.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .receipt-upload {
            border: 2px dashed #e5e7eb;
            transition: all 0.3s ease;
        }

        .receipt-upload:hover {
            border-color: var(--primary-light);
            background-color: #f9f5ff;
        }

        @media (max-width: 768px) {
            .payment-methods {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    @include('components.web.header')

    <!-- Progress Bar -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <div class="flex items-center">
                        <div class="progress-step completed">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="progress-line completed"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="progress-step active">
                            2
                        </div>
                        <div class="progress-line"></div>
                    </div>
                    <div class="flex items-center">
                        <div class="progress-step">
                            3
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="flex space-x-6 rtl:space-x-reverse text-sm">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <div class="w-2 h-2 rounded-full bg-purple-600"></div>
                            <span class="font-bold">الدفع</span>
                        </div>
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                            <span>التأكيد</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="py-8">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">إتمام عملية الدفع</h1>
            <p class="text-gray-600 mb-8">الخطوة 2 من 3 - اختر طريقة الدفع المناسبة</p>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Main Content -->
                <div class="lg:w-2/3 space-y-6">
                    <!-- Payment Methods -->
                    <div class="card bg-white p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-money-bill-wave ml-2 rtl:ml-0 rtl:mr-2"></i>
                            اختر طريقة الدفع
                        </h2>

                        <div class="payment-methods grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <!-- Zain Cash -->
                            <div class="payment-method zain rounded-lg p-4 cursor-pointer selected" data-method="zain">
                                <div class="flex items-center justify-center mb-3">
                                    <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ffirmware.gem-flash.com%2Fgateways%2Fy06_zaincash%2Fzaincash.png&f=1&nofb=1&ipt=47188f52345687f1dd814d5bf865a65ccfdf3748c4b7569b7c92960914ce1c49" alt="Zain Cash"
                                        class="h-10">
                                </div>
                                <div class="flex items-center justify-center">
                                    <div
                                        class="w-6 h-6 rounded-full border-2 border-purple-600 flex items-center justify-center mr-3 rtl:mr-0 rtl:ml-3">
                                        <div class="w-3 h-3 rounded-full bg-purple-600"></div>
                                    </div>
                                    <h3 class="font-medium text-center">Zain Cash</h3>
                                </div>
                            </div>

                            <!-- CLIQ -->
                            <div class="payment-method cliq rounded-lg p-4 cursor-pointer" data-method="cliq">
                                <div class="flex items-center justify-center mb-3">
                                    <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.pay-tv-portal.de%2Fwp-content%2Fuploads%2F2023%2F12%2Fcliq-logo-gross.jpg&f=1&nofb=1&ipt=e7e943ea5f2b440865ceb2075f4ccc93bfda2f4cbedc9966248d860bf3e0b11c"
                                        alt="CLIQ" class="h-10">
                                </div>
                                <div class="flex items-center justify-center">
                                    <div
                                        class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center mr-3 rtl:mr-0 rtl:ml-3">
                                    </div>
                                    <h3 class="font-medium text-center">CLIQ</h3>
                                </div>
                            </div>

                            <!-- PayPal -->
                            <div class="payment-method paypal rounded-lg p-4 cursor-pointer" data-method="paypal">
                                <div class="flex items-center justify-center mb-3">
                                    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg"
                                        alt="PayPal" class="h-10">
                                </div>
                                <div class="flex items-center justify-center">
                                    <div
                                        class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center mr-3 rtl:mr-0 rtl:ml-3">
                                    </div>
                                    <h3 class="font-medium text-center">PayPal</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Zain Cash Form -->
                        <div id="zain-form" class="payment-form active">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ffirmware.gem-flash.com%2Fgateways%2Fy06_zaincash%2Fzaincash.png&f=1&nofb=1&ipt=47188f52345687f1dd814d5bf865a65ccfdf3748c4b7569b7c92960914ce1c49" alt="Zain Cash"
                                    class="h-6 ml-2 rtl:ml-0 rtl:mr-2">
                                معلومات الدفع عبر Zain Cash
                            </h3>

                            <form class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">رقم هاتف Zain Cash</label>
                                    <input type="tel" class="input-field w-full px-4 py-3 rounded-lg"
                                        placeholder="07XXXXXXXX" pattern="07[0-9]{8}">
                                    <p class="text-sm text-gray-500 mt-1">يجب أن يبدأ الرقم بـ 07 ويتكون من 10 أرقام</p>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">اسم صاحب الحساب</label>
                                    <input type="text" class="input-field w-full px-4 py-3 rounded-lg"
                                        placeholder="كما هو مسجل في Zain Cash">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">إرفاق صورة إيصال الدفع</label>
                                    <div class="receipt-upload rounded-lg p-6 text-center cursor-pointer">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600">اسحب وأسقط ملف الإيصال هنا أو انقر للاختيار</p>
                                        <p class="text-sm text-gray-500 mt-2">الصيغ المقبولة: JPG, PNG, PDF (الحجم
                                            الأقصى 5MB)</p>
                                        <input type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="zain-terms"
                                        class="checkbox rounded border-gray-300 text-purple-600 focus:ring-purple-500"
                                        required>
                                    <label for="zain-terms" class="mr-2 rtl:mr-0 rtl:ml-2 text-gray-700">أوافق على <a
                                            href="#" class="text-purple-600 hover:underline">شروط وأحكام</a>
                                        Zain Cash</label>
                                </div>
                            </form>
                        </div>

                        <!-- CLIQ Form -->
                        <div id="cliq-form" class="payment-form">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.pay-tv-portal.de%2Fwp-content%2Fuploads%2F2023%2F12%2Fcliq-logo-gross.jpg&f=1&nofb=1&ipt=e7e943ea5f2b440865ceb2075f4ccc93bfda2f4cbedc9966248d860bf3e0b11c"
                                    alt="CLIQ" class="h-6 ml-2 rtl:ml-0 rtl:mr-2">
                                معلومات الدفع عبر CLIQ
                            </h3>

                            <form class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">رقم CLIQ</label>
                                    <input type="tel" class="input-field w-full px-4 py-3 rounded-lg"
                                        placeholder="ادخل رقم CLIQ الخاص بك">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">اسم صاحب الحساب</label>
                                    <input type="text" class="input-field w-full px-4 py-3 rounded-lg"
                                        placeholder="كما هو مسجل في CLIQ">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">إرفاق صورة إيصال الدفع</label>
                                    <div class="receipt-upload rounded-lg p-6 text-center cursor-pointer">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600">اسحب وأسقط ملف الإيصال هنا أو انقر للاختيار</p>
                                        <p class="text-sm text-gray-500 mt-2">الصيغ المقبولة: JPG, PNG, PDF (الحجم
                                            الأقصى 5MB)</p>
                                        <input type="file" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="cliq-terms"
                                        class="checkbox rounded border-gray-300 text-purple-600 focus:ring-purple-500"
                                        required>
                                    <label for="cliq-terms" class="mr-2 rtl:mr-0 rtl:ml-2 text-gray-700">أوافق على <a
                                            href="#" class="text-purple-600 hover:underline">شروط وأحكام</a>
                                        CLIQ</label>
                                </div>
                            </form>
                        </div>

                        <!-- PayPal Form -->
                        <div id="paypal-form" class="payment-form">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg"
                                    alt="PayPal" class="h-6 ml-2 rtl:ml-0 rtl:mr-2">
                                معلومات الدفع عبر PayPal
                            </h3>

                            <form class="space-y-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">البريد الإلكتروني لـ PayPal</label>
                                    <input type="email" class="input-field w-full px-4 py-3 rounded-lg"
                                        placeholder="example@example.com">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">اسم صاحب الحساب</label>
                                    <input type="text" class="input-field w-full px-4 py-3 rounded-lg"
                                        placeholder="كما هو مسجل في PayPal">
                                </div>

                                <div class="flex items-center">
                                    <input type="checkbox" id="paypal-terms"
                                        class="checkbox rounded border-gray-300 text-purple-600 focus:ring-purple-500"
                                        required>
                                    <label for="paypal-terms" class="mr-2 rtl:mr-0 rtl:ml-2 text-gray-700">أوافق على
                                        <a href="#" class="text-purple-600 hover:underline">شروط وأحكام</a>
                                        PayPal</label>
                                </div>

                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <p class="text-blue-800 flex items-center">
                                        <i class="fas fa-info-circle ml-2 rtl:ml-0 rtl:mr-2"></i>
                                        سيتم توجيهك إلى موقع PayPal لإتمام عملية الدفع بأمان
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex flex-col md:flex-row justify-between gap-4">
                        <a href="{{ back()->getTargetUrl() }}"
                            class="btn bg-gray-200 text-gray-800 hover:bg-gray-300 py-3 px-6 rounded-lg font-medium text-center transition">
                            <i class="fas fa-arrow-right ml-2 rtl:ml-0 rtl:mr-2"></i> العودة
                        </a>
                        <button class="btn-primary py-3 px-6 rounded-lg font-medium">
                            تأكيد الدفع <i class="fas fa-arrow-left ml-2 rtl:ml-0 rtl:mr-2"></i>
                        </button>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:w-1/3 space-y-6">
                    <div class="card bg-white p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-shield-alt ml-2 rtl:ml-0 rtl:mr-2"></i>
                            الدفع الآمن
                        </h2>
                        <p class="text-gray-600 mb-4">جميع عمليات الدفع محمية ومعالجة بشكل آمن.</p>
                        <div class="flex space-x-4 rtl:space-x-reverse">
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwhatismyipaddress.com%2Fwp-content%2Fuploads%2Fssl-image-1024x731.jpg&f=1&nofb=1&ipt=453a70d88fbab02b42ff297ad63219f5de357ac57350c2f6dad9ec4c87a7f712" alt="SSL Secure" class="h-10">
                        </div>
                    </div>

                    <div class="card bg-white p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-question-circle ml-2 rtl:ml-0 rtl:mr-2"></i>
                            تحتاج مساعدة؟
                        </h2>
                        <p class="text-gray-600 mb-4">لديك أي استفسارات أو تحتاج مساعدة في إتمام عملية الدفع؟</p>
                        <button
                            class="btn bg-gray-100 text-gray-800 hover:bg-gray-200 w-full py-2 rounded-lg font-medium transition">
                            <i class="fas fa-headset ml-2 rtl:ml-0 rtl:mr-2"></i> تواصل مع الدعم الفني
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.web.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Payment method selection
            const paymentMethods = document.querySelectorAll('.payment-method');
            const paymentForms = document.querySelectorAll('.payment-form');

            paymentMethods.forEach(method => {
                method.addEventListener('click', function() {
                    // Remove selected class from all methods
                    paymentMethods.forEach(m => {
                        m.classList.remove('selected', 'zain', 'cliq', 'paypal');
                        const methodType = m.dataset.method;
                        m.querySelector('div div').classList.remove('bg-purple-600');
                        m.querySelector('div div').classList.add('border-gray-300');
                    });

                    // Add selected class to clicked method
                    const methodType = this.dataset.method;
                    this.classList.add('selected', methodType);
                    this.querySelector('div div').classList.remove('border-gray-300');
                    this.querySelector('div div').classList.add('border-purple-600',
                        'bg-purple-600');

                    // Hide all forms
                    paymentForms.forEach(form => form.classList.remove('active'));

                    // Show selected form
                    document.getElementById(`${methodType}-form`).classList.add('active');
                });
            });

            // File upload interaction
            const receiptUploads = document.querySelectorAll('.receipt-upload');
            receiptUploads.forEach(upload => {
                const fileInput = upload.querySelector('input[type="file"]');

                upload.addEventListener('click', function() {
                    fileInput.click();
                });

                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const fileName = this.files[0].name;
                        upload.innerHTML = `
                            <i class="fas fa-check-circle text-green-500 text-3xl mb-2"></i>
                            <p class="text-gray-900 font-medium">${fileName}</p>
                            <p class="text-sm text-gray-500 mt-1">تم اختيار الملف بنجاح</p>
                            <button class="text-purple-600 text-sm mt-2 hover:underline">تغيير الملف</button>
                        `;
                    }
                });
            });
        });
    </script>
</body>

</html>
