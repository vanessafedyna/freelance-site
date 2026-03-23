// Navbar premium: menu mobile + effet sticky au scroll.
if (!window.__premiumNavInit) {
    window.__premiumNavInit = true;

    const siteHeader = document.querySelector('[data-js="premium-nav"]');
    const menuToggle = document.querySelector('.menu-toggle');
    const siteNav = document.querySelector('#primary-nav');
    const navLinks = document.querySelectorAll('#primary-nav a');

    if (siteHeader && menuToggle && siteNav) {
        const closeMenu = () => {
            siteHeader.classList.remove('nav-open');
            menuToggle.setAttribute('aria-expanded', 'false');
        };

        const toggleMenu = () => {
            const isOpen = siteHeader.classList.toggle('nav-open');
            menuToggle.setAttribute('aria-expanded', String(isOpen));
        };

        menuToggle.addEventListener('click', toggleMenu);

        navLinks.forEach((link) => {
            link.addEventListener('click', closeMenu);
        });

        document.addEventListener('click', (event) => {
            const target = event.target;
            if (!(target instanceof Element)) {
                return;
            }

            if (!siteHeader.contains(target) && siteHeader.classList.contains('nav-open')) {
                closeMenu();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && siteHeader.classList.contains('nav-open')) {
                closeMenu();
                menuToggle.focus();
            }
        });

        const updateHeaderOnScroll = () => {
            siteHeader.classList.toggle('is-scrolled', window.scrollY > 10);
        };

        window.addEventListener('resize', () => {
            if (window.innerWidth > 760) {
                closeMenu();
            }
        });

        updateHeaderOnScroll();
        window.addEventListener('scroll', updateHeaderOnScroll, { passive: true });
    }
}

// Effets narratifs légers: reveal au scroll + parallax discret.
if (!window.__storyEffectsInit) {
    window.__storyEffectsInit = true;

    const revealElements = document.querySelectorAll('[data-reveal]');

    if ('IntersectionObserver' in window && revealElements.length > 0) {
        const revealObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0,
                rootMargin: '0px 0px 0px 0px',
            }
        );

        revealElements.forEach((el) => revealObserver.observe(el));
    } else {
        revealElements.forEach((el) => el.classList.add('is-visible'));
    }

    const parallaxElements = document.querySelectorAll('[data-parallax]');
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (parallaxElements.length > 0 && !prefersReducedMotion) {
        const updateParallax = () => {
            const viewportHeight = window.innerHeight || 1;

            parallaxElements.forEach((el) => {
                const rect = el.getBoundingClientRect();
                const speed = Number(el.getAttribute('data-speed') || '0.05');
                const offset = (rect.top - viewportHeight * 0.5) * speed;
                el.style.transform = `translate3d(0, ${offset.toFixed(2)}px, 0)`;
            });
        };

        let ticking = false;
        const onScroll = () => {
            if (ticking) {
                return;
            }

            ticking = true;
            window.requestAnimationFrame(() => {
                updateParallax();
                ticking = false;
            });
        };

        updateParallax();
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll);
    }
}

// Reveal on scroll — IntersectionObserver, stagger CSS, sans librairie.
if (!window.__revealInit) {
    window.__revealInit = true;

    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const revealTargets = document.querySelectorAll('.reveal');

    if (!prefersReduced && 'IntersectionObserver' in window && revealTargets.length > 0) {
        const revealObserver = new IntersectionObserver(
            (entries, obs) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('reveal-visible');
                        obs.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.12,
                rootMargin: '0px 0px -40px 0px',
            }
        );

        revealTargets.forEach((el) => revealObserver.observe(el));
    } else {
        revealTargets.forEach((el) => el.classList.add('reveal-visible'));
    }
}

// Hero entrance animation — séquencée au chargement, sans librairie.
if (!window.__heroEnterInit) {
    window.__heroEnterInit = true;

    (function () {
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const heroItems = document.querySelectorAll('.hero-enter');

        if (heroItems.length === 0) { return; }

        if (prefersReduced) {
            heroItems.forEach((el) => el.classList.add('hero-enter-visible'));
            return;
        }

        // Double rAF : attend le premier paint avant de déclencher les transitions.
        requestAnimationFrame(function () {
            requestAnimationFrame(function () {
                heroItems.forEach((el) => el.classList.add('hero-enter-visible'));
            });
        });
    }());
}