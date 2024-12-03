@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Manage Teller Transfers</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Button to trigger Add Modal -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#transferModal">Add Transfer</button>

        <!-- Transfers Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Sender Name</th>
                    <th>Sender Phone</th>
                    <th>Receiver Name</th>
                    <th>Receiver Phone</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transfers as $transfer)
                    <tr>
                        <td>{{ $transfer->invoice_number }}</td>
                        <td>{{ $transfer->sender->name ?? 'N/A' }}</td>
                        <td>{{ $transfer->sender->phone ?? 'N/A' }}</td>
                        <td>{{ $transfer->receiver->name ?? 'N/A' }}</td>
                        <td>{{ $transfer->receiver->phone ?? 'N/A' }}</td>
                        <td>{{ $transfer->amount }}</td>
                        <td>{{ ucfirst($transfer->type) }}</td>
                        <td>{{ ucfirst($transfer->paid) }}</td>
                        <td>{{ $transfer->status ? 'Completed' : 'Pending' }}</td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-warning btn-sm editTransfer" data-id="{{ $transfer->id }}"
                                data-invoice="{{ $transfer->invoice_number }}"
                                data-sender-name="{{ $transfer->sender->name ?? '' }}"
                                data-sender-phone="{{ $transfer->sender->phone ?? '' }}"
                                data-receiver-name="{{ $transfer->receiver->name ?? '' }}"
                                data-receiver-phone="{{ $transfer->receiver->phone ?? '' }}"
                                data-amount="{{ $transfer->amount }}" data-type="{{ $transfer->type }}"
                                data-paid="{{ $transfer->paid }}" data-bs-toggle="modal" data-bs-target="#transferModal">
                                Edit
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('transfers.destroy', $transfer->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="transferForm" method="POST" action="{{ route('teller-transfers.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="transferModalLabel">Add Transfer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="transferId" name="id">

                        {{-- <!-- Invoice Number -->
                        <div class="form-group mb-3">
                            <label for="invoice_number">Invoice Number</label>
                            <input type="number" class="form-control" id="invoice_number" name="invoice_number" required>
                        </div> --}}

                        <!-- Sender Information -->
                        <div class="form-group mb-3">
                            <label for="sender_name">Sender Name</label>
                            <input type="text" class="form-control" id="sender_name" name="sender_name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="sender_phone">Sender Phone</label>
                            <input type="text" class="form-control" id="sender_phone" name="sender_phone" required>
                        </div>

                        <!-- Receiver Information -->
                        <div class="form-group mb-3">
                            <label for="receiver_name">Receiver Name</label>
                            <input type="text" class="form-control" id="receiver_name" name="receiver_name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="receiver_phone">Receiver Phone</label>
                            <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" required>
                        </div>

                        <!-- Amount -->
                        <div class="form-group mb-3">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>

                        <!-- Country -->
                        <div class="form-group mb-3">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country">
                        </div>

                        <!-- Type -->
                        <div class="form-group mb-3">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="send">Send</option>
                                <option value="receive">Receive</option>
                            </select>
                        </div>

                        <!-- Paid -->
                        <div class="form-group mb-3">
                            <label for="paid">Payment Method</label>
                            <select class="form-control" id="paid" name="paid" required>
                                <option value="cash">Cash</option>
                                <option value="bank">Bank</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="0">Pending</option>
                                <option value="1">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.editTransfer').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('invoice_number').value = this.dataset.invoice;
                document.getElementById('sender_name').value = this.dataset.senderName;
                document.getElementById('sender_phone').value = this.dataset.senderPhone;
                document.getElementById('receiver_name').value = this.dataset.receiverName;
                document.getElementById('receiver_phone').value = this.dataset.receiverPhone;
                document.getElementById('amount').value = this.dataset.amount;
                document.getElementById('type').value = this.dataset.type;
                document.getElementById('paid').value = this.dataset.paid;
            });
        });
    </script>
@endsection
