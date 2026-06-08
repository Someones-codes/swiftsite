@extends('layouts.app')

@section('title', 'Prince Chishanga - Software Developer Portfolio')

@section('content')

<style>
    :root {
        --sky: #CBDDE9;
        --ocean: #2872A1;
        --dark: #1a3a52;
        --light: #f8fbfd;
        --accent: #ff6b6b;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, var(--light) 0%, var(--sky) 100%);
        color: var(--dark);
        line-height: 1.6;
    }

    /* ═══════════════════════════════ HERO SECTION ═══════════════════════════════ */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--ocean) 0%, #1e5a8e 100%);
        color: white;
        text-align: center;
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: rgba(203, 221, 233, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .hero::after {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(203, 221, 233, 0.05);
        border-radius: 50%;
        bottom: -50px;
        left: -50px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hero h1 {
        font-size: clamp(2.5rem, 8vw, 4rem);
        font-weight: 800;
        margin-bottom: 15px;
        letter-spacing: -1px;
    }

    .hero .subtitle {
        font-size: clamp(1.2rem, 5vw, 1.8rem);
        color: var(--sky);
        margin-bottom: 30px;
        font-weight: 300;
    }

    .hero .description {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 40px;
        opacity: 0.95;
        line-height: 1.8;
    }

    .cta-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 40px;
    }

    .btn {
        padding: 14px 35px;
        border: none;
        border-radius: 50px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        font-family: inherit;
    }

    .btn-primary {
        background: var(--sky);
        color: var(--ocean);
        box-shadow: 0 10px 30px rgba(203, 221, 233, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(203, 221, 233, 0.4);
    }

    .btn-secondary {
        background: transparent;
        color: var(--sky);
        border: 2px solid var(--sky);
    }

    .btn-secondary:hover {
        background: var(--sky);
        color: var(--ocean);
        transform: translateY(-3px);
    }

    /* ═══════════════════════════════ SECTIONS ═══════════════════════════════ */
    .section {
        padding: 80px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .section-title {
        font-size: clamp(2rem, 5vw, 3rem);
        color: var(--ocean);
        margin-bottom: 50px;
        text-align: center;
        font-weight: 800;
    }

    /* ═══════════════════════════════ ABOUT SECTION ═══════════════════════════════ */
    .about {
        background: white;
    }

    .about-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
    }

    @media (max-width: 768px) {
        .about-content {
            grid-template-columns: 1fr;
        }
    }

    .about-text h3 {
        color: var(--ocean);
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .about-text p {
        color: #555;
        margin-bottom: 20px;
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .about-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 40px;
    }

    .stat-box {
        background: linear-gradient(135deg, var(--sky) 0%, #b5cfe0 100%);
        padding: 25px;
        border-radius: 15px;
        text-align: center;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--ocean);
    }

    .stat-label {
        color: var(--dark);
        font-size: 0.95rem;
        margin-top: 10px;
    }

    /* ═══════════════════════════════ SKILLS SECTION ═══════════════════════════════ */
    .skills {
        background: linear-gradient(180deg, var(--light) 0%, var(--sky) 100%);
    }

    .skills-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
    }

    .skill-category {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(40, 114, 161, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .skill-category:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(40, 114, 161, 0.2);
    }

    .skill-category h3 {
        color: var(--ocean);
        font-size: 1.4rem;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid var(--sky);
    }

    .skill-item {
        margin-bottom: 20px;
    }

    .skill-name {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--dark);
        font-size: 0.95rem;
    }

    .skill-level {
        color: var(--ocean);
        font-weight: 700;
        font-size: 0.85rem;
    }

    .progress-bar {
        height: 8px;
        background: #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--ocean), var(--sky));
        border-radius: 10px;
        transition: width 0.6s ease;
    }

    /* ═══════════════════════════════ PROJECTS SECTION ═══════════════════════════════ */
    .projects {
        background: white;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 35px;
    }

    @media (max-width: 768px) {
        .projects-grid {
            grid-template-columns: 1fr;
        }
    }

    .project-card {
        background: linear-gradient(135deg, white 0%, var(--light) 100%);
        border: 2px solid var(--sky);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(40, 114, 161, 0.08);
    }

    .project-card:hover {
        transform: translateY(-10px);
        border-color: var(--ocean);
        box-shadow: 0 15px 40px rgba(40, 114, 161, 0.2);
    }

    .project-header {
        background: linear-gradient(135deg, var(--ocean) 0%, #1e5a8e 100%);
        color: white;
        padding: 30px;
        min-height: 150px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .project-header h3 {
        font-size: 1.6rem;
        margin-bottom: 10px;
    }

    .project-header p {
        opacity: 0.9;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .project-body {
        padding: 25px;
    }

    .tech-stack {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 20px;
    }

    .tech-badge {
        background: var(--sky);
        color: var(--ocean);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .project-description {
        color: #666;
        margin-bottom: 20px;
        line-height: 1.7;
    }

    .project-features {
        color: #555;
        font-size: 0.9rem;
        margin-bottom: 20px;
    }

    .project-features li {
        margin-bottom: 8px;
        margin-left: 20px;
    }

    .project-cta {
        display: inline-block;
        background: var(--ocean);
        color: white;
        padding: 10px 20px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .project-cta:hover {
        background: var(--dark);
        transform: translateX(5px);
    }

    /* ═══════════════════════════════ CERTIFICATIONS SECTION ═══════════════════════════════ */
    .certifications {
        background: linear-gradient(180deg, var(--light) 0%, var(--sky) 100%);
    }

    .certs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
    }

    .cert-card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(40, 114, 161, 0.1);
        transition: transform 0.3s ease;
    }

    .cert-card:hover {
        transform: translateY(-5px);
    }

    .cert-icon {
        font-size: 3rem;
        margin-bottom: 15px;
    }

    .cert-name {
        color: var(--ocean);
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.1rem;
    }

    .cert-issuer {
        color: #888;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .cert-date {
        color: var(--ocean);
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* ═══════════════════════════════ CONTACT SECTION ═══════════════════════════════ */
    .contact {
        background: white;
        text-align: center;
    }

    .contact-content {
        max-width: 600px;
        margin: 0 auto;
    }

    .contact-content p {
        color: #666;
        font-size: 1.1rem;
        margin-bottom: 40px;
        line-height: 1.8;
    }

    .contact-links {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 40px;
    }

    .contact-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 25px;
        background: var(--sky);
        color: var(--ocean);
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .contact-link:hover {
        background: var(--ocean);
        color: white;
        transform: translateY(-3px);
    }

    .social-links {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-top: 30px;
    }

    .social-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--ocean);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 1.3rem;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: var(--dark);
        transform: translateY(-5px);
    }

    /* ═══════════════════════════════ FOOTER ═══════════════════════════════ */
    footer {
        background: var(--dark);
        color: white;
        text-align: center;
        padding: 30px 20px;
        margin-top: 80px;
    }

    footer p {
        margin-bottom: 10px;
    }

    /* ═══════════════════════════════ RESPONSIVE ═══════════════════════════════ */
    @media (max-width: 768px) {
        .section {
            padding: 50px 20px;
        }

        .hero {
            min-height: 80vh;
            padding: 30px 20px;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: stretch;
        }

        .btn {
            width: 100%;
        }

        .about-stats {
            grid-template-columns: 1fr;
        }
    }

</style>

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

        <div>
            <h3 style="color: var(--ocean); margin-bottom: 25px;">Core Values</h3>
            <div style="display: grid; gap: 20px;">
                <div>
                    <h4 style="color: var(--ocean); margin-bottom: 8px;">🎯 Problem Solver</h4>
                    <p style="color: #666;">I analyze challenges and develop practical, user-focused solutions.</p>
                </div>
                <div>
                    <h4 style="color: var(--ocean); margin-bottom: 8px;">📚 Continuous Learner</h4>
                    <p style="color: #666;">Technology evolves rapidly, and I'm committed to constant growth.</p>
                </div>
                <div>
                    <h4 style="color: var(--ocean); margin-bottom: 8px;">⚙️ Detail-Oriented</h4>
                    <p style="color: #666;">I focus on creating systems that are functional, organized, and user-friendly.</p>
                </div>
                <div>
                    <h4 style="color: var(--ocean); margin-bottom: 8px;">🚀 Growth Mindset</h4>
                    <p style="color: #666;">Every project is an opportunity to learn and improve my craft.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════ SKILLS ═══════════════════════════════ -->
<section id="skills" class="section skills">
    <h2 class="section-title">Technical Skills</h2>
    <div class="skills-grid">
        
        <!-- Frontend -->
        <div class="skill-category">
            <h3>🎨 Frontend Development</h3>
            <div class="skill-item">
                <div class="skill-name">
                    <span>HTML5</span>
                    <span class="skill-level">Advanced</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 95%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>CSS3</span>
                    <span class="skill-level">Advanced</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 90%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>JavaScript</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 70%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>Bootstrap</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 75%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>Responsive Design</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 80%;"></div>
                </div>
            </div>
        </div>

        <!-- Backend -->
        <div class="skill-category">
            <h3>⚙️ Backend Development</h3>
            <div class="skill-item">
                <div class="skill-name">
                    <span>Laravel</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 80%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>PHP</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 75%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>Java</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 70%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>C++</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 65%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>OOP</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 80%;"></div>
                </div>
            </div>
        </div>

        <!-- Databases -->
        <div class="skill-category">
            <h3>🗄️ Databases & Tools</h3>
            <div class="skill-item">
                <div class="skill-name">
                    <span>MySQL</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 80%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>Database Design</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 80%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>Git & GitHub</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 85%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>VS Code</span>
                    <span class="skill-level">Advanced</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 90%;"></div>
                </div>
            </div>
            <div class="skill-item">
                <div class="skill-name">
                    <span>Cloud Fundamentals</span>
                    <span class="skill-level">Intermediate</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 70%;"></div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════ PROJECTS ═══════════════════════════════ -->
<section id="projects" class="section projects">
    <h2 class="section-title">Featured Projects</h2>
    <div class="projects-grid">

        <!-- Project 1: Finance Tracker -->
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

        <!-- Project 2: Water Drum Tracker -->
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

        <!-- Project 3: Family Blog -->
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
    <div style="text-align: center; margin-top: 40px;">
        <p style="color: #666; margin-bottom: 20px;">View all my badges and credentials</p>
        <a href="https://www.credly.com/users/princd-chishanga" target="_blank" class="btn btn-primary">
            View on Credly →
        </a>
    </div>
</section>

<!-- ═══════════════════════════════ EDUCATION ═══════════════════════════════ -->
<section class="section" style="background: white;">
    <h2 class="section-title">Education</h2>
    <div style="max-width: 700px; margin: 0 auto; background: linear-gradient(135deg, var(--sky) 0%, #b5cfe0 100%); padding: 40px; border-radius: 15px;">
        <h3 style="color: var(--ocean); font-size: 1.5rem; margin-bottom: 15px;">
            Bachelor of Science in Information Technology
        </h3>
        <p style="color: var(--dark); font-size: 1.1rem; margin-bottom: 10px;">
            <strong>Richfield Graduate Institute</strong>
        </p>
        <p style="color: var(--dark); margin-bottom: 25px;">
            Expected Graduation: 2027
        </p>
        <div>
            <p style="color: var(--dark); margin-bottom: 15px; font-weight: 600;">Relevant Coursework:</p>
            <ul style="color: var(--dark); margin-left: 20px; line-height: 2;">
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
                📧 Email Me
            </a>
            <a href="https://github.com/Someones-codes" target="_blank" class="contact-link">
                💻 GitHub Profile
            </a>
            <a href="https://www.linkedin.com/in/prince-chishanga-478b20344" target="_blank" class="contact-link">
                💼 LinkedIn
            </a>
        </div>

       
    </div>
</section>

<footer>
    <p>© 2026 Prince Chishanga. All rights reserved.</p>
    <p style="font-size: 0.9rem; color: var(--sky);">
        Building innovative software solutions | Based in Durban, South Africa 🇿🇦
    </p>
</footer>

@endsection