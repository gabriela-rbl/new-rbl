/**
 * Simetrik-style Scroll Animations
 * Simple fade-in animations triggered on scroll
 */

(function() {
    'use strict';

    // Intersection Observer for fade-in animations
    function initScrollAnimations() {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -100px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Optionally unobserve after animation
                    // observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        const fadeElements = document.querySelectorAll('.fade-in, .fade-in-phone');
        fadeElements.forEach(element => {
            observer.observe(element);
        });
    }

    // Smooth scroll for anchor links
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Skip empty hash or just "#"
                if (!href || href === '#') return;

                const targetId = href.substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    e.preventDefault();
                    const headerOffset = 80;
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // Header scroll effect
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');
        if (!header) return;

        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScroll = currentScroll;
        });
    }

    // Animated placeholder for AI demo input
    function initAnimatedPlaceholder() {
        const input = document.querySelector('.demo-input');
        if (!input) return;

        const phrases = [
            'Are you ready to prepare your year-end audit documents?',
            'Want to see the status of yesterday\'s exceptions?',
            'Would you like to review your current transactional and financial controls?',
            'How can I help optimize your workflow today?',
            'What business process would you like to automate?'
        ];

        let phraseIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let isPaused = false;

        function typeEffect() {
            const currentPhrase = phrases[phraseIndex];

            if (!isDeleting && charIndex <= currentPhrase.length) {
                // Typing
                input.setAttribute('placeholder', currentPhrase.substring(0, charIndex));
                charIndex++;

                if (charIndex > currentPhrase.length) {
                    // Pause at end of phrase
                    isPaused = true;
                    setTimeout(() => {
                        isPaused = false;
                        isDeleting = true;
                        typeEffect();
                    }, 3000); // Pause for 3 seconds
                    return;
                }
            } else if (isDeleting && charIndex >= 0) {
                // Deleting
                input.setAttribute('placeholder', currentPhrase.substring(0, charIndex));
                charIndex--;

                if (charIndex < 0) {
                    // Move to next phrase
                    isDeleting = false;
                    phraseIndex = (phraseIndex + 1) % phrases.length;
                    charIndex = 0;
                    setTimeout(typeEffect, 500); // Pause before next phrase
                    return;
                }
            }

            // Typing speed
            const typingSpeed = isDeleting ? 30 : 50;
            if (!isPaused) {
                setTimeout(typeEffect, typingSpeed);
            }
        }

        // Start the animation
        typeEffect();

        // Prevent input interaction (demo only)
        input.addEventListener('focus', function() {
            this.blur();
        });
    }

    // Typing animation for hero headline
    function initHeroTypingAnimation() {
        const typingElement = document.querySelector('.typing-word');
        if (!typingElement) return;

        const words = ['workflow', 'process', 'report', 'operation'];
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let isPaused = false;

        function type() {
            const currentWord = words[wordIndex];

            if (isPaused) {
                isPaused = false;
                setTimeout(type, 1500); // Pause for 1.5 seconds before deleting
                return;
            }

            if (isDeleting) {
                // Remove characters
                typingElement.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;

                if (charIndex === 0) {
                    isDeleting = false;
                    wordIndex = (wordIndex + 1) % words.length;
                    setTimeout(type, 500); // Pause before typing next word
                    return;
                }
            } else {
                // Add characters
                typingElement.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;

                if (charIndex === currentWord.length) {
                    isDeleting = true;
                    isPaused = true;
                    setTimeout(type, 2000); // Pause when word is complete
                    return;
                }
            }

            // Typing speed: faster when deleting
            const typeSpeed = isDeleting ? 50 : 100;
            setTimeout(type, typeSpeed);
        }

        // Start typing animation after initial delay
        setTimeout(type, 500);
    }

    // Initialize all animations when DOM is ready
    function init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                initScrollAnimations();
                initSmoothScroll();
                initHeaderScroll();
                initAnimatedPlaceholder();
                initHeroTypingAnimation();
            });
        } else {
            initScrollAnimations();
            initSmoothScroll();
            initHeaderScroll();
            initAnimatedPlaceholder();
            initHeroTypingAnimation();
        }
    }

    init();
})();
