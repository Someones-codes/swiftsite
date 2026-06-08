@extends('layouts.app')
@section('title', 'Contact')

@push('styles')
<style>
    .contact-hero {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
        padding: 64px 5%;
        text-align: center;
    }

    .contact-hero h1 { font-size: clamp(30px,4vw,48px); color: white; margin-bottom: 12px; }
    .contact-hero p  { font-size: 17px; color: rgba(255,255,255,0.7); max-width: 520px; margin: 0 auto; }

    .contact-section {
        padding: 64px 5%;
        max-width: 1100px; margin: 0 auto;
        display: grid; grid-template-columns: 1fr 1.6fr; gap: 48px; align-items: start;
    }

    /* ── LEFT SIDE INFO ── */
    .contact-info { }

    .contact-info h2 {
        font-size: 22px; font-weight: 800; color: var(--navy); margin-bottom: 12px;
    }

    .contact-info p {
        font-size: 15px; color: var(--gray); line-height: 1.7; margin-bottom: 32px;
    }

    .contact-item {
        display: flex; align-items: flex-start; gap: 14px;
        margin-bottom: 20px;
    }

    .contact-icon {
        width: 44px; height: 44px; border-radius: 10px;
        background: var(--light); border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }

    .contact-item h4 { font-size: 13px; color: var(--gray); font-weight: 500; }
    .contact-item p  { font-size: 15px; color: var(--navy); font-weight: 600; margin: 2px 0 0; }

    .demo-cta-box {
        background: linear-gradient(135deg, var(--navy2), var(--red));
        border-radius: 16px; padding: 24px;
        margin-top: 28px; text-align: center;
    }

    .demo-cta-box p {
        color: rgba(255,255,255,0.8); font-size: 14px; margin-bottom: 14px;
    }

    .demo-cta-box a {
        background: var(--gold); color: var(--navy);
        padding: 10px 22px; border-radius: 8px;
        font-weight: 700; font-size: 14px; display: inline-block;
        transition: all 0.2s;
    }

    .demo-cta-box a:hover { background: #ffd54f; }

    /* ── FORM ── */
    .contact-form-wrap {
        background: white; border-radius: 20px;
        border: 1px solid var(--border); padding: 36px;
        box-shadow: 0 4px 24px rgba(13,27,75,0.06);
    }

    .contact-form-wrap h3 {
        font-size: 20px; font-weight: 800; color: var(--navy);
        margin-bottom: 24px;
    }

    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    .form-group { margin-bottom: 18px; }

    .form-label {
        display: block; font-size: 13px; font-weight: 600;
        color: var(--navy); margin-bottom: 6px;
    }

    .form-label .req { color: var(--red); }

    .form-control {
        width: 100%; padding: 11px 14px;
        border: 1.5px solid var(--border); border-radius: 10px;
        font-size: 14px; color: var(--dark);
        transition: border-color 0.2s; background: white;
        font-family: 'DM Sans', sans-serif;
    }

    .form-control:focus {
        outline: none; border-color: var(--navy2);
        box-shadow: 0 0 0 3px rgba(26,35,126,0.08);
    }

    textarea.form-control { min-height: 140px; resize: vertical; }

    .form-error { font-size: 12px; color: var(--red); margin-top: 4px; }

    .submit-btn {
        width: 100%; padding: 14px; background: var(--navy2); color: white;
        border: none; border-radius: 10px; cursor: pointer;
        font-size: 15px; font-weight: 700; font-family: 'DM Sans', sans-serif;
        transition: all 0.2s;
    }

    .submit-btn:hover { background: var(--red); }

    .form-note {
        text-align: center; font-size: 12px; color: var(--gray);
        margin-top: 12px;
    }

    @media (max-width: 860px) {
        .contact-section { grid-template-columns: 1fr; gap: 32px; }
        .form-row { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="contact-hero">
    <div class="section-label">Get In Touch</div>
    <h1>Let's Build Something Together</h1>
    <p>Have a project idea? Need a website or custom system? I'd love to hear from you.</p>
</div>

<div class="contact-section">

    {{-- LEFT: Contact Info --}}
    <div class="contact-info">
        <h2>Contact Details</h2>
        <p>I'm a full-stack developer based in Durban, KZN. I work with small businesses, startups, and individuals across South Africa to build web systems that actually make a difference.</p>

        <div class="contact-item">
            <div class="contact-icon">📍</div>
            <div>
                <h4>Location</h4>
                <p>Durban, KwaZulu-Natal, South Africa</p>
            </div>
        </div>

        <div class="contact-item">
            <div class="contact-icon">⚡</div>
            <div>
                <h4>Response Time</h4>
                <p>Usually within 24 hours</p>
            </div>
        </div>

        <div class="contact-item">
            <div class="contact-icon">🏗️</div>
            <div>
                <h4>Services</h4>
                <p>Websites, Web Systems, CRM, Tracking Apps</p>
            </div>
        </div>

        @if(request('ref'))
        <div class="demo-cta-box">
            <p>You came from the <strong style="color:white;">{{ request('ref') }}</strong> — great choice! Tell me what kind of system you need and I'll get back to you quickly.</p>
            <a href="{{ route('demos') }}">← See More Demos</a>
        </div>
        @else
        <div class="demo-cta-box">
            <p>Haven't seen the live demos yet? See what I can build before you commit.</p>
            <a href="{{ route('demos') }}">🧪 Try Live Demos</a>
        </div>
        @endif
    </div>

    {{-- RIGHT: Contact Form --}}
    <div class="contact-form-wrap">
        <h3>Send Me a Message</h3>

        <form method="POST" action="{{ route('contact.store') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Your Name <span class="req">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-error @enderror"
                           value="{{ old('name') }}" placeholder="John Smith" required>
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email Address <span class="req">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-error @enderror"
                           value="{{ old('email') }}" placeholder="john@example.com" required>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Phone (optional)</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone') }}" placeholder="+27 82 123 4567">
                </div>

                <div class="form-group">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control"
                           value="{{ old('subject', request('ref') ? 'Saw your '.request('ref').' demo' : '') }}"
                           placeholder="Website / App / Quote">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Your Message <span class="req">*</span></label>
                <textarea name="message" class="form-control @error('message') is-error @enderror"
                          placeholder="Tell me about your project, business, and what you need..." required>{{ old('message') }}</textarea>
                @error('message') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="submit-btn">Send Message 🚀</button>

            <p class="form-note">I'll respond within 24 hours · No spam, ever.</p>
        </form>
    </div>

</div>

@endsection