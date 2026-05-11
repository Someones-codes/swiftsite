<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:2000',
            'phone'   => 'nullable|string|max:20',
        ]);

        // Save to database
        Message::create($validated);

        // Return with success message
        return redirect()->route('contact')
            ->with('success', 'Your message has been sent! I\'ll get back to you soon.');
    }
}