/* ============================================
   PRINCE CHISHANGA PORTFOLIO — SCRIPTS
   ============================================ */

document.addEventListener('DOMContentLoaded', function () {

    /* ---------- HAMBURGER MENU ---------- */
    const navToggle = document.getElementById('navToggle');
    const navLinks = document.getElementById('navLinks');

    if (navToggle && navLinks) {
        navToggle.addEventListener('click', function () {
            navToggle.classList.toggle('active');
            navLinks.classList.toggle('open');
            document.body.style.overflow = navLinks.classList.contains('open') ? 'hidden' : '';
        });

        // Close menu when a link is clicked (mobile)
        navLinks.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                navToggle.classList.remove('active');
                navLinks.classList.remove('open');
                document.body.style.overflow = '';
            });
        });
    }

    /* ---------- BACK TO TOP BUTTON ---------- */
    const backToTop = document.getElementById('backToTop');

    if (backToTop) {
        window.addEventListener('scroll', function () {
            backToTop.style.display = window.scrollY > 400 ? 'block' : 'none';
        });

        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ---------- SCROLL-TRIGGERED SECTION FADE-IN ---------- */
    const sectionObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.section').forEach(function (section) {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        sectionObserver.observe(section);
    });

    /* ---------- ANIMATED SKILL PROGRESS BARS ---------- */
    const skillObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                const fills = entry.target.querySelectorAll('.progress-fill');
                fills.forEach(function (fill) {
                    const targetWidth = fill.style.width;
                    fill.style.width = '0%';
                    setTimeout(function () {
                        fill.style.width = targetWidth;
                    }, 100);
                });
                skillObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    document.querySelectorAll('.skill-category').forEach(function (category) {
        skillObserver.observe(category);
    });

});