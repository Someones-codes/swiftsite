@extends('layouts.admin')
@section('title', 'Add Project')

@section('content')

<div class="page-header">
    <div>
        <h1>Add New Project</h1>
        <p>Fill in the details for your new portfolio project.</p>
    </div>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">← Back to Projects</a>
</div>

<div style="max-width:820px;">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card" style="margin-bottom:20px;">
            <div class="card-header"><h2>📋 Project Details</h2></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Project Title <span style="color:var(--red)">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. Student Finance Tracker" required>
                    @error('title') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Short Description <span style="color:var(--red)">*</span></label>
                    <input type="text" name="short_description" class="form-control" value="{{ old('short_description') }}" placeholder="One sentence shown on project cards (max 255 chars)" maxlength="255" required>
                    @error('short_description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Full Description <span style="color:var(--red)">*</span></label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Detailed description of the project, your role, challenges, what you learned..." required>{{ old('description') }}</textarea>
                    @error('description') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Tech Stack <span style="color:var(--red)">*</span></label>
                    <input type="text" name="tech_stack" class="form-control" value="{{ old('tech_stack') }}" placeholder="Laravel, MySQL, Tailwind CSS, PHP" required>
                    <div class="form-hint">Comma-separated list. E.g: Laravel, MySQL, Tailwind CSS</div>
                    @error('tech_stack') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px;">
            <div class="card-header"><h2>🔗 Links</h2></div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Live URL</label>
                        <input type="url" name="live_url" class="form-control" value="{{ old('live_url') }}" placeholder="https://yourdomain.co.za">
                        @error('live_url') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">GitHub URL</label>
                        <input type="url" name="github_url" class="form-control" value="{{ old('github_url') }}" placeholder="https://github.com/yourusername/repo">
                        @error('github_url') <div class="form-error">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:20px;">
            <div class="card-header"><h2>🖼️ Project Image</h2></div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="form-label">Upload Screenshot (optional)</label>
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp"
                           onchange="previewImage(this)">
                    <div class="form-hint">JPG, PNG or WebP · Max 2MB</div>
                    @error('image') <div class="form-error">{{ $message }}</div> @enderror
                    <img id="imagePreview" style="margin-top:12px;max-height:200px;border-radius:8px;display:none;">
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom:28px;">
            <div class="card-header"><h2>⚙️ Settings</h2></div>
            <div class="card-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
                        <div class="form-hint">Lower number = shown first</div>
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label">Featured on Homepage?</label>
                        <div style="display:flex;align-items:center;gap:10px;margin-top:10px;">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                   {{ old('is_featured') ? 'checked' : '' }}
                                   style="width:18px;height:18px;cursor:pointer;">
                            <label for="is_featured" style="font-size:14px;cursor:pointer;color:var(--dark);">
                                Show this project on homepage
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:12px;">
            <button type="submit" class="btn btn-primary">💾 Save Project</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline">Cancel</a>
        </div>

    </form>
</div>

@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush