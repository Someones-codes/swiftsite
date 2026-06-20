@extends('layouts.app')

@section('title', 'Prince Chishanga - Software Developer Portfolio')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
@endpush

@section('content')

<!-- ═══════════════════════════════ NAVBAR ═══════════════════════════════ -->
<nav class="portfolio-nav">
    <div class="nav-logo">PC</div>

    <ul class="nav-links" id="navLinks">
        <li><a href="#about">About</a></li>
        <li><a href="#skills">Skills</a></li>
        <li><a href="#projects">Projects</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>

    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>

<!-- ═══════════════════════════════ HERO ═══════════════════════════════ -->
<section class="hero">
    <div class="hero-content">
        <h1>Prince Chishanga</h1>
        <p class="subtitle">Software Developer | Full-Stack Builder | Problem Solver</p>
        <p class="description">
            I build web applications that solve real-world problems. Currently a BSc IT student in South Africa,
            passionate about creating innovative software solutions that make a meaningful impact.
        </p>
        <div class="cta-buttons">
            <a href="#projects" class="btn btn-primary">See My Work</a>
            <a href="{{ route('cv.download') }}" class="btn btn-secondary">Download CV</a>
            <a href="#contact" class="btn btn-secondary">Get In Touch</a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ ABOUT ═══════════════════════════════ -->
<section id="about" class="section about">
    <h2 class="section-title">About Me</h2>
    <div class="about-content">
        <div class="about-text">
            <h3>Building Solutions That Matter</h3>
            <p>
                I'm Prince Chishanga, a BSc Information Technology student at Richfield Graduate Institute
                in Durban, South Africa. My passion is creating software that helps people and businesses
                work more efficiently.
            </p>
            <p>
                From designing databases to building user interfaces, I love every aspect of software development.
                I believe the best way to learn is by building real projects that solve actual problems.
            </p>
            <p>
                My focus areas include full-stack web development, database design, cloud computing, and
                software engineering principles. I'm constantly learning and improving to stay current with
                modern technologies.
            </p>

            <div class="about-stats">
                <div class="stat-box">
                    <div class="stat-number">3+</div>
                    <div class="stat-label">Full Projects Built</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">5</div>
                    <div class="stat-label">IBM Certifications</div>
                </div>
            </div>
        </div>

        <div class="values-list">
            <h3 style="color: var(--ocean); margin-bottom: 20px;">Core Values</h3>
            <div>
                <h4>🎯 Problem Solver</h4>
                <p>I analyze challenges and develop practical, user-focused solutions.</p>
            </div>
            <div>
                <h4>📚 Continuous Learner</h4>
                <p>Technology evolves rapidly, and I'm committed to constant growth.</p>
            </div>
            <div>
                <h4>⚙️ Detail-Oriented</h4>
                <p>I focus on creating systems that are functional, organized, and user-friendly.</p>
            </div>
            <div>
                <h4>🚀 Growth Mindset</h4>
                <p>Every project is an opportunity to learn and improve my craft.</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ SKILLS ═══════════════════════════════ -->
<section id="skills" class="section skills">
    <h2 class="section-title">Technical Skills</h2>
    <div class="skills-grid">

        <div class="skill-category">
            <h3>🎨 Frontend Development</h3>
            <div class="skill-item">
                <div class="skill-name"><span>HTML5</span><span class="skill-level">Advanced</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 95%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>CSS3</span><span class="skill-level">Advanced</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 90%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>JavaScript</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 70%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>Bootstrap</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 75%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>Responsive Design</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 80%;"></div></div>
            </div>
        </div>

        <div class="skill-category">
            <h3>⚙️ Backend Development</h3>
            <div class="skill-item">
                <div class="skill-name"><span>Laravel</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 80%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>PHP</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 75%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>Java</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 70%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>C++</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 65%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>OOP</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 80%;"></div></div>
            </div>
        </div>

        <div class="skill-category">
            <h3>🗄️ Databases & Tools</h3>
            <div class="skill-item">
                <div class="skill-name"><span>MySQL</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 80%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>Database Design</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 80%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>Git & GitHub</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 85%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>VS Code</span><span class="skill-level">Advanced</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 90%;"></div></div>
            </div>
            <div class="skill-item">
                <div class="skill-name"><span>Cloud Fundamentals</span><span class="skill-level">Intermediate</span></div>
                <div class="progress-bar"><div class="progress-fill" style="width: 70%;"></div></div>
            </div>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════ PROJECTS ═══════════════════════════════ -->
