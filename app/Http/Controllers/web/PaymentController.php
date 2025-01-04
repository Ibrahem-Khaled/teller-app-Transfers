<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function index()
    {
        return view('payments');

    }
    public function processPayment(Request $request)
    {
        try {
            // التحقق من صحة البيانات المدخلة
            $validatedData = $request->validate([
                'method' => 'required|string',
                'receipt' => 'required|mimes:jpg,jpeg,png,pdf|max:2048', // فقط الصور و PDF بحجم أقل من 2 ميجابايت
            ], [
                'method.required' => 'يرجى اختيار طريقة الدفع.',
                'receipt.required' => 'يرجى رفع الوصل.',
                'receipt.mimes' => 'يجب أن يكون الوصل بصيغة jpg, jpeg, png, أو pdf.',
                'receipt.max' => 'حجم الملف يجب ألا يتجاوز 2 ميجابايت.',
            ]);

            // رفع الوصل إلى التخزين
            $receiptPath = $request->file('receipt')->store('receipts', 'public');

            // تسجيل العملية في قاعدة البيانات
            Payment::create([
                'user_id' => auth()->id(),
                'method' => $validatedData['method'],
                'receipt_path' => $receiptPath,
            ]);

            // تحديث حالة المستخدم
            $user = auth()->user();
            $user->update(['status' => 1]);

            // إعادة التوجيه مع رسالة نجاح
            return redirect()->back()->with('success', 'تمت عملية الدفع بنجاح وتم رفع الوصل.');
        } catch (\Exception $e) {
            // التعامل مع أي خطأ محتمل
            return redirect()->back()->with('error', 'حدث خطأ أثناء معالجة الدفع. يرجى المحاولة مرة أخرى.');
        }
    }

}
