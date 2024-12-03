<?php

namespace App\Http\Controllers;

use App\Models\TellerTransfer;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch statistics
        $totalUsers = User::count();
        $totalTransfers = TellerTransfer::count();
        $completedTransfers = TellerTransfer::where('status', 1)->count();
        $pendingTransfers = TellerTransfer::where('status', 0)->count();

        // Fetch recent transfers
        $recentTransfers = TellerTransfer::with(['sender', 'receiver'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalUsers',
            'totalTransfers',
            'completedTransfers',
            'pendingTransfers',
            'recentTransfers'
        ));
    }
}
