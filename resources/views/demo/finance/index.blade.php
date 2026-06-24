@extends('layouts.demo')

@section('title', 'Student Finance Tracker')
@section('demo-icon', '📊')
@section('demo-name', 'Student Finance Tracker')

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
       PAGE-SPECIFIC STYLES (Student Finance Tracker)
       ============================================ */
    .balance-bar {
        height: 8px; border-radius: 10px; overflow: hidden;
        background: var(--border); margin-top: 16px;
    }
    .balance-bar-fill {
        height: 100%; border-radius: 10px;
        background: linear-gradient(90deg, #059669, #34d399);
        transition: width 0.6s ease;
    }

    .tab-bar { display:flex; gap:8px; margin-bottom:16px; }
    .tab-btn {
        padding:7px 16px; border-radius:30px; font-size:0.8rem;
        font-weight:600; border:none; cursor:pointer;
        background:var(--light); color:var(--gray);
        transition:all 0.2s; font-family:'DM Sans',sans-serif;
        white-space: nowrap;
    }
    .tab-btn.active { background:var(--ocean); color:white; }

    .tx-list { list-style:none; margin:0; padding:0; }
    .tx-item {
        display:flex; align-items:center; gap:10px;
        padding:12px 0; border-bottom:1px solid var(--border);
    }
    .tx-item:last-child { border-bottom:none; }

    .tx-icon {
        width:34px; height:34px; border-radius:50%;
        display:flex; align-items:center; justify-content:center;
        font-size:15px; flex-shrink:0;
    }
    .tx-icon.income  { background:#d1fae5; }
    .tx-icon.expense { background:#fee2e2; }

    .tx-label { flex:1; min-width: 0; }
    .tx-label strong { display:block; font-size:0.85rem; color:var(--dark); word-break: break-word; }
    .tx-label small  { font-size:0.75rem; color:var(--gray); }

    .tx-amount { font-weight:700; font-size:0.85rem; white-space:nowrap; }

    .delete-btn {
        background:none; border:none; cursor:pointer;
        color:var(--gray); font-size:14px; padding:4px 8px;
        border-radius:6px; transition:all 0.15s; flex-shrink: 0;
    }
    .delete-btn:hover { background:#fee2e2; color:var(--red); }
</style>
@endpush

@section('content')

<div class="demo-page-header">
    <h1>📊 Student Finance Tracker</h1>
    <p>Track your income and expenses. Your data is private to your session and resets every 30 minutes.</p>
</div>

<div class="reset-notice">
    ⏱ Demo data resets every 30 minutes &nbsp;·&nbsp; Session: <code style="background:rgba(40,114,161,0.08);padding:2px 6px;border-radius:4px;font-size:0.7rem;">{{ substr(session('demo_session_id'), 0, 14) }}...</code>
</div>

{{-- SUMMARY CARDS --}}
<div class="stat-cards">
    <div class="stat-card income">
        <div class="label">💰 Income</div>
        <div class="value">R {{ number_format($totalIncome, 2) }}</div>
    </div>
    <div class="stat-card expense">
        <div class="label">📤 Expenses</div>
        <div class="value">R {{ number_format($totalExpenses, 2) }}</div>
    </div>
    <div class="stat-card balance" style="{{ $balance < 0 ? 'border-color:var(--red);' : '' }}">
        <div class="label">{{ $balance >= 0 ? '✅' : '⚠️' }} Balance</div>
        <div class="value" style="color:{{ $balance >= 0 ? 'var(--ocean)' : 'var(--red)' }}">
            R {{ number_format(abs($balance), 2) }}
            {{ $balance < 0 ? '(overdrawn)' : '' }}
        </div>
    </div>
</div>

@if($totalIncome > 0)
<div style="background:white;border-radius:12px;border:1px solid var(--border);padding:16px 18px;margin-bottom:24px;">
    <div style="display:flex;justify-content:space-between;font-size:0.8rem;color:var(--gray);margin-bottom:8px;">
        <span>Expenses vs Income</span>
        <span>{{ $totalIncome > 0 ? round(($totalExpenses / $totalIncome) * 100) : 0 }}% spent</span>
    </div>
    <div class="balance-bar">
        @php $pct = $totalIncome > 0 ? min(($totalExpenses / $totalIncome) * 100, 100) : 0; @endphp
        <div class="balance-bar-fill"
             style="width:{{ $pct }}%;background:{{ $pct > 80 ? 'linear-gradient(90deg,var(--red),#ef9a9a)' : 'linear-gradient(90deg,#059669,#34d399)' }};">
        </div>
    </div>
</div>
@endif

<div class="finance-grid">

    <div style="display:flex;flex-direction:column;gap:16px;">

        <div class="card">
            <div class="card-header"><h2>💰 Add Income</h2></div>
            <div class="card-body">
                <form action="{{ route('demo.finance.income.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Income Source</label>
                        <input type="text" name="source" class="form-control"
                               placeholder="e.g. NSFAS, Part-time job, Family" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Amount (R)</label>
                        <input type="number" name="amount" class="form-control"
                               step="0.01" min="0.01" placeholder="0.00" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date Received</label>
                        <input type="date" name="received_date" class="form-control"
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Notes (optional)</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Any extra detail..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-full">+ Add Income</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h2>📤 Add Expense</h2></div>
            <div class="card-body">
                <form action="{{ route('demo.finance.expense.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-control" required>
                            <option value="">Select category...</option>
                            @foreach(['Food','Transport','Tuition','Books','Rent','Data/Airtime','Clothing','Entertainment','Other'] as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control"
                               placeholder="e.g. Groceries at Pick n Pay" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Amount (R)</label>
                        <input type="number" name="amount" class="form-control"
                               step="0.01" min="0.01" placeholder="0.00" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date</label>
                        <input type="date" name="expense_date" class="form-control"
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                    <button type="submit" class="btn btn-danger btn-full">+ Add Expense</button>
                </form>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <h2>📋 Transaction History</h2>
            <span style="font-size:0.8rem;color:var(--gray);">{{ $incomes->count() + $expenses->count() }} total</span>
        </div>
        <div class="card-body">

            <div class="tab-bar">
                <button class="tab-btn active" data-tab-type="all">All</button>
                <button class="tab-btn" data-tab-type="income">Income ({{ $incomes->count() }})</button>
                <button class="tab-btn" data-tab-type="expense">Expenses ({{ $expenses->count() }})</button>
            </div>

            @php
                $allTx = collect();
                foreach($incomes as $i) { $allTx->push(['type'=>'income','data'=>$i]); }
                foreach($expenses as $e) { $allTx->push(['type'=>'expense','data'=>$e]); }
                $allTx = $allTx->sortByDesc(fn($t) => $t['data']->created_at);
            @endphp

            <ul class="tx-list">
                @forelse($allTx as $tx)
                <li class="tx-item" data-type="{{ $tx['type'] }}">
                    <div class="tx-icon {{ $tx['type'] }}">
                        {{ $tx['type'] === 'income' ? '💰' : '📤' }}
                    </div>
                    <div class="tx-label">
                        <strong>
                            {{ $tx['type'] === 'income' ? $tx['data']->source : $tx['data']->description }}
                        </strong>
                        <small>
                            @if($tx['type'] === 'expense') {{ $tx['data']->category }} · @endif
                            {{ \Carbon\Carbon::parse($tx['type'] === 'income' ? $tx['data']->received_date : $tx['data']->expense_date)->format('d M Y') }}
                        </small>
                    </div>
                    <span class="tx-amount {{ $tx['type'] === 'income' ? 'amount-positive' : 'amount-negative' }}">
                        {{ $tx['type'] === 'income' ? '+' : '-' }}R {{ number_format($tx['data']->amount, 2) }}
                    </span>
                    <form action="{{ route('demo.finance.'.$tx['type'].'.destroy', $tx['data']->id) }}" method="POST"
                          onsubmit="return confirm('Remove this entry?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="delete-btn" title="Delete">✕</button>
                    </form>
                </li>
                @empty
                <div class="empty-tx">
                    <div class="e-icon">📭</div>
                    <p>No transactions yet.<br>Add your first income or expense using the forms.</p>
                </div>
                @endforelse
            </ul>

        </div>
    </div>

</div>

@endsection