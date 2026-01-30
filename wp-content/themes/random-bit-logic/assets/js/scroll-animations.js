/**
 * Scroll Animations for Random Bit Logic Theme
 * Handles scroll-triggered animations and full-screen section snapping
 */

(function() {
    'use strict';

    /**
     * Intersection Observer for fade-in animations
     */
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px 0px -100px 0px'
    };

    const fadeInObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Optional: unobserve after animation to improve performance
                // fadeInObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    /**
     * Initialize observers when DOM is ready
     */
    function initScrollAnimations() {
        // Observe all client content sections
        const clientContents = document.querySelectorAll('.client-content');
        clientContents.forEach(content => {
            fadeInObserver.observe(content);
        });

        // Observe capabilities section elements
        const capabilitiesHeader = document.querySelector('.capabilities-header');
        if (capabilitiesHeader) {
            fadeInObserver.observe(capabilitiesHeader);
        }

        const capabilityCards = document.querySelectorAll('.capability-card');
        capabilityCards.forEach(card => {
            fadeInObserver.observe(card);
        });

        const capabilitiesCta = document.querySelector('.capabilities-cta');
        if (capabilitiesCta) {
            fadeInObserver.observe(capabilitiesCta);
        }

        // Observe SeatServe triple phones animation
        const seatservePhones = document.querySelector('.seatserve-triple-phones');
        if (seatservePhones) {
            fadeInObserver.observe(seatservePhones);
        }

        // Add scroll-triggered parallax to geometric shapes
        initParallaxShapes();

        // Initialize smooth scroll anchoring
        initSmoothScrolling();

        // Track scroll position for additional effects
        trackScrollPosition();
    }

    /**
     * Parallax effect for geometric shapes
     */
    function initParallaxShapes() {
        const shapes = document.querySelectorAll('.shape');
        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrolled = window.pageYOffset;
                    shapes.forEach((shape, index) => {
                        const speed = 0.3 + (index * 0.1);
                        const yPos = -(scrolled * speed);
                        shape.style.transform = `translateY(${yPos}px)`;
                    });
                    ticking = false;
                });
                ticking = true;
            }
        });
    }

    /**
     * Smooth scrolling for anchor links
     */
    function initSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;

                e.preventDefault();
                const targetId = href.substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    // Update URL without page jump
                    history.pushState(null, null, href);
                }
            });
        });
    }

    /**
     * Track scroll position for effects
     */
    function trackScrollPosition() {
        let lastScrollTop = 0;
        let ticking = false;

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    const scrollDirection = scrollTop > lastScrollTop ? 'down' : 'up';

                    // Add scroll direction class to body
                    document.body.classList.remove('scroll-up', 'scroll-down');
                    document.body.classList.add(`scroll-${scrollDirection}`);

                    // Update sections visibility
                    updateActiveSections();

                    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
    }

    /**
     * Update active section based on viewport
     */
    function updateActiveSections() {
        const sections = document.querySelectorAll('.section');
        const viewportHeight = window.innerHeight;
        const scrollTop = window.pageYOffset;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionMiddle = sectionTop + (sectionHeight / 2);
            const viewportMiddle = scrollTop + (viewportHeight / 2);

            if (Math.abs(sectionMiddle - viewportMiddle) < viewportHeight / 3) {
                section.classList.add('active');
            } else {
                section.classList.remove('active');
            }
        });
    }

    /**
     * Scroll snap enhancement
     * Adds momentum and snap behavior
     */
    function enhanceScrollSnap() {
        const sections = document.querySelectorAll('.section');
        let isScrolling = false;
        let scrollTimeout;

        window.addEventListener('scroll', () => {
            // Clear timeout if it exists
            clearTimeout(scrollTimeout);

            if (!isScrolling) {
                isScrolling = true;
                document.body.classList.add('is-scrolling');
            }

            // Set a timeout to run after scrolling ends
            scrollTimeout = setTimeout(() => {
                isScrolling = false;
                document.body.classList.remove('is-scrolling');
                snapToNearestSection();
            }, 150);
        }, { passive: true });
    }

    /**
     * Snap to nearest section after scroll ends
     */
    function snapToNearestSection() {
        const sections = document.querySelectorAll('.section');
        const viewportHeight = window.innerHeight;
        const scrollTop = window.pageYOffset;
        const viewportMiddle = scrollTop + (viewportHeight / 2);

        let closestSection = null;
        let closestDistance = Infinity;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionMiddle = sectionTop + (sectionHeight / 2);
            const distance = Math.abs(sectionMiddle - viewportMiddle);

            if (distance < closestDistance) {
                closestDistance = distance;
                closestSection = section;
            }
        });

        // Snap to closest section if it's not already centered
        if (closestSection && closestDistance > 50) {
            closestSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    /**
     * Add entrance animations to hero elements
     */
    function animateHero() {
        const heroElements = document.querySelectorAll('.hero-content > *');
        heroElements.forEach((element, index) => {
            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 150);
        });
    }

    /**
     * Initialize on DOM ready
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initScrollAnimations();
            enhanceScrollSnap();
            animateHero();
        });
    } else {
        initScrollAnimations();
        enhanceScrollSnap();
        animateHero();
    }

    /**
     * Expose public API
     */
    window.RBLScrollAnimations = {
        init: initScrollAnimations,
        updateActiveSections: updateActiveSections
    };

})();
