@extends('layouts.demo')

@section('title', 'Student Finance Tracker')
@section('demo-icon', '📊')
@section('demo-name', 'Student Finance Tracker')

@section('demo-nav')
    <li><a href="{{ route('demo.finance.index') }}" class="active">Dashboard</a></li>
    <li><a href="{{ route('demos') }}">← All Demos</a></li>
@endsection

@push('styles')
<style>
    .finance-grid { display: grid; grid-template-columns: 1fr 1.5fr; gap: 24px; }

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
        padding:7px 18px; border-radius:30px; font-size:13px;
        font-weight:600; border:none; cursor:pointer;
        background:var(--light); color:var(--gray);
        transition:all 0.2s; font-family:'DM Sans',sans-serif;
    }
    .tab-btn.active { background:var(--navy2); color:white; }

    .tx-list { list-style:none; }
    .tx-item {
        display:flex; align-items:center; gap:12px;
        padding:12px 0; border-bottom:1px solid var(--border);
    }
    .tx-item:last-child { border-bottom:none; }

    .tx-icon {
        width:36px; height:36px; border-radius:50%;
        display:flex; align-items:center; justify-content:center;
        font-size:16px; flex-shrink:0;
    }
    .tx-icon.income  { background:#d1fae5; }
    .tx-icon.expense { background:#fee2e2; }

    .tx-label { flex:1; }
    .tx-label strong { display:block; font-size:14px; color:var(--dark); }
    .tx-label small  { font-size:12px; color:var(--gray); }

    .tx-amount { font-weight:700; font-size:14px; white-space:nowrap; }

    .delete-btn {
        background:none; border:none; cursor:pointer;
        color:var(--gray); font-size:14px; padding:4px 8px;
        border-radius:6px; transition:all 0.15s;
    }
    .delete-btn:hover { background:#fee2e2; color:var(--red); }

    .empty-tx { text-align:center; padding:32px 16px; color:var(--gray); }
    .empty-tx .e-icon { font-size:36px; margin-bottom:8px; }
    .empty-tx p { font-size:14px; }
</style>
@endpush

@section('content')

<div class="demo-page-header">
    <h1>📊 Student Finance Tracker</h1>
    <p>Track your income and expenses. Your data is private to your session and resets every 30 minutes.</p>
</div>

<div class="reset-notice">
    ⏱ Demo data resets every 30 minutes &nbsp;·&nbsp; Your Session: <code style="background:rgba(26,35,126,0.08);padding:2px 8px;border-radius:4px;font-size:11px;">{{ substr(session('demo_session_id'), 0, 16) }}...</code>
</div>

{{-- SUMMARY CARDS --}}
<div class="stat-cards">
    <div class="stat-card income">
        <div class="label">💰 Total Income</div>
        <div class="value">R {{ number_format($totalIncome, 2) }}</div>
    </div>
    <div class="stat-card expense">
        <div class="label">📤 Total Expenses</div>
        <div class="value">R {{ number_format($totalExpenses, 2) }}</div>
    </div>
    <div class="stat-card balance" style="{{ $balance < 0 ? 'border-color:var(--red);' : '' }}">
        <div class="label">{{ $balance >= 0 ? '✅' : '⚠️' }} Balance</div>
        <div class="value" style="color:{{ $balance >= 0 ? 'var(--navy2)' : 'var(--red)' }}">
            R {{ number_format(abs($balance), 2) }}
            {{ $balance < 0 ? '(overdrawn)' : '' }}
        </div>
    </div>
</div>

{{-- Balance Progress Bar --}}
@if($totalIncome > 0)
<div style="background:white;border-radius:12px;border:1px solid var(--border);padding:16px 20px;margin-bottom:24px;">
    <div style="display:flex;justify-content:space-between;font-size:13px;color:var(--gray);margin-bottom:8px;">
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

{{-- MAIN GRID --}}
<div class="finance-grid">

    {{-- LEFT: FORMS --}}
    <div style="display:flex;flex-direction:column;gap:16px;">

        {{-- Add Income --}}
        <div class="card">
            <div class="card-header">
                <h2>💰 Add Income</h2>
            </div>
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

        {{-- Add Expense --}}
        <div class="card">
            <div class="card-header">
                <h2>📤 Add Expense</h2>
            </div>
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

    {{-- RIGHT: TRANSACTION HISTORY --}}
    <div class="card">
        <div class="card-header">
            <h2>📋 Transaction History</h2>
            <span style="font-size:13px;color:var(--gray);">{{ $incomes->count() + $expenses->count() }} total</span>
        </div>
        <div class="card-body" style="padding:16px 20px;">

            <div class="tab-bar">
                <button class="tab-btn active" onclick="showTab('all', this)">All</button>
                <button class="tab-btn" onclick="showTab('income', this)">Income ({{ $incomes->count() }})</button>
                <button class="tab-btn" onclick="showTab('expense', this)">Expenses ({{ $expenses->count() }})</button>
            </div>

            {{-- ALL TRANSACTIONS MERGED --}}
            @php
                $allTx = collect();
                foreach($incomes as $i) {
                    $allTx->push(['type'=>'income','data'=>$i]);
                }
                foreach($expenses as $e) {
                    $allTx->push(['type'=>'expense','data'=>$e]);
                }
                $allTx = $allTx->sortByDesc(fn($t) => $t['data']->created_at);
            @endphp

            <ul class="tx-list" id="tab-all">
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

@push('scripts')
<script>
function showTab(type, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.tx-item').forEach(item => {
        item.style.display = (type === 'all' || item.dataset.type === type) ? '' : 'none';
    });
}
</script>
@endpush