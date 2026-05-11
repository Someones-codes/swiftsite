<?php

namespace App\Http\Controllers\Demo\Water;
 
use App\Http\Controllers\Controller;
use App\Models\Demo\Water\WaterCustomer;
use Illuminate\Http\Request;
 
class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'phone'          => 'nullable|string|max:20',
            'area'           => 'nullable|string|max:100',
            'drums_ordered'  => 'required|integer|min:1|max:9999',
            'price_per_drum' => 'required|numeric|min:0.01|max:99999',
        ]);
 
        $validated['demo_session_id'] = session('demo_session_id');
 
        WaterCustomer::create($validated);
 
        return redirect()->route('demo.water.index')
            ->with('success', $validated['name'] . ' added!');
    }
 
    public function destroy($id)
    {
        WaterCustomer::where('id', $id)
            ->where('demo_session_id', session('demo_session_id'))
            ->delete();
 
        return redirect()->route('demo.water.index')
            ->with('success', 'Customer removed.');
    }
}