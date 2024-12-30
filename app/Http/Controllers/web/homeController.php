<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\TellerTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {
        $slides = Slider::all();
        return view('home', compact('slides'));
    }

    public function certificate()
    {
        $user = Auth::user();

        $countries = $user->showEmployeeTellers()->pluck('country')->toArray();
        $requiredCountries = ['India', 'Bangladesh', 'Sri Lanka'];
        $hasAllCountries = !array_diff($requiredCountries, $countries);

        if ($hasAllCountries) {
            return view('certificate');
        }

        return redirect()->route('home')->with('error', 'يرجى تقديم التحويلات للدول التالية: ' . implode(', ', $requiredCountries));
    }

    public function fullCourse()
    {
        $countriesPath = public_path('countries.json');
        $countries = json_decode(file_get_contents($countriesPath));
        return view('full_course', compact('countries'));
    }

    public function invoice($invoiceId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول أولاً.');
        }
        $invoice = TellerTransfer::where('id', $invoiceId)->latest()->first();

        if (!$invoice) {
            return redirect()->back()->with('error', 'لا توجد فواتير متاحة.');
        }

        return view('invoice', compact('invoice'));
    }

}
