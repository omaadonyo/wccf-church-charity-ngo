document.addEventListener('DOMContentLoaded', () => {
    initHeroSlider();
    initScrollAnimations();
    initNavbarScroll();
    initMobileMenu();
    initSmoothScroll();
    initCountUp();
});

function initHeroSlider() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    if (!slides.length) return;

    let current = 0;
    const total = slides.length;
    let interval;

    function goTo(index) {
        slides.forEach(s => s.classList.remove('active'));
        dots.forEach(d => d.classList.remove('active'));
        slides[index].classList.add('active');
        if (dots[index]) dots[index].classList.add('active');
        current = index;
    }

    function next() {
        goTo((current + 1) % total);
    }

    function resetInterval() {
        clearInterval(interval);
        interval = setInterval(next, 6000);
    }

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            goTo(i);
            resetInterval();
        });
    });

    interval = setInterval(next, 6000);
    goTo(0);

    const slider = document.querySelector('.hero-slider');
    if (slider) {
        slider.addEventListener('mouseenter', () => clearInterval(interval));
        slider.addEventListener('mouseleave', () => { interval = setInterval(next, 6000); });
    }
}

function initScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -60px 0px'
    });

    document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
}

function initNavbarScroll() {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;

    let lastScroll = 0;
    const isHome = navbar.dataset.transparent === 'true';

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        if (isHome) {
            if (currentScroll > 80) {
                navbar.classList.remove('navbar-transparent');
                navbar.classList.add('navbar-solid', 'navbar-scrolled');
            } else {
                navbar.classList.add('navbar-transparent');
                navbar.classList.remove('navbar-solid', 'navbar-scrolled');
            }
        } else {
            if (currentScroll > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        }

        if (currentScroll > lastScroll && currentScroll > 200) {
            navbar.style.transform = 'translateY(-100%)';
        } else {
            navbar.style.transform = 'translateY(0)';
        }

        lastScroll = currentScroll;
    }, { passive: true });

    if (isHome) navbar.classList.add('navbar-transparent');
}

function initMobileMenu() {
    const toggle = document.querySelector('.mobile-menu-toggle');
    const menu = document.querySelector('.mobile-menu');
    const overlay = document.querySelector('.mobile-overlay');
    const links = document.querySelectorAll('.mobile-menu a');

    if (!toggle || !menu) return;

    function openMenu() {
        menu.classList.remove('translate-x-full');
        menu.classList.add('translate-x-0');
        if (overlay) {
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        menu.classList.remove('translate-x-0');
        menu.classList.add('translate-x-full');
        if (overlay) {
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0', 'pointer-events-none');
        }
        document.body.style.overflow = '';
    }

    toggle.addEventListener('click', () => {
        if (menu.classList.contains('translate-x-full')) {
            openMenu();
        } else {
            closeMenu();
        }
    });

    if (overlay) overlay.addEventListener('click', closeMenu);
    links.forEach(link => link.addEventListener('click', closeMenu));
}

function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const href = anchor.getAttribute('href');
            if (href === '#') return;
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
}

function initCountUp() {
    const counters = document.querySelectorAll('.count-up');
    if (!counters.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const raw = el.dataset.target;
                const suffix = raw.includes('+') ? '+' : '';
                const target = parseInt(raw);
                if (isNaN(target)) return;
                let current = 0;
                const step = Math.max(1, Math.floor(target / 60));
                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    el.textContent = current + suffix;
                }, 20);
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(el => observer.observe(el));
}
