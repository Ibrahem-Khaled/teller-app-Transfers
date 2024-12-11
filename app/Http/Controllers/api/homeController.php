<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AppNotification;
use App\Models\Slider;
use App\Models\TellerTransfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function getingSliders()
    {
        $sliders = Slider::all();

        if ($sliders->count() == 0) {
            return response()->json(['message' => 'No sliders found'], 404);
        }

        $sliders = $sliders->map(function ($slider) {
            $slider->image = url('storage/' . $slider->image);
            return $slider;
        });

        return response()->json($sliders, 200);
    }


    public function getingNotification()
    {
        $notifications = AppNotification::all();

        if ($notifications->count() == 0) {
            return response()->json(['message' => 'No notifications found'], 404);
        }

        $notifications = $notifications->map(function ($notification) {
            $notification->image = url('storage/' . $notification->image);
            return $notification;
        });

        return response()->json($notifications, 200);
    }

    public function searchTellerTransaction(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'invoice_number' => 'required|numeric',
            'reciver_name' => 'required|string',
            'reciver_phone' => 'required|string',
        ]);

        // جلب البيانات من الطلب
        $invoice = $request->invoice_number;
        $reciverName = $request->reciver_name;
        $reciverPhone = $request->reciver_phone;

        // البحث عن المستلم
        $reciver = User::where('name', 'like', '%' . $reciverName . '%')
            ->where('phone', $reciverPhone)
            ->first();

        // التحقق إذا كان المستلم موجودًا
        if (!$reciver) {
            return response()->json(['message' => 'Receiver not found'], 404);
        }

        // البحث عن المعاملة
        $tellerTransaction = $reciver->tellerTransactions()
            ->where('invoice_number', $invoice)
            ->with('sender', 'receiver')
            ->first();

        // التحقق من وجود المعاملة
        if (!$tellerTransaction || $reciver->id !== $tellerTransaction->receiver_id) {
            return response()->json(['message' => 'No transaction found'], 404);
        }

        // إذا كانت البيانات صحيحة
        return response()->json([
            'message' => 'Transaction found',
            'data' => $tellerTransaction,
        ], 200);
    }

    public function addTellerTransaction(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:15',
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:15',
            'amount' => 'required|numeric|min:0',
            'country' => 'nullable|string',
            'type' => 'required|in:send,receive',
            'paid' => 'required|in:cash,bank',
            'iban' => 'nullable|string',
            'swift' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'bank_city' => 'nullable|string',
            'ifsc' => 'nullable|string',
            'routeing_number' => 'nullable|string',
        ]);

        $invoiceNumber = time() . random_int(1000, 9999);

        // Handle sender
        $sender = User::firstOrCreate(
            ['phone' => $validated['sender_phone']],
            ['name' => $validated['sender_name']]
        );

        // Handle receiver
        $receiver = User::firstOrCreate(
            ['phone' => $validated['receiver_phone']],
            ['name' => $validated['receiver_name']]
        );

        // Create transfer
        $tellerTransaction = TellerTransfer::create([
            'invoice_number' => $invoiceNumber,
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'employee_id' => Auth::guard('api')->user()->id,
            'amount' => $validated['amount'],
            'country' => $validated['country'],
            'type' => $validated['type'],
            'paid' => $validated['paid'],
            'iban' => $validated['iban'],
            'swift' => $validated['swift'],
            'bank_name' => $validated['bank_name'],
            'bank_city' => $validated['bank_city'],
            'ifsc' => $validated['ifsc'],
            'routeing_number' => $validated['routeing_number'],
        ]);

        $tellerTransaction->load('sender', 'receiver');

        // إرجاع استجابة JSON مع بيانات المعاملة
        return response()->json([
            'message' => 'Teller transaction created successfully',
            'data' => $tellerTransaction
        ], 201);
    }


}
