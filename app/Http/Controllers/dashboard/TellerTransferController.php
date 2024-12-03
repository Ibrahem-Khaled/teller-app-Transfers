<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\TellerTransfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TellerTransferController extends Controller
{
    public function index()
    {
        $transfers = TellerTransfer::with(['sender', 'receiver', 'employee'])->get();
        return view('dashboard.teller-transfers', compact('transfers'));
    }

    public function store(Request $request)
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
            'status' => 'boolean',
            'iban' => 'nullable|string',
            'swift' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'bank_city' => 'nullable|string',
            'ifsc' => 'nullable|string',
            'routeing_number' => 'nullable|string',
        ]);

        $invoiceNumber = 'INV-' . strtoupper(uniqid());

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
        TellerTransfer::create([
            'invoice_number' => $invoiceNumber, // Generated invoice number
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'employee_id' => Auth::id(), // Employee from logged-in user
            'amount' => $validated['amount'],
            'country' => $validated['country'],
            'type' => $validated['type'],
            'paid' => $validated['paid'],
            'status' => $validated['status'],
            'iban' => $validated['iban'],
            'swift' => $validated['swift'],
            'bank_name' => $validated['bank_name'],
            'bank_city' => $validated['bank_city'],
            'ifsc' => $validated['ifsc'],
            'routeing_number' => $validated['routeing_number'],
        ]);

        return redirect()->back()->with('success', 'Transfer added successfully');
    }

    public function update(Request $request, TellerTransfer $transfer)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|unique:teller_transfers,invoice_number,' . $transfer->id,
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:15',
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:15',
            'amount' => 'required|numeric|min:0',
            'country' => 'nullable|string',
            'type' => 'required|in:send,receive',
            'paid' => 'required|in:cash,bank',
            'status' => 'boolean',
            'iban' => 'nullable|string',
            'swift' => 'nullable|string',
            'bank_name' => 'nullable|string',
            'bank_city' => 'nullable|string',
            'ifsc' => 'nullable|string',
            'routeing_number' => 'nullable|string',
        ]);

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

        // Update transfer
        $transfer->update([
            'invoice_number' => $validated['invoice_number'],
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'employee_id' => Auth::id(),
            'amount' => $validated['amount'],
            'country' => $validated['country'],
            'type' => $validated['type'],
            'paid' => $validated['paid'],
            'status' => $validated['status'],
            'iban' => $validated['iban'],
            'swift' => $validated['swift'],
            'bank_name' => $validated['bank_name'],
            'bank_city' => $validated['bank_city'],
            'ifsc' => $validated['ifsc'],
            'routeing_number' => $validated['routeing_number'],
        ]);

        return redirect()->back()->with('success', 'Transfer updated successfully');
    }

    public function destroy(TellerTransfer $transfer)
    {
        $transfer->delete();
        return redirect()->back()->with('success', 'Transfer deleted successfully');
    }


}
