@extends('layouts.admin')
@section('title', 'Message from ' . $message->name)

@section('content')

<div class="page-header">
    <div>
        <h1>Message from {{ $message->name }}</h1>
        <p>Received {{ $message->created_at->format('d M Y \a\t H:i') }}</p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-outline">← All Messages</a>
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
              onsubmit="return confirm('Delete this message permanently?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger">🗑 Delete</button>
        </form>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:24px;align-items:start;">

    {{-- MESSAGE CONTENT --}}
    <div class="card">
        <div class="card-header">
            <h2>💬 Message</h2>
            @if($message->subject)
            <span style="font-size:14px;color:var(--gray);">Re: {{ $message->subject }}</span>
            @endif
        </div>
        <div class="card-body">
            <div style="font-size:15px;line-height:1.8;color:var(--dark);white-space:pre-wrap;background:var(--light);border-radius:10px;padding:20px;border:1px solid var(--border);">{{ $message->message }}</div>
        </div>
    </div>

    {{-- SENDER INFO + REPLY --}}
    <div style="display:flex;flex-direction:column;gap:16px;">
        <div class="card">
            <div class="card-header"><h2>👤 Sender Details</h2></div>
            <div class="card-body">
                <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid var(--border);">
                    <div style="width:52px;height:52px;border-radius:50%;background:linear-gradient(135deg,var(--navy2),var(--red));display:flex;align-items:center;justify-content:center;color:white;font-weight:800;font-size:20px;flex-shrink:0;">
                        {{ substr($message->name, 0, 1) }}
                    </div>
                    <div>
                        <div style="font-size:16px;font-weight:700;color:var(--navy);">{{ $message->name }}</div>
                        <div style="font-size:13px;color:var(--gray);">Potential Client</div>
                    </div>
                </div>

                <div style="display:flex;flex-direction:column;gap:12px;">
                    <div style="display:flex;gap:10px;align-items:flex-start;">
                        <span style="font-size:16px;width:24px;flex-shrink:0;">📧</span>
                        <div>
                            <div style="font-size:11px;color:var(--gray);font-weight:600;text-transform:uppercase;letter-spacing:1px;">Email</div>
                            <a href="mailto:{{ $message->email }}" style="font-size:14px;color:var(--navy2);font-weight:600;">{{ $message->email }}</a>
                        </div>
                    </div>
                    @if($message->phone)
                    <div style="display:flex;gap:10px;align-items:flex-start;">
                        <span style="font-size:16px;width:24px;flex-shrink:0;">📞</span>
                        <div>
                            <div style="font-size:11px;color:var(--gray);font-weight:600;text-transform:uppercase;letter-spacing:1px;">Phone</div>
                            <a href="tel:{{ $message->phone }}" style="font-size:14px;color:var(--navy2);font-weight:600;">{{ $message->phone }}</a>
                        </div>
                    </div>
                    @endif
                    @if($message->subject)
                    <div style="display:flex;gap:10px;align-items:flex-start;">
                        <span style="font-size:16px;width:24px;flex-shrink:0;">📌</span>
                        <div>
                            <div style="font-size:11px;color:var(--gray);font-weight:600;text-transform:uppercase;letter-spacing:1px;">Subject</div>
                            <div style="font-size:14px;color:var(--dark);">{{ $message->subject }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2>⚡ Reply</h2></div>
            <div class="card-body">
                <p style="font-size:14px;color:var(--gray);margin-bottom:16px;">Click below to reply via your email client:</p>
                <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject ?? 'Your enquiry') }}&body=Hi {{ urlencode($message->name) }},%0A%0AThank you for reaching out to SwiftSite Designs.%0A%0A"
                   class="btn btn-primary" style="width:100%;justify-content:center;">
                    📧 Reply via Email
                </a>
                @if($message->phone)
                <a href="tel:{{ $message->phone }}" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:10px;">
                    📞 Call {{ $message->name }}
                </a>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection