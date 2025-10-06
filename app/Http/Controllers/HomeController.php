<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
public function index()
{
    $user = Auth::user();
    
    $totalIncome = $user->transactions()
        ->where('type', 'income')
        ->sum('amount');
        
    $totalExpenses = $user->transactions()
        ->where('type', 'expense')
        ->sum('amount');
        
    $totalBalance = $totalIncome - $totalExpenses;
    
    $recentTransactions = $user->transactions()
        ->orderBy('date', 'desc')
        ->take(5)
        ->get();

    return view('home', compact(
        'totalIncome',
        'totalExpenses',
        'totalBalance',
        'recentTransactions',
        'user'
    ));
}
}