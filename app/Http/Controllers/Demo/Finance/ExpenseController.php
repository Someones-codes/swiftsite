<?php

namespace App\Http\Controllers\Demo\Finance;

use App\Http\Controllers\Controller;
use App\Models\Demo\Finance\FinanceExpense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category'     => 'required|string|max:50',
            'description'  => 'required|string|max:200',
            'amount'       => 'required|numeric|min:0.01|max:999999',
            'expense_date' => 'required|date',
            'notes'        => 'nullable|string|max:500',
        ]);

        $validated['demo_session_id'] = session('demo_session_id');

        FinanceExpense::create($validated);

        return redirect()->route('demo.finance.index')
            ->with('success', 'Expense added successfully!');
    }

    public function destroy($id)
    {
        FinanceExpense::where('id', $id)
            ->where('demo_session_id', session('demo_session_id'))
            ->delete();

        return redirect()->route('demo.finance.index')
            ->with('success', 'Expense removed.');
    }
}