@extends('layouts.admin')
@section('title', 'CV / Resume')

@section('content')

<div class="page-header">
    <div>
        <h1>CV / Resume</h1>
        <p>Upload your CV PDF. Visitors can download it from the portfolio page.</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;align-items:start;">

    {{-- CURRENT CV --}}
    <div class="card">
        <div class="card-header"><h2>📄 Current CV</h2></div>
        <div class="card-body">
            @if($activeCv)
                <div style="background:var(--light);border:1px solid var(--border);border-radius:12px;padding:32px 20px;text-align:center;margin-bottom:20px;">
                    <div style="font-size:56px;margin-bottom:12px;">📄</div>
                    <div style="font-size:15px;font-weight:700;color:var(--navy);margin-bottom:4px;">
                        {{ $activeCv->original_name }}
                    </div>
                    <div style="font-size:12px;color:var(--gray);">
                        Uploaded {{ $activeCv->created_at->format('d M Y') }}
                    </div>
                </div>

                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <a href="{{ route('cv.download') }}"
                       class="btn btn-primary" style="flex:1;justify-content:center;">
                        ⬇ Download / Preview
                    </a>
                    <form action="{{ route('admin.cv.destroy', $activeCv) }}"
                          method="POST"
                          onsubmit="return confirm('Remove this CV?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑</button>
                    </form>
                </div>

                <div style="margin-top:16px;padding:12px 14px;background:#fef3c7;border-radius:8px;
                            border:1px solid #fde68a;font-size:13px;color:#92400e;">
                    ⚠️ Uploading a new CV below will replace this one.
                </div>
            @else
                <div style="text-align:center;padding:48px 20px;color:var(--gray);">
                    <div style="font-size:56px;margin-bottom:12px;">📭</div>
                    <p style="font-size:15px;">No CV uploaded yet.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- UPLOAD FORM --}}
    <div class="card">
        <div class="card-header"><h2>⬆️ Upload New CV</h2></div>
        <div class="card-body">

            {{-- IMPORTANT: enctype is required for file uploads --}}
            <form action="{{ route('admin.cv.upload') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- Drop zone — position:relative is CRITICAL --}}
                <div id="dropZone"
                     style="position:relative;
                            border:2px dashed var(--border);
                            border-radius:12px;
                            padding:48px 20px;
                            text-align:center;
                            margin-bottom:20px;
                            cursor:pointer;
                            transition:border-color 0.2s,background 0.2s;">

                    <div style="font-size:40px;margin-bottom:12px;pointer-events:none;">📁</div>
                    <p style="font-size:15px;font-weight:600;color:var(--navy);
                               margin-bottom:6px;pointer-events:none;">
                        Click here to select your CV
                    </p>
                    <p style="font-size:13px;color:var(--gray);pointer-events:none;">
                        PDF files only · Max 5MB
                    </p>

                    {{-- The actual input — covers entire drop zone --}}
                    <input type="file"
                           name="cv"
                           id="cvInput"
                           accept=".pdf"
                           required
                           onchange="showFileName(this)"
                           style="position:absolute;
                                  top:0;left:0;
                                  width:100%;height:100%;
                                  opacity:0;
                                  cursor:pointer;">
                </div>

                {{-- Selected file name display --}}
                <div id="fileNameDisplay"
                     style="display:none;
                            background:#ecfdf5;
                            border:1px solid #a7f3d0;
                            border-radius:8px;
                            padding:12px 14px;
                            margin-bottom:16px;
                            font-size:14px;
                            color:#065f46;
                            font-weight:500;">
                    ✓ Selected: <span id="fileName"></span>
                </div>

                @error('cv')
                    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;
                                padding:10px 14px;margin-bottom:16px;
                                font-size:13px;color:#991b1b;">
                        ⚠️ {{ $message }}
                    </div>
                @enderror

                <button type="submit" class="btn btn-primary" style="width:100%;">
                    📤 Upload CV
                </button>
            </form>

            <div style="margin-top:20px;border-top:1px solid var(--border);padding-top:16px;">
                <div style="font-size:13px;font-weight:600;color:var(--navy);margin-bottom:8px;">Tips:</div>
                <ul style="font-size:13px;color:var(--gray);line-height:2;padding-left:18px;">
                    <li>Export your CV from Word or Canva as PDF</li>
                    <li>Keep the file under 2MB for fast loading</li>
                    <li>Update it whenever you gain new skills</li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    const dropZone = document.getElementById('dropZone');

    // Highlight on hover
    dropZone.addEventListener('mouseenter', () => {
        dropZone.style.borderColor = 'var(--navy2)';
        dropZone.style.background  = 'var(--light)';
    });

    dropZone.addEventListener('mouseleave', () => {
        if (!document.getElementById('cvInput').files.length) {
            dropZone.style.borderColor = 'var(--border)';
            dropZone.style.background  = '';
        }
    });

    function showFileName(input) {
        if (input.files && input.files[0]) {
            document.getElementById('fileName').textContent = input.files[0].name;
            document.getElementById('fileNameDisplay').style.display = 'block';
            dropZone.style.borderColor = '#059669';
            dropZone.style.background  = '#ecfdf5';
        }
    }
</script>
@endpush