<section id="projects" class="section projects">
    <h2 class="section-title">Featured Projects</h2>
    <div class="projects-grid">

        <div class="project-card">
            <div class="project-header">
                <h3>💰 Student Finance Tracker</h3>
                <p>A web-based financial management application for students</p>
            </div>
            <div class="project-body">
                <div class="tech-stack">
                    <span class="tech-badge">Laravel</span>
                    <span class="tech-badge">PHP</span>
                    <span class="tech-badge">MySQL</span>
                    <span class="tech-badge">JavaScript</span>
                </div>
                <p class="project-description">
                    Helps students effectively monitor income, expenses, and savings with a centralized dashboard and financial analytics.
                </p>
                <div class="project-features">
                    <strong>Key Features:</strong>
                    <ul>
                        <li>Income & expense tracking</li>
                        <li>Budget planning & analysis</li>
                        <li>Financial dashboard</li>
                        <li>Spending reports</li>
                    </ul>
                </div>
                <a href="/demo/finance" class="project-cta">→ View Live Demo</a>
            </div>
        </div>

        <div class="project-card">
            <div class="project-header">
                <h3>💧 Water Drum Installment Tracker</h3>
                <p>Business management system for payment tracking</p>
            </div>
            <div class="project-body">
                <div class="tech-stack">
                    <span class="tech-badge">Laravel</span>
                    <span class="tech-badge">PHP</span>
                    <span class="tech-badge">MySQL</span>
                    <span class="tech-badge">JavaScript</span>
                </div>
                <p class="project-description">
                    Simplifies customer payment management and installment tracking for small businesses selling products on credit.
                </p>
                <div class="project-features">
                    <strong>Key Features:</strong>
                    <ul>
                        <li>Customer management</li>
                        <li>Payment tracking</li>
                        <li>Outstanding balance alerts</li>
                        <li>Reporting dashboard</li>
                    </ul>
                </div>
                <a href="/demo/water" class="project-cta">→ View Live Demo</a>
            </div>
        </div>

        <div class="project-card">
            <div class="project-header">
                <h3>📝 Family Link Blog</h3>
                <p>Community blogging and information sharing platform</p>
            </div>
            <div class="project-body">
                <div class="tech-stack">
                    <span class="tech-badge">Laravel</span>
                    <span class="tech-badge">PHP</span>
                    <span class="tech-badge">MySQL</span>
                    <span class="tech-badge">HTML/CSS</span>
                </div>
                <p class="project-description">
                    Provides families and communities with a centralized platform for sharing updates, stories, and maintaining connections.
                </p>
                <div class="project-features">
                    <strong>Key Features:</strong>
                    <ul>
                        <li>Blog post publishing</li>
                        <li>Category organization</li>
                        <li>User engagement (likes/comments)</li>
                        <li>Responsive design</li>
                    </ul>
                </div>
                <a href="/demo/blog" class="project-cta">→ View Live Demo</a>
            </div>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════ CERTIFICATIONS ═══════════════════════════════ -->
<section class="section certifications">
    <h2 class="section-title">IBM Certifications & Badges</h2>
    <div class="certs-grid">
        <div class="cert-card">
            <div class="cert-icon">🤖</div>
            <div class="cert-name">AI Literacy</div>
            <div class="cert-issuer">IBM SkillsBuild</div>
            <div class="cert-date">Issued Sep 3, 2025</div>
        </div>
        <div class="cert-card">
            <div class="cert-icon">🛡️</div>
            <div class="cert-name">Cybersecurity Fundamentals</div>
            <div class="cert-issuer">IBM SkillsBuild</div>
            <div class="cert-date">Issued Mar 14, 2026</div>
        </div>
        <div class="cert-card">
            <div class="cert-icon">📊</div>
            <div class="cert-name">Data Fundamentals</div>
            <div class="cert-issuer">IBM SkillsBuild</div>
            <div class="cert-date">Issued Aug 10, 2025</div>
        </div>
        <div class="cert-card">
            <div class="cert-icon">💡</div>
            <div class="cert-name">Enterprise Design Thinking</div>
            <div class="cert-issuer">IBM SkillsBuild</div>
            <div class="cert-date">Issued Oct 23, 2025</div>
        </div>
        <div class="cert-card">
            <div class="cert-icon">💻</div>
            <div class="cert-name">IT Fundamentals</div>
            <div class="cert-issuer">IBM SkillsBuild</div>
            <div class="cert-date">Issued Oct 1, 2025</div>
        </div>
    </div>
    <div style="text-align: center; margin-top: 35px;">
        <p style="color: #666; margin-bottom: 18px;">View all my badges and credentials</p>
        <a href="https://www.credly.com/users/princd-chishanga" target="_blank" class="btn btn-primary">
            View on Credly →
        </a>
    </div>
</section>

<!-- ═══════════════════════════════ EDUCATION ═══════════════════════════════ -->
<section class="section" style="background: white;">
    <h2 class="section-title">Education</h2>
    <div class="education-card">
        <h3>Bachelor of Science in Information Technology</h3>
        <p style="color: var(--dark); font-size: 1.05rem; margin-bottom: 8px;">
            <strong>Richfield Graduate Institute</strong>
        </p>
        <p style="color: var(--dark); margin-bottom: 20px;">
            Expected Graduation: 2027
        </p>
        <div>
            <p style="color: var(--dark); margin-bottom: 12px; font-weight: 600;">Relevant Coursework:</p>
            <ul>
                <li>✓ Software Development</li>
                <li>✓ Internet Programming</li>
                <li>✓ Cloud Computing</li>
                <li>✓ Database Systems</li>
                <li>✓ Systems Analysis & Design</li>
                <li>✓ Data Structures & Algorithms</li>
            </ul>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ CONTACT ═══════════════════════════════ -->
<section id="contact" class="section contact">
    <h2 class="section-title">Let's Build Something Meaningful</h2>
    <div class="contact-content">
        <p>
            I'm always interested in hearing about new projects and opportunities. Whether you're looking for a developer,
            have a project idea, or just want to chat about technology and innovation, feel free to reach out.
        </p>

        <div class="contact-links">
            <a href="mailto:pchishanga2020@gmail.com" class="contact-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                Email Me
            </a>
            <a href="https://github.com/Someones-codes" target="_blank" class="contact-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.15 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.62.24 2.85.12 3.15.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                </svg>
                GitHub Profile
            </a>
            <a href="https://www.linkedin.com/in/prince-chishanga-478b20344" target="_blank" class="contact-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
                LinkedIn
            </a>
        </div>
    </div>
</section>

<footer class="portfolio-footer">
    <p>© 2026 Prince Chishanga. All rights reserved.</p>
    <p style="color: var(--sky);">
        Building innovative software solutions | Based in Durban, South Africa 🇿🇦
    </p>
</footer>

<button id="backToTop" aria-label="Back to top">↑</button>

@endsection

@push('scripts')
<script src="{{ asset('js/portfolio.js') }}"></script>
@endpush