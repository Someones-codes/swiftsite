<?php

namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Message;
 
class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }
 
    public function show(Message $message)
    {
        // Mark as read when opened
        if (!$message->is_read) {
            $message->update(['is_read' => true, 'read_at' => now()]);
        }
        return view('admin.messages.show', compact('message'));
    }
 
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted.');
    }
}
 
