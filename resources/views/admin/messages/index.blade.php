@extends('layouts.admin')
@section('title', 'Messages')

@section('content')

<div class="page-header">
    <div>
        <h1>Messages</h1>
        <p>Contact form submissions from potential clients.</p>
    </div>
    @php $unread = $messages->where('is_read', false)->count(); @endphp
    @if($unread > 0)
    <div style="background:var(--red);color:white;padding:8px 18px;border-radius:8px;font-size:14px;font-weight:700;">
        {{ $unread }} Unread
    </div>
    @endif
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>From</th>
                    <th>Subject / Preview</th>
                    <th>Phone</th>
                    <th>Source</th>
                    <th>Received</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr style="{{ !$msg->is_read ? 'background:#fafbff;' : '' }}">
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--navy2),var(--red));display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:14px;flex-shrink:0;">
                                {{ substr($msg->name, 0, 1) }}
                            </div>
                            <div>
                                <div style="font-weight:{{ !$msg->is_read ? '700' : '500' }};font-size:14px;color:var(--dark);">{{ $msg->name }}</div>
                                <div style="font-size:12px;color:var(--gray);">{{ $msg->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-size:13px;font-weight:{{ !$msg->is_read ? '600' : '400' }};color:var(--dark);">
                            {{ $msg->subject ?: '(No subject)' }}
                        </div>
                        <div style="font-size:12px;color:var(--gray);">{{ Str::limit($msg->message, 60) }}</div>
                    </td>
                    <td style="font-size:13px;color:var(--gray);">{{ $msg->phone ?: '—' }}</td>
                    <td>
                        @if(str_contains(strtolower($msg->subject ?? ''), 'demo'))
                        <span class="badge badge-success">From Demo</span>
                        @else
                        <span class="badge" style="background:var(--light);color:var(--gray);">Direct</span>
                        @endif
                    </td>
                    <td style="font-size:12px;color:var(--gray);white-space:nowrap;">
                        {{ $msg->created_at->format('d M Y') }}<br>
                        {{ $msg->created_at->format('H:i') }}
                    </td>
                    <td>
                        @if($msg->is_read)
                        <span class="badge badge-success">Read</span>
                        @else
                        <span class="badge badge-warning">Unread</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:8px;">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-outline btn-sm">👁 Read</a>
                            <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST"
                                  onsubmit="return confirm('Delete this message?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:56px;color:var(--gray);">
                        <div style="font-size:48px;margin-bottom:14px;">📭</div>
                        <p>No messages yet. Share your portfolio link to start getting leads!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border);">
        {{ $messages->links() }}
    </div>
    @endif
</div>

@endsection