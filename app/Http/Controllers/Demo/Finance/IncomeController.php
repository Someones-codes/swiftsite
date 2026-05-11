<?php
// app/Http/Controllers/Demo/Finance/IncomeController.php

namespace App\Http\Controllers\Demo\Finance;

use App\Http\Controllers\Controller;
use App\Models\Demo\Finance\FinanceIncome;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'source'        => 'required|string|max:100',
            'amount'        => 'required|numeric|min:0.01|max:999999',
            'received_date' => 'required|date',
            'notes'         => 'nullable|string|max:500',
        ]);

        $validated['demo_session_id'] = session('demo_session_id');

        FinanceIncome::create($validated);

        return redirect()->route('demo.finance.index')
            ->with('success', 'Income added!');
    }

    public function destroy($id)
    {
        $sessionId = session('demo_session_id');

        // SECURITY: Only delete if it belongs to this session
        FinanceIncome::where('id', $id)
            ->where('demo_session_id', $sessionId)
            ->delete();

        return redirect()->route('demo.finance.index')
            ->with('success', 'Income entry removed.');
    }
}