@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid mt-5">
        <h2 class="mb-4">Dashboard</h2>

        <!-- Row for Statistics -->
        <div class="row">
            <!-- Total Users -->
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h4 class="card-title">Total Users</h4>
                        <h2 class="card-text">{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>

            <!-- Total Transfers -->
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h4 class="card-title">Total Transfers</h4>
                        <h2 class="card-text">{{ $totalTransfers }}</h2>
                    </div>
                </div>
            </div>

            <!-- Completed Transfers -->
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h4 class="card-title">Completed Transfers</h4>
                        <h2 class="card-text">{{ $completedTransfers }}</h2>
                    </div>
                </div>
            </div>

            <!-- Pending Transfers -->
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h4 class="card-title">Pending Transfers</h4>
                        <h2 class="card-text">{{ $pendingTransfers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transfers -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Transfers</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentTransfers as $transfer)
                                    <tr>
                                        <td>{{ $transfer->invoice_number }}</td>
                                        <td>{{ $transfer->sender->name ?? 'N/A' }}</td>
                                        <td>{{ $transfer->receiver->name ?? 'N/A' }}</td>
                                        <td>{{ $transfer->amount }}</td>
                                        <td>{{ $transfer->status ? 'Completed' : 'Pending' }}</td>
                                        <td>{{ $transfer->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
