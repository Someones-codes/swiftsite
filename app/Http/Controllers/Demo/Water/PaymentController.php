<?php
// app/Http/Controllers/Demo/Water/PaymentController.php

namespace App\Http\Controllers\Demo\Water;

use App\Http\Controllers\Controller;
use App\Models\Demo\Water\WaterPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'water_customer_id' => 'required|integer',
            'amount_paid'       => 'required|numeric|min:0.01',
            'payment_date'      => 'required|date',
            'notes'             => 'nullable|string|max:500',
        ]);

        $validated['demo_session_id'] = session('demo_session_id');
        $validated['status'] = 'partial';

        WaterPayment::create($validated);

        return redirect()->route('demo.water.index')
            ->with('success', 'Payment recorded!');
    }

    public function markComplete($id)
    {
        $sessionId = session('demo_session_id');

        WaterPayment::where('id', $id)
            ->where('demo_session_id', $sessionId)
            ->update(['status' => 'complete']);

        return redirect()->route('demo.water.index')
            ->with('success', 'Payment marked as complete.');
    }
}