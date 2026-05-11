<?php
// app/Http/Controllers/Demo/Finance/FinanceDashboardController.php

namespace App\Http\Controllers\Demo\Finance;

use App\Http\Controllers\Controller;
use App\Models\Demo\Finance\FinanceIncome;
use App\Models\Demo\Finance\FinanceExpense;

class FinanceDashboardController extends Controller
{
    public function index()
    {
        $sessionId = session('demo_session_id');

        $incomes  = FinanceIncome::where('demo_session_id', $sessionId)
            ->latest()->get();

        $expenses = FinanceExpense::where('demo_session_id', $sessionId)
            ->latest()->get();

        $totalIncome  = $incomes->sum('amount');
        $totalExpenses = $expenses->sum('amount');
        $balance = $totalIncome - $totalExpenses;

        return view('demo.finance.index', compact(
            'incomes', 'expenses', 'totalIncome', 'totalExpenses', 'balance'
        ));
    }
}