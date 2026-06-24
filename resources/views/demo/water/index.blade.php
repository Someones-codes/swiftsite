@extends('layouts.demo')

@section('title', 'Water Drum Tracker')
@section('demo-icon', '💧')
@section('demo-name', 'Water Drum Tracker')

@section('demo-nav')
    <li><a href="{{ route('demo.water.index') }}" class="active">Dashboard</a></li>
    <li><a href="{{ route('demos') }}">← All Demos</a></li>
@endsection

@push('styles')
<style>
    /* ============================================
       DEMO APPS — SHARED STYLES (inlined)
       Finance Tracker / Water Tracker / Family Blog
       Cloud Sky (#CBDDE9) + Ocean Blue (#2872A1)
       ============================================ */

    :root {
        --sky: #CBDDE9;
        --ocean: #2872A1;
        --ocean-dark: #1e5a8e;
        --dark: #1a3a52;
        --light: #f8fbfd;
        --gray: #6b7280;
        --border: #e2e8f0;
        --green: #059669;
        --red: #c62828;
        --radius: 12px;
        --teal: #00695c;
        --teal-light: #e0f2f1;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        overflow-x: hidden;
    }

    /* ============================================
       NAVBAR — links back to portfolio home
       ============================================ */
    .demo-back-nav {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: #ffffff;
        border-bottom: 1px solid var(--border);
        padding: 0 5%;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 2px 10px rgba(40, 114, 161, 0.08);
    }

    .demo-back-link {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--ocean);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .demo-back-link:hover {
        color: var(--dark);
    }

    .demo-back-link svg {
        flex-shrink: 0;
    }

    .demo-app-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        color: var(--dark);
        font-size: 0.95rem;
    }

    .demo-live-badge {
        background: var(--ocean);
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* ============================================
       FLASH MESSAGES
       ============================================ */
    .demo-flash {
        padding: 12px 5%;
        font-size: 0.9rem;
        font-weight: 500;
        text-align: center;
    }

    .demo-flash.success { background: #ecfdf5; color: #065f46; }
    .demo-flash.error   { background: #fef2f2; color: #991b1b; }

    /* ============================================
       PAGE WRAPPER
       ============================================ */
    .demo-page-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 24px 5% 80px;
        width: 100%;
    }

    .demo-page-header {
        margin-bottom: 20px;
    }

    .demo-page-header h1 {
        font-size: clamp(1.4rem, 4vw, 1.8rem);
        color: var(--dark);
        margin: 0 0 6px;
        font-weight: 800;
    }

    .demo-page-header p {
        font-size: 0.9rem;
        color: var(--gray);
        margin: 0;
    }

    .reset-notice {
        background: var(--sky);
        border: 1px solid #b5cfe0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.8rem;
        color: var(--dark);
        margin-bottom: 20px;
        word-break: break-word;
    }

    /* ============================================
       STAT CARDS
       ============================================ */
    .stat-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 14px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        padding: 18px;
    }

    .stat-card .label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray);
    }

    .stat-card .value {
        font-size: 1.5rem;
        font-weight: 800;
        margin-top: 4px;
        word-break: break-word;
    }

    .stat-card.income .value  { color: var(--green); }
    .stat-card.expense .value { color: var(--red); }
    .stat-card.balance .value { color: var(--ocean); }

    /* ============================================
       CARDS
       ============================================ */
    .card {
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .card-header {
        padding: 14px 18px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 6px;
    }

    .card-header h2 {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
    }

    .card-body {
        padding: 18px;
    }

    /* ============================================
       FORMS
       ============================================ */
    .form-group {
        margin-bottom: 14px;
    }

    .form-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.9rem;
        color: var(--dark);
        background: white;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--ocean);
        box-shadow: 0 0 0 3px rgba(40, 114, 161, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 70px;
    }

    /* ============================================
       BUTTONS
       ============================================ */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 18px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        font-family: inherit;
        transition: all 0.2s;
    }

    .btn-primary { background: var(--ocean); color: white; }
    .btn-primary:hover { background: var(--ocean-dark); }

    .btn-success { background: var(--green); color: white; }
    .btn-success:hover { background: #047857; }

    .btn-danger { background: var(--red); color: white; }
    .btn-danger:hover { background: #a31f1f; }

    .btn-sm { padding: 6px 12px; font-size: 0.75rem; }
    .btn-full { width: 100%; }

    /* ============================================
       BADGES
       ============================================ */
    .badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-pending  { background: #fef3c7; color: #92400e; }
    .badge-partial  { background: #dbeafe; color: #1e40af; }
    .badge-complete { background: #d1fae5; color: #065f46; }

    /* ============================================
       AMOUNTS
       ============================================ */
    .amount-positive { color: var(--green); }
    .amount-negative { color: var(--red); }

    /* ============================================
       GENERIC RESPONSIVE GRID HELPERS
       ============================================ */
    .finance-grid,
    .water-grid,
    .blog-layout {
        display: grid;
        gap: 20px;
    }

    .finance-grid     { grid-template-columns: 1fr 1.5fr; }
    .water-grid       { grid-template-columns: 1.2fr 2fr; }
    .blog-layout      { grid-template-columns: 2fr 1fr; align-items: start; }

    /* ============================================
       EMPTY STATES
       ============================================ */
    .empty-tx,
    .no-customers,
    .no-posts {
        text-align: center;
        padding: 40px 16px;
        color: var(--gray);
    }

    .empty-tx .e-icon,
    .no-customers .icon,
    .no-posts .icon {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    /* ============================================
       RESPONSIVE — TABLET (≤ 900px)
       ============================================ */
    @media (max-width: 900px) {
        .finance-grid,
        .water-grid,
        .blog-layout {
            grid-template-columns: 1fr;
        }

        .write-post-card {
            position: static;
        }
    }

    /* ============================================
       RESPONSIVE — MOBILE (≤ 768px)
       ============================================ */
    @media (max-width: 768px) {
        .demo-back-nav {
            padding: 0 16px;
            height: 56px;
        }

        .demo-back-link span.label-text {
            display: none;
        }

        .demo-app-title span.app-name-text {
            display: none;
        }

        .demo-page-wrap {
            padding: 18px 16px 60px;
        }

        .stat-cards {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .stat-card {
            padding: 14px;
        }

        .stat-card .value {
            font-size: 1.2rem;
        }

        .card-body {
            padding: 14px;
        }

        .reset-notice {
            font-size: 0.75rem;
        }

        .tab-bar {
            overflow-x: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .tab-bar::-webkit-scrollbar {
            display: none;
        }

        .tab-btn {
            flex-shrink: 0;
        }

        .add-payment-form {
            grid-template-columns: 1fr !important;
        }

        .post-article-header,
        .post-article-body,
        .post-actions-bar,
        .comments-header,
        .comment-item,
        .add-comment-form {
            padding-left: 18px !important;
            padding-right: 18px !important;
        }

        .post-article-title {
            font-size: 1.4rem !important;
        }
    }

    /* ============================================
       RESPONSIVE — SMALL MOBILE (≤ 420px)
       ============================================ */
    @media (max-width: 420px) {
        .stat-cards {
            grid-template-columns: 1fr;
        }

        .demo-page-header h1 {
            font-size: 1.25rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* ============================================
       PAGE-SPECIFIC STYLES (Water Drum Tracker)
       ============================================ */
    .customer-card {
        background:white; border-radius:12px; border:1px solid var(--border);
        margin-bottom:16px; overflow:hidden; transition:box-shadow 0.2s;
    }
    .customer-card:hover { box-shadow:0 4px 16px rgba(0,105,92,0.1); }

    .customer-header {
        display:flex; align-items:center; justify-content:space-between;
        padding:14px 18px; border-bottom:1px solid var(--border);
        background:var(--light); cursor:pointer;
    }

    .customer-name {
        font-size:15px; font-weight:700; color:var(--navy);
        display:flex; align-items:center; gap:8px;
    }

    .customer-meta { font-size:12px; color:var(--gray); }

    .customer-body { padding:16px 18px; }

    .payment-row {
        display:flex; align-items:center; gap:10px;
        padding:8px 0; border-bottom:1px solid var(--border);
        font-size:13px;
    }
    .payment-row:last-child { border-bottom:none; }

    .payment-status { flex-shrink:0; }

    .add-payment-form {
        display:grid; grid-template-columns:1fr 1fr auto;
        gap:8px; align-items:end; margin-top:12px;
        padding-top:12px; border-top:1px solid var(--border);
    }

    .outstanding-bar {
        height:6px; border-radius:10px; background:var(--border);
        overflow:hidden; margin-top:8px;
    }
    .outstanding-fill {
        height:100%; border-radius:10px;
        background:linear-gradient(90deg,var(--teal),#4db6ac);
    }

    .balance-summary {
        background:linear-gradient(135deg,var(--teal),#00897b);
        border-radius:12px; padding:20px; color:white; margin-bottom:20px;
    }

    .balance-summary .label { font-size:12px; opacity:0.75; margin-bottom:4px; }
    .balance-summary .value { font-family:'Sora',sans-serif; font-size:32px; font-weight:800; }

    .no-customers {
        text-align: center; padding: 48px 20px; color: var(--gray);
    }
    .no-customers .icon { font-size: 48px; margin-bottom: 12px; }
</style>
@endpush

@section('content')

<div class="demo-page-header">
    <h1>💧 Water Drum Tracker</h1>
    <p>Add customers, record drum orders, track payments and outstanding balances.</p>
</div>

<div class="reset-notice">
    ⏱ Demo data resets every 30 minutes. Try adding a customer and recording a payment.
</div>

{{-- TOTAL OUTSTANDING --}}
<div class="balance-summary">
    <div class="label">💰 Total Outstanding Balance</div>
    <div class="value">R {{ number_format($totalOutstanding, 2) }}</div>
    <div style="font-size:13px;opacity:0.75;margin-top:6px;">
        Across {{ $customers->count() }} {{ Str::plural('customer', $customers->count()) }}
    </div>
</div>

<div class="water-grid">

    {{-- LEFT: ADD CUSTOMER FORM --}}
    <div>
        <div class="card">
            <div class="card-header"><h2>👤 Add Customer</h2></div>
            <div class="card-body">
                <form action="{{ route('demo.water.customers.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Thabo Dlamini" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="082 123 4567">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Area / Location</label>
                        <input type="text" name="area" class="form-control" placeholder="e.g. Howick, Hilton">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div class="form-group">
                            <label class="form-label">Drums Ordered</label>
                            <input type="number" name="drums_ordered" class="form-control"
                                   min="1" value="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Price / Drum (R)</label>
                            <input type="number" name="price_per_drum" class="form-control"
                                   step="0.01" min="0.01" value="250.00" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-full" style="background:#00695c;color:white;">
                        + Add Customer
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- RIGHT: CUSTOMER LIST --}}
    <div>
        @forelse($customers as $customer)
        @php
            $totalOwed = $customer->drums_ordered * $customer->price_per_drum;
            $totalPaid = $customer->payments->sum('amount_paid');
            $outstanding = $totalOwed - $totalPaid;
            $paidPct = $totalOwed > 0 ? min(($totalPaid / $totalOwed) * 100, 100) : 0;
        @endphp
        <div class="customer-card">
            <div class="customer-header" onclick="toggleCustomer({{ $customer->id }})">
                <div>
                    <div class="customer-name">
                        💧 {{ $customer->name }}
                        @if($outstanding <= 0)
                            <span class="badge badge-complete">✓ Paid</span>
                        @elseif($totalPaid > 0)
                            <span class="badge badge-partial">Partial</span>
                        @else
                            <span class="badge badge-pending">Unpaid</span>
                        @endif
                    </div>
                    <div class="customer-meta">
                        {{ $customer->drums_ordered }} drum{{ $customer->drums_ordered > 1 ? 's' : '' }}
                        @ R{{ number_format($customer->price_per_drum, 2) }} each
                        @if($customer->area) · {{ $customer->area }} @endif
                        @if($customer->phone) · {{ $customer->phone }} @endif
                    </div>
                    <div class="outstanding-bar" style="width:200px;">
                        <div class="outstanding-fill" style="width:{{ $paidPct }}%;"></div>
                    </div>
                </div>
                <div style="text-align:right;flex-shrink:0;">
                    <div style="font-size:12px;color:var(--gray);">Outstanding</div>
                    <div style="font-size:18px;font-weight:800;color:{{ $outstanding > 0 ? 'var(--red)' : '#059669' }};">
                        R {{ number_format(max($outstanding, 0), 2) }}
                    </div>
                    <div style="font-size:11px;color:var(--gray);">of R {{ number_format($totalOwed, 2) }}</div>
                </div>
            </div>

            <div class="customer-body" id="cust-{{ $customer->id }}">

                {{-- Payment History --}}
                @if($customer->payments->isNotEmpty())
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--gray);margin-bottom:8px;">Payment History</div>
                @foreach($customer->payments as $payment)
                <div class="payment-row">
                    <span class="payment-status">
                        @if($payment->status === 'complete')
                            <span class="badge badge-complete">✓ Complete</span>
                        @elseif($payment->status === 'partial')
                            <span class="badge badge-partial">Partial</span>
                        @else
                            <span class="badge badge-pending">Pending</span>
                        @endif
                    </span>
                    <span style="flex:1;">R {{ number_format($payment->amount_paid, 2) }}</span>
                    <span style="color:var(--gray);">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</span>
                    @if($payment->status !== 'complete')
                    <form action="{{ route('demo.water.payments.complete', $payment->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-sm" style="background:#00695c;color:white;padding:4px 10px;">
                            Mark Complete
                        </button>
                    </form>
                    @endif
                </div>
                @endforeach
                @endif

                {{-- Add Payment Form --}}
                @if($outstanding > 0)
                <form action="{{ route('demo.water.payments.store') }}" method="POST"
                      style="margin-top:12px;padding-top:12px;border-top:1px solid var(--border);">
                    @csrf
                    <input type="hidden" name="water_customer_id" value="{{ $customer->id }}">
                    <div style="font-size:12px;font-weight:600;color:var(--gray);margin-bottom:8px;">Record a Payment:</div>
                    <div style="display:grid;grid-template-columns:1fr 1fr auto;gap:8px;align-items:end;">
                        <div>
                            <label class="form-label" style="font-size:11px;">Amount (R)</label>
                            <input type="number" name="amount_paid" class="form-control"
                                   step="0.01" min="0.01" value="{{ number_format($outstanding, 2, '.', '') }}"
                                   placeholder="{{ number_format($outstanding, 2) }}" required>
                        </div>
                        <div>
                            <label class="form-label" style="font-size:11px;">Date</label>
                            <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <button type="submit" class="btn" style="background:#00695c;color:white;white-space:nowrap;">
                            + Record
                        </button>
                    </div>
                </form>
                @else
                <div style="text-align:center;padding:12px;color:#059669;font-size:14px;font-weight:600;margin-top:8px;">
                    ✅ Fully Paid — Account Settled
                </div>
                @endif

                {{-- Delete Customer --}}
                <form action="{{ route('demo.water.customers.destroy', $customer->id) }}" method="POST"
                      style="margin-top:12px;"
                      onsubmit="return confirm('Remove this customer and all their payment records?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑 Remove Customer</button>
                </form>

            </div>
        </div>
        @empty
        <div class="no-customers card">
            <div class="card-body">
                <div class="icon">👤</div>
                <p style="font-size:15px;margin-bottom:8px;">No customers yet.</p>
                <p>Use the form on the left to add your first customer and start tracking drum orders.</p>
            </div>
        </div>
        @endforelse
    </div>

</div>

@endsection

@push('scripts')
<script>
function toggleCustomer(id) {
    const el = document.getElementById('cust-' + id);
    el.style.display = el.style.display === 'none' ? '' : 'none';
}
</script>
@endpush