<?php

if (!function_exists('format_currency')) {
    function format_currency($amount, $currency = null) {
        $user = auth()->user();
        $currency = $currency ?: ($user->currency ?? 'USD');
        
        $symbols = [
            'USD' => '$', 'EUR' => '€', 'GBP' => '£', 'JPY' => '¥',
            'CAD' => 'C$', 'AUD' => 'A$', 'INR' => '₹', 'CNY' => '¥',
            'PHP' => '₱', 'PKR' => '₨', 'BDT' => '৳', 'LKR' => 'Rs',
            'NPR' => 'Rs', 'MVR' => 'Rf', 'BTN' => 'Nu', 'MYR' => 'RM',
            'SGD' => 'S$', 'IDR' => 'Rp', 'THB' => '฿', 'VND' => '₫',
            'KRW' => '₩'
        ];
        
        $symbol = $symbols[$currency] ?? $currency;
        
        return $symbol . number_format($amount, 2);
    }
}