<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currencies = [
            'USD' => 'US Dollar ($)',
            'EUR' => 'Euro (€)',
            'GBP' => 'British Pound (£)',
            'JPY' => 'Japanese Yen (¥)',
            'CAD' => 'Canadian Dollar (C$)',
            'AUD' => 'Australian Dollar (A$)',
            'INR' => 'Indian Rupee (₹)',
            'CNY' => 'Chinese Yuan (¥)',
            'PHP' => 'Philippine Peso (₱)',
            'PKR' => 'Pakistani Rupee (₨)',
            'BDT' => 'Bangladeshi Taka (৳)',
            'LKR' => 'Sri Lankan Rupee (Rs)',
            'NPR' => 'Nepalese Rupee (Rs)',
            'MVR' => 'Maldivian Rufiyaa (Rf)',
            'BTN' => 'Bhutanese Ngultrum (Nu)',
            'MYR' => 'Malaysian Ringgit (RM)',
            'SGD' => 'Singapore Dollar (S$)',
            'IDR' => 'Indonesian Rupiah (Rp)',
            'THB' => 'Thai Baht (฿)',
            'VND' => 'Vietnamese Dong (₫)',
            'KRW' => 'South Korean Won (₩)',
        ];

        return view('settings.index', compact('user', 'currencies'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'currency' => 'required|string|size:3',
        ]);

        $user = Auth::user();
        $user->update([
            'currency' => $request->currency
        ]);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
    }
}