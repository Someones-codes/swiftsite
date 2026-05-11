@extends('layouts.admin')
@section('title', 'Skills')

@section('content')

<div class="page-header">
    <div>
        <h1>Skills</h1>
        <p>Manage the skills displayed on your portfolio homepage.</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1.4fr;gap:24px;align-items:start;">

    {{-- ADD SKILL FORM --}}
    <div class="card">
        <div class="card-header"><h2>➕ Add New Skill</h2></div>
        <div class="card-body">
            <form action="{{ route('admin.skills.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Skill Name <span style="color:var(--red)">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                           placeholder="e.g. Laravel" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Category <span style="color:var(--red)">*</span></label>
                    <select name="category" class="form-control" required>
                        <option value="">Select Category</option>
                        <option value="frontend"  {{ old('category') === 'frontend'  ? 'selected' : '' }}>🎨 Frontend</option>
                        <option value="backend"   {{ old('category') === 'backend'   ? 'selected' : '' }}>⚙️ Backend</option>
                        <option value="tools"     {{ old('category') === 'tools'     ? 'selected' : '' }}>🔧 Tools</option>
                        <option value="other"     {{ old('category') === 'other'     ? 'selected' : '' }}>💡 Other</option>
                    </select>
                    @error('category') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Proficiency: <span id="profVal" style="color:var(--navy2);font-weight:700;">{{ old('proficiency', 80) }}%</span>
                    </label>
                    <input type="range" name="proficiency" id="profSlider"
                           min="10" max="100" step="5"
                           value="{{ old('proficiency', 80) }}"
                           style="width:100%;accent-color:var(--navy2);"
                           oninput="document.getElementById('profVal').textContent = this.value + '%'">
                    <div style="display:flex;justify-content:space-between;font-size:11px;color:var(--gray);margin-top:4px;">
                        <span>Beginner</span><span>Intermediate</span><span>Expert</span>
                    </div>
                    @error('proficiency') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                    <div class="form-hint">Lower = appears first in category</div>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">
                    ⚡ Add Skill
                </button>
            </form>
        </div>
    </div>

    {{-- SKILLS LIST --}}
    <div style="display:flex;flex-direction:column;gap:16px;">
        @foreach(['frontend' => '🎨 Frontend', 'backend' => '⚙️ Backend', 'tools' => '🔧 Tools', 'other' => '💡 Other'] as $cat => $label)
        @php $catSkills = $skills->where('category', $cat); @endphp
        @if($catSkills->isNotEmpty())
        <div class="card">
            <div class="card-header">
                <h2>{{ $label }}</h2>
                <span style="font-size:13px;color:var(--gray);">{{ $catSkills->count() }} skills</span>
            </div>
            <div class="card-body" style="padding:0;">
                @foreach($catSkills->sortBy('sort_order') as $skill)
                <div style="display:flex;align-items:center;gap:14px;padding:14px 20px;border-bottom:1px solid var(--border);">
                    <div style="flex:1;">
                        <div style="display:flex;justify-content:space-between;font-size:14px;font-weight:600;color:var(--dark);margin-bottom:6px;">
                            <span>{{ $skill->name }}</span>
                            <span style="color:var(--gray);font-weight:400;">{{ $skill->proficiency }}%</span>
                        </div>
                        <div style="height:6px;background:var(--border);border-radius:10px;overflow:hidden;">
                            <div style="height:100%;width:{{ $skill->proficiency }}%;background:linear-gradient(90deg,var(--navy2),var(--gold));border-radius:10px;"></div>
                        </div>
                    </div>
                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST"
                          onsubmit="return confirm('Delete {{ $skill->name }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">🗑</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach

        @if($skills->isEmpty())
        <div class="card">
            <div class="card-body" style="text-align:center;padding:48px;color:var(--gray);">
                <div style="font-size:40px;margin-bottom:12px;">⚡</div>
                <p>No skills yet. Add your first skill using the form.</p>
            </div>
        </div>
        @endif
    </div>

</div>

@endsection