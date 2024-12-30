function handleOperationChange() {
    const operationType = document.getElementById('operationType').value;
    if (operationType === 'receive') {
        const receiveModal = new bootstrap.Modal(document.getElementById('receiveModal'));
        receiveModal.show();
    } else if (operationType === 'send') {
        alert('تم اختيار عملية الارسال.');
    }
}

async function submitReceiveForm() {
    const transferNumber = document.getElementById('transferNumber').value;
    const recipientName = document.getElementById('recipientName').value;
    const phoneNumber = document.getElementById('phoneNumber').value;

    // إرسال البيانات إلى الباك
    try {
        const response = await fetch('/api/teller-transactions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                invoice_number: transferNumber,
                reciver_name: recipientName,
                reciver_phone: phoneNumber,
            }),
        });

        // معالجة الاستجابة
        const data = await response.json();

        if (response.ok) {
            // إذا نجح الطلب
            // alert('تم العثور على الحوالة: ' + data.message);
            window.location.href = `/invoice/${data.data.id}`;
        } else {
            // إذا كان هناك خطأ
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.style.display = 'block';
            errorMessage.textContent = data.message || 'حدث خطأ أثناء التحقق من البيانات.';
        }
    } catch (error) {
        console.error('Error:', error);
        const errorMessage = document.getElementById('errorMessage');
        errorMessage.style.display = 'block';
        errorMessage.textContent = 'حدث خطأ غير متوقع. حاول مرة أخرى.';
    }
}

function handleOperationChange() {
    const operationType = document.getElementById('operationType').value;
    if (operationType === 'receive') {
        const receiveModal = new bootstrap.Modal(document.getElementById('receiveModal'));
        receiveModal.show();
    } else if (operationType === 'send') {
        const sendModal = new bootstrap.Modal(document.getElementById('sendModal'));
        sendModal.show();
    }
}

function toggleBankFields() {
    const paidType = document.getElementById('paid').value;
    const bankFields = document.getElementById('bankFields');
    if (paidType === 'bank') {
        bankFields.style.display = 'block';
    } else {
        bankFields.style.display = 'none';
    }
}

async function submitSendForm() {
    const senderName = document.getElementById('senderName').value;
    const senderPhone = document.getElementById('senderPhone').value;
    const receiverName = document.getElementById('receiverName').value;
    const receiverPhone = document.getElementById('receiverPhone').value;
    const employeeId = document.getElementById('employee_id').value;
    const amount = document.getElementById('amount').value;
    const country = document.getElementById('country').value;
    const type = document.getElementById('type').value;
    const paid = document.getElementById('paid').value;

    // الحقول البنكية
    const iban = document.getElementById('iban')?.value || null;
    const swift = document.getElementById('swift')?.value || null;
    const bankName = document.getElementById('bankName')?.value || null;
    const bankCity = document.getElementById('bankCity')?.value || null;
    const ifsc = document.getElementById('ifsc')?.value || null;
    const routingNumber = document.getElementById('routingNumber')?.value || null;

    // إعداد الجسم الذي سيتم إرساله
    const requestBody = {
        sender_name: senderName,
        sender_phone: senderPhone,
        receiver_name: receiverName,
        receiver_phone: receiverPhone,
        employee_id: employeeId,
        amount: amount,
        country: country,
        type: type,
        paid: paid,

        // الحقول البنكية
        iban: iban,
        swift: swift,
        bank_name: bankName,
        bank_city: bankCity,
        ifsc: ifsc,
        routeing_number: routingNumber,
    };

    try {
        const response = await axios.post('/api/add-teller-transaction', requestBody, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        // التحقق من نجاح العملية
        if (response.status === 201) {
            // alert('تمت عملية الإرسال بنجاح!');
            console.log(response.data);
            window.location.href = `/invoice/${response.data.data.id}`;

            document.getElementById('sendForm').reset();
            document.getElementById('bankFields').style.display = 'none'; // إخفاء الحقول البنكية
        }
    } catch (error) {
        if (error.response) {
            // عرض الأخطاء القادمة من الباك-إند
            const errorMessage = error.response.data.message || 'حدث خطأ أثناء إرسال البيانات.';
            document.getElementById('errorMessageSend').style.display = 'block';
            document.getElementById('errorMessageSend').textContent = errorMessage;
        } else {
            // أخطاء غير متوقعة
            document.getElementById('errorMessageSend').style.display = 'block';
            document.getElementById('errorMessageSend').textContent = 'حدث خطأ غير متوقع.';
        }
        console.error('Error:', error);
    }
}