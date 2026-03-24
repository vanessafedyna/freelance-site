// Navbar premium: menu mobile + effet sticky au scroll.
if (!window.__premiumNavInit) {
    window.__premiumNavInit = true;

    const siteHeader = document.querySelector('[data-js="premium-nav"]');
    const menuToggle = document.querySelector('.menu-toggle');
    const siteNav = document.querySelector('#primary-nav');
    const navLinks = document.querySelectorAll('#primary-nav a');
    const mobileNavMedia = window.matchMedia('(max-width: 760px)');

    if (siteHeader && menuToggle && siteNav) {
        const syncNavAccessibility = (isOpen) => {
            const isMobile = mobileNavMedia.matches;
            const shouldHideNav = isMobile && !isOpen;

            siteNav.setAttribute('aria-hidden', shouldHideNav ? 'true' : 'false');
            menuToggle.setAttribute('aria-expanded', String(isMobile && isOpen));
            menuToggle.setAttribute(
                'aria-label',
                isMobile && isOpen
                    ? 'Fermer le menu de navigation'
                    : 'Ouvrir ou fermer le menu de navigation'
            );

            navLinks.forEach((link) => {
                if (shouldHideNav) {
                    link.setAttribute('tabindex', '-1');
                } else {
                    link.removeAttribute('tabindex');
                }
            });
        };

        const closeMenu = () => {
            siteHeader.classList.remove('nav-open');
            syncNavAccessibility(false);
        };

        const toggleMenu = () => {
            const isOpen = siteHeader.classList.toggle('nav-open');
            syncNavAccessibility(isOpen);
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

        const syncNavLayout = () => {
            if (mobileNavMedia.matches) {
                syncNavAccessibility(siteHeader.classList.contains('nav-open'));
            } else {
                siteHeader.classList.remove('nav-open');
                syncNavAccessibility(false);
            }
        };

        window.addEventListener('resize', syncNavLayout);

        syncNavLayout();
        updateHeaderOnScroll();
        window.addEventListener('scroll', updateHeaderOnScroll, { passive: true });
    }
}

// Effets narratifs légers: reveal au scroll + parallax discret.
if (!window.__storyEffectsInit) {
    window.__storyEffectsInit = true;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const revealTargets = document.querySelectorAll('[data-reveal], .reveal');

    const markRevealVisible = (element) => {
        if (element.matches('[data-reveal]')) {
            element.classList.add('is-visible');
        }

        if (element.matches('.reveal')) {
            element.classList.add('reveal-visible');
        }
    };

    if (!prefersReducedMotion && 'IntersectionObserver' in window && revealTargets.length > 0) {
        const revealObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        markRevealVisible(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.08,
                rootMargin: '0px 0px -40px 0px',
            }
        );

        revealTargets.forEach((element) => revealObserver.observe(element));
    } else {
        revealTargets.forEach((element) => markRevealVisible(element));
    }

    const parallaxElements = document.querySelectorAll('[data-parallax]');

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
