<?php
// app/Http/Controllers/Demo/Water/WaterDashboardController.php

namespace App\Http\Controllers\Demo\Water;

use App\Http\Controllers\Controller;
use App\Models\Demo\Water\WaterCustomer;
use App\Models\Demo\Water\WaterPayment;

class WaterDashboardController extends Controller
{
    public function index()
    {
        $sessionId = session('demo_session_id');

        $customers = WaterCustomer::where('demo_session_id', $sessionId)
            ->with(['payments' => function($q) use ($sessionId) {
                $q->where('demo_session_id', $sessionId);
            }])
            ->latest()
            ->get();

        // Calculate outstanding per customer
        $customers->each(function ($customer) {
            $totalOwed  = $customer->drums_ordered * $customer->price_per_drum;
            $totalPaid  = $customer->payments->sum('amount_paid');
            $customer->outstanding = $totalOwed - $totalPaid;
        });

        $totalOutstanding = $customers->sum('outstanding');

        return view('demo.water.index', compact('customers', 'totalOutstanding'));
    }
